<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once '../connection/db.php';

$response = ['status' => 'error', 'message' => ''];

if (!isset($_SESSION['login'])) {
    $response['message'] = 'User not logged in';
    echo json_encode($response);
    exit();
}

$sid = $_SESSION['stdid'];

try {
    $sql = "
        SELECT DISTINCT tblcategory.id AS category_id, tblcategory.CategoryName
        FROM tblissuedbookdetails
        INNER JOIN tblbooks ON tblissuedbookdetails.BookId = tblbooks.id
        INNER JOIN tblcategory ON tblbooks.CatId = tblcategory.id
        WHERE tblissuedbookdetails.StudentID = :sid
    ";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
    $query->execute();
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($categories)) {
        $response['message'] = 'No book recommendations available. Please borrow books to help us recommend similar titles.';
        echo json_encode($response);
        exit();
    }

    $category_ids = array_column($categories, 'category_id');
    $category_ids_placeholder = implode(',', array_fill(0, count($category_ids), '?'));

    $sql = "
        SELECT tblbooks.id, tblbooks.BookName, tblbooks.BookCover, tblauthors.AuthorName, tblcategory.CategoryName
        FROM tblbooks
        INNER JOIN tblcategory ON tblbooks.CatId = tblcategory.id
        INNER JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id
        WHERE tblbooks.CatId IN ($category_ids_placeholder)
        AND tblbooks.id NOT IN (
            SELECT BookId FROM tblissuedbookdetails WHERE StudentID = ?
        )
        LIMIT 10
    ";
    $query = $dbh->prepare($sql);

    $params = array_merge($category_ids, [$sid]);

    if ($query->execute($params)) {
        $recommended_books = $query->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($recommended_books)) {
            $response = ['status' => 'success', 'data' => $recommended_books];
        } else {
            $response['message'] = 'No recommendations available.';
        }
    } else {
        $errorInfo = $query->errorInfo();
        $response['message'] = 'Database error: ' . $errorInfo[2];
    }

} catch (PDOException $e) {
    $response['message'] = 'Database operation failed: ' . $e->getMessage();
}

echo json_encode($response);

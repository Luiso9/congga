<?php
session_start();
if (strlen($_SESSION['login']) == 0) {
    header('location:../index.php');
    exit();
}

include('../includes/config.php');

$sid = $_SESSION['stdid'];

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
    echo json_encode(['message' => 'Tidak ada rekomendasi buku, silahkan pinjam buku untuk menemukan selera anda.']);
    exit();
}

$category_ids = array_column($categories, 'category_id');

if (!empty($category_ids)) {
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

    if (!$query->execute($params)) {
        $errorInfo = $query->errorInfo();
        echo json_encode(['error' => $errorInfo[2]]);
        exit();
    }

    $recommended_books = $query->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($recommended_books)) {
        echo json_encode($recommended_books);
    } else {
        echo json_encode(['message' => 'No recommendations available.']);
    }
} else {
    echo json_encode(['message' => 'No recommendations available.']);
}
?>

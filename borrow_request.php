<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['bookId'])) {
        $userId = $_SESSION['login']; // Use email as User ID
        $bookId = htmlspecialchars($_POST['bookId']);
        $requestDate = date('Y-m-d H:i:s');

        try {
            $sql = "INSERT INTO tblborrow_requests (UserId, ISBN, RequestDate) VALUES (:userid, :isbn, :request_date)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':userid', $userId);
            $query->bindParam(':isbn', $bookId);
            $query->bindParam(':request_date', $requestDate);
            $query->execute();

            $_SESSION['success'] = "Borrow request submitted successfully.";
            echo "<script>alert('Borrow request submitted successfully.');</script>";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
            echo "<script>alert('Error: " . htmlspecialchars($e->getMessage()) . "');</script>";
        }
    }

    header('location: issued-books.php');
    exit;
}
?>

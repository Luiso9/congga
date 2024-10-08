<?php
session_start();
error_reporting(0);
include('..\includes\config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['isbn']) && isset($_POST['userid'])) {
        $isbn = htmlspecialchars($_POST['isbn']);
        $userId = htmlspecialchars($_POST['userid']);
        $issueDate = date('Y-m-d H:i:s');
        $returnDeadline = date('Y-m-d H:i:s', strtotime('+5 seconds'));

        try {
            $sql = "INSERT INTO tblissuedbookdetails (StudentId, BookId, IssuesDate, ReturnDate, ActualReturnDate) 
                    VALUES (:userid, (SELECT id FROM tblbooks WHERE ISBNNumber = :isbn), :issue_date, :return_deadline, NULL)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':userid', $userId);
            $query->bindParam(':isbn', $isbn);
            $query->bindParam(':issue_date', $issueDate);
            $query->bindParam(':return_deadline', $returnDeadline);
            $query->execute();

            $deleteSql = "DELETE FROM tblborrow_requests WHERE UserId = :userid AND ISBN = :isbn";
            $deleteQuery = $dbh->prepare($deleteSql);
            $deleteQuery->bindParam(':userid', $userId);
            $deleteQuery->bindParam(':isbn', $isbn);
            $deleteQuery->execute();

            $_SESSION['msg'] = "Borrow request confirmed and book issued successfully.";
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
    header('location: ../dashboard.php');
    exit;
}


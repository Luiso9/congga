<?php
require_once '../config/db.php';

class BookRequest {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    public function createRequest($userId, $isbn) { // Submit
        $requestDate = date('Y-m-d H:i:s');
        $sql = "INSERT INTO tblborrow_requests (UserId, ISBN, RequestDate) VALUES (:userId, :isbn, :requestDate)";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':userId', $userId);
        $query->bindParam(':isbn', $isbn);
        $query->bindParam(':requestDate', $requestDate);

        return $query->execute();
    }
}

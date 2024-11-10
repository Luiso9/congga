<?php
require_once '../connection/db.php';

class User {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    // Email check logic
    public function isEmailAvailable($email) {
        $sql = "SELECT EmailId FROM tblstudents WHERE EmailId = :email";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        return $query->rowCount() === 0; 
    }

    public function registerUser($data) { // Start Regis here?
        $countFile = '../storage/studentid.txt';
        $hits = file($countFile);
        $hits[0]++;
        file_put_contents($countFile, $hits[0]);
        $studentId = $hits[0];

        // Insert new user data
        $sql = "INSERT INTO tblstudents (StudentId, FullName, MobileNumber, EmailId, Password, Status) 
                VALUES (:StudentId, :fullname, :mobile, :email, :password, :status)";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':StudentId', $studentId, PDO::PARAM_STR);
        $query->bindParam(':fullname', $data['fullname'], PDO::PARAM_STR);
        $query->bindParam(':mobile', $data['mobileno'], PDO::PARAM_STR);
        $query->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $query->bindParam(':password', $data['password'], PDO::PARAM_STR);
        $query->bindParam(':status', $data['status'], PDO::PARAM_INT);

        if ($query->execute()) {
            return $studentId;
        }
        return false;
    }
}

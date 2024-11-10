<?php
header("Access-Control-Allow-Origin: http://localhost:5173"); // Adjust to your frontend's origin
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true"); // Allow credentials (cookies)
error_reporting(0);
include('../connnection/db.php');

if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
    echo json_encode(['error' => 'Not logged in']);
    exit();
}

$sid = $_SESSION['stdid'];

$sql = "
    SELECT 
        (SELECT COUNT(id) FROM tblissuedbookdetails WHERE StudentID = :sid) AS buku_kembali,
        (SELECT COUNT(id) FROM tblissuedbookdetails WHERE StudentID = :sid AND ReturnDate IS NULL) AS buku_dipinjam,
        Status,
        RegDate
    FROM tblstudents
    WHERE StudentId = :sid
";

$query = $dbh->prepare($sql);
$query->bindParam(':sid', $sid, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);

if ($result) {
    $response = [
        'bukukembali' => $result->buku_kembali,
        'bukudipinjam' => $result->buku_dipinjam,
        'status' => ($result->Status == 1) ? "Active" : "Blocked",
        'regDate' => date('d F Y', strtotime($result->RegDate)),
    ];
} else {
    $response = [
        'bukukembali' => 0,
        'bukudipinjam' => 0,
        'status' => "Unknown",
        'regDate' => "Unknown",
    ];
}

header('Content-Type: application/json');

echo json_encode($response);
?>

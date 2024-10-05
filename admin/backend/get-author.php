<?php
session_start();
include('..\includes\config.php');

if (isset($_GET['athrid'])) {
    $athrid = $_GET['athrid'];
    $sql = "SELECT * FROM tblauthors WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $athrid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}
?>

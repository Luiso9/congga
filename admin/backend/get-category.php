<?php
session_start();
include('..\includes\config.php');

if (isset($_GET['catid'])) {
    $catid = $_GET['catid'];

    $sql = "SELECT * FROM tblcategory WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $catid, PDO::PARAM_STR);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
}


<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else { ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Perpustakaan</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/tachyons.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    </head>

    <body class="bg-near-white black-80 sans-serif">

        <!--Nav-->
        <?php include('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="w-100 bg-center cover h5 flex items-center justify-center tc white" style="background:url(http://mrmrs.github.io/photos/u/009.jpg) no-repeat center;">
            <div class="w-100 ph4">
                <h1 class="f1 b mb2">Selamat Datang!</h1>
                <p class="f4">Manage your library activities with ease.</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="bg-near-white pv5">
            <div class="mw7 center pa4 bg-white br3 shadow-3">
                <h2 class="f3 tc mb4 black">Data Siswa</h2>

                <div class="flex justify-between items-center mb3">
                    <?php
                    $sid = $_SESSION['stdid'];
                    $sql1 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid";
                    $query1 = $dbh->prepare($sql1);
                    $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query1->execute();
                    $bukukembali = $query1->rowCount();
                    ?>
                    <span class="f5 b">Buku Dikembalikan:</span>
                    <span class="f4"><?php echo htmlentities($bukukembali); ?></span>
                </div>

                <div class="flex justify-between items-center mb3">
                    <?php
                    $sql2 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid AND ReturnDate IS NULL";
                    $query2 = $dbh->prepare($sql2);
                    $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query2->execute();
                    $bukudipinjam = $query2->rowCount();
                    ?>
                    <span class="f5 b">Buku Dipinjam:</span>
                    <span class="f4"><?php echo htmlentities($bukudipinjam); ?></span>
                </div>

                <div class="flex justify-between items-center mb3">
                    <?php
                    $sql3 = "SELECT Status FROM tblstudents WHERE StudentId=:sid";
                    $query3 = $dbh->prepare($sql3);
                    $query3->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query3->execute();
                    $result3 = $query3->fetch(PDO::FETCH_OBJ);
                    $statusText = ($result3->Status == 1) ? "Active" : "Blocked";
                    ?>
                    <span class="f5 b">Status:</span>
                    <span class="f4"><?php echo htmlentities($statusText); ?></span>
                </div>

                <div class="flex justify-between items-center">
                    <?php
                    $sql4 = "SELECT RegDate FROM tblstudents WHERE StudentId=:sid";
                    $query4 = $dbh->prepare($sql4);
                    $query4->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query4->execute();
                    $result4 = $query4->fetch(PDO::FETCH_OBJ);
                    ?>
                    <span class="f5 b">Tanggal Registrasi:</span>
                    <span class="f4"><?php echo date('d F Y', strtotime($result4->RegDate)); ?></span>
                </div>
            </div>
        </section>

        <?php include('includes/footer.php'); ?>

    </body>

    </html>
<?php } ?>
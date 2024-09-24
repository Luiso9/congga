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
        <section class="w-100 bg-center cover h5 flex items-center justify-center tc white" style="background-image: url('https://plus.unsplash.com/premium_photo-1675369009502-4125a781576a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
            <div class="w-100 ph4">
                <h1 class="f1 b mb2">Selamat Datang di... Hatimu.</h1>
                <p class="f3">Damn im so good.</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="bg-near-white pv5">
            <div class="mw8 center ph3">
                <h2 class="f2 b mb5 tc">Dashboard</h2>
                <div class="flex flex-wrap justify-center">

                    <!-- Buku Selesai Card -->
                    <div class="w-100 w-25-m w-25-l pa3">
                        <div class="tc bg-white shadow-1 pa4 br3">
                            <?php
                            $sid = $_SESSION['stdid'];
                            $sql1 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid";
                            $query1 = $dbh->prepare($sql1);
                            $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query1->execute();
                            $bukukembali = $query1->rowCount();
                            ?>
                            <h3 class="f4 mb3">Buku Selesai</h3>
                            <div class="relative">
                                <img class="w-100 h4" src="assets/img/buku_dikembalikan.jpg" alt="Buku Selesai">
                                <div class="absolute absolute--fill flex items-center justify-center bg-black-50 white f1 b o-0 hover-o-100">
                                    <?php echo htmlentities($bukukembali); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Buku Dipinjam Card -->
                    <div class="w-100 w-25-m w-25-l pa3">
                        <div class="tc bg-white shadow-1 pa4 br3">
                            <?php
                            $sql2 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid AND ReturnDate IS NULL";
                            $query2 = $dbh->prepare($sql2);
                            $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query2->execute();
                            $bukudipinjam = $query2->rowCount();
                            ?>
                            <h3 class="f4 mb3">Buku Dipinjam</h3>
                            <div class="relative">
                                <img class="w-100 h4" src="./assets/img/buku_dipinjam.jpg" alt="Buku Dipinjam">
                                <div class="absolute absolute--fill flex items-center justify-center bg-black-50 white f1 b o-0 hover-o-100">
                                    <?php echo htmlentities($bukudipinjam); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="w-100 w-25-m w-25-l pa3">
                        <div class="tc bg-white shadow-1 pa4 br3">
                            <?php
                            $sql3 = "SELECT Status FROM tblstudents WHERE StudentId=:sid";
                            $query3 = $dbh->prepare($sql3);
                            $query3->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query3->execute();
                            $result3 = $query3->fetch(PDO::FETCH_OBJ);
                            $statusText = ($result3->Status == 1) ? "Active" : "Blocked";
                            ?>
                            <h3 class="f4 mb3">Status</h3>
                            <div class="relative">
                                <img class="w-100 h4" width="50" height="50" src="https://img.icons8.com/ios/500/break--v1.png" alt="Status">
                                <div class="absolute absolute--fill flex items-center justify-center bg-black-50 white f1 b o-0 hover-o-100">
                                    <?php echo htmlentities($statusText); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Date Card -->
                    <div class="w-100 w-25-m w-25-l pa3">
                        <div class="tc bg-white shadow-1 pa4 br3">
                            <?php
                            $sql4 = "SELECT RegDate FROM tblstudents WHERE StudentId=:sid";
                            $query4 = $dbh->prepare($sql4);
                            $query4->bindParam(':sid', $sid, PDO::PARAM_STR);
                            $query4->execute();
                            $result4 = $query4->fetch(PDO::FETCH_OBJ);
                            ?>
                            <h3 class="f4 mb3">Tanggal Registrasi</h3>
                            <div class="relative">
                                <img class="w-100 h5" src="./assets/img/registration.jpg" alt="Tanggal Registrasi">
                                <div class="absolute absolute--fill flex items-center justify-center bg-black-50 white f2 b o-0 hover-o-100">
                                    <?php echo date('d F Y', strtotime($result4->RegDate)); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </body>

    </html>

<?php } ?>

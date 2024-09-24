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
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">
    </head>

    <body class="bg-base-100 text-neutral font-work-sans">

        <!--Nav-->
        <?php include('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="w-full bg-cover bg-right rounded-xl h-80 flex items-center justify-center text-center text-white" style="background-image: url('https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1600&q=80');">
            <div class="container mx-auto">
                <h1 class="text-4xl font-bold mb-2">Selamat Datang, di Numero Uno</h1>
                <p class="text-xl">konfigurasi failover menggunakan netwatch bisa dengan melakukan pengecekan secara berkala ke ip 1.1.1.1. Untuk host tujuan, bisa disesuaikan dengan kebutuhan. Bisa menggunakan IP server tertentu yang jarang Down atau offline seperti Google, dsb.</p>
            </div>
        </section>

        <!-- Dashboard Section -->
        <section class="bg-base-100 py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center">Dashboard</h2>
                <div class="flex flex-wrap justify-center gap-8">

                    <!-- Buku Selesai Card -->
                    <div class="w-full md:w-1/4 p-6 flex flex-col items-center group relative text-neutral bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                        <?php
                        $sid = $_SESSION['stdid'];
                        $sql1 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid";
                        $query1 = $dbh->prepare($sql1);
                        $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query1->execute();
                        $bukukembali = $query1->rowCount();
                        ?>
                        <h3 class="text-xl font-semibold mb-4">Buku Selesai</h3>
                        <div class="relative w-full overflow-hidden">
                            <img class="w-full h-48 object-cover" src="https://img.icons8.com/?size=100&id=jfFu3i8zJXfN&format=png" alt="Buku Selesai">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-6xl font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <?php echo htmlentities($bukukembali); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Buku Dipinjam Card -->
                    <div class="w-full md:w-1/4 p-6 flex flex-col items-center group relative text-neutral bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                        <?php
                        $sql2 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid AND ReturnDate IS NULL";
                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query2->execute();
                        $bukudipinjam = $query2->rowCount();
                        ?>
                        <h3 class="text-xl font-semibold mb-4">Buku Dipinjam</h3>
                        <div class="relative w-full overflow-hidden">
                            <img class="w-full h-48 object-cover" src="./assets/img/buku_dipinjam.jpg" alt="Buku Dipinjam">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-6xl font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <?php echo htmlentities($bukudipinjam); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Status Card -->
                    <div class="w-full md:w-1/4 p-6 flex flex-col items-center group relative text-neutral bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                        <?php
                        $sql3 = "SELECT Status FROM tblstudents WHERE StudentId=:sid";
                        $query3 = $dbh->prepare($sql3);
                        $query3->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query3->execute();
                        $result3 = $query3->fetch(PDO::FETCH_OBJ);
                        $statusText = ($result3->Status == 1) ? "Active" : "Blocked";
                        ?>
                        <h3 class="text-xl font-semibold mb-4">Status</h3>
                        <div class="relative w-full overflow-hidden">
                            <img class="w-full h-48 object-cover" src="./assets/img/status.jpg" alt="Status">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-6xl font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <?php echo htmlentities($statusText); ?>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-1/4 p-6 flex flex-col items-center group relative text-neutral bg-white rounded-lg shadow-lg hover:shadow-2xl transition duration-300">
                        <?php
                        $sql4 = "SELECT RegDate FROM tblstudents WHERE StudentId=:sid";
                        $query4 = $dbh->prepare($sql4);
                        $query4->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query4->execute();
                        $result4 = $query4->fetch(PDO::FETCH_OBJ);
                        ?>
                        <h3 class="text-xl font-semibold mb-4">Tanggal Registrasi</h3>
                        <div class="relative w-full overflow-hidden">
                            <img class="w-full h-48 object-cover" src="./assets/img/registration.jpg" alt="Tanggal Registrasi">
                            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-4xl font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <?php echo date('d F Y', strtotime($result4->RegDate)); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </body>

    </html>


<?php } ?>
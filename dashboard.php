<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else { ?>

    <body class="bg-near-white black-80 sans-serif">

        <!--Nav-->
        <?php include('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="w-100 bg-center cover h5 flex items-center justify-center tc white" style="background-image: url('./assets/img/subtle-prism.svg');">
            <div class="w-100 ph4">
                <h1 class="f1 b mb2">Selamat Datang!</h1>
                <p class="f4">Manage your library activities with ease.</p>
            </div>
        </section>


        <!-- Dashboard Section -->
        <section class="bg-near-white pv5">
            <div class="mw7 center pa4 bg-white br3 shadow-3">
                <h2 class="f3 tc mb4 black">Data Siswa</h2>

                <?php
                // Retrieve all necessary data in one query
                $sid = $_SESSION['stdid'];
                $sql = "SELECT 
                    (SELECT COUNT(id) FROM tblissuedbookdetails WHERE StudentID = :sid) AS buku_kembali,
                    (SELECT COUNT(id) FROM tblissuedbookdetails WHERE StudentID = :sid AND ReturnDate IS NULL) AS buku_dipinjam,
                    Status,
                    RegDate
                FROM tblstudents
                WHERE StudentId = :sid";

                $query = $dbh->prepare($sql);
                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_OBJ);

                // Process data
                $bukukembali = $result->buku_kembali;
                $bukudipinjam = $result->buku_dipinjam;
                $statusText = ($result->Status == 1) ? "Active" : "Blocked";
                $regDate = date('d F Y', strtotime($result->RegDate));
                ?>

                <div class="flex justify-between items-center mb3">
                    <span class="f5 b">Buku Dikembalikan:</span>
                    <span class="f4"><?php echo htmlentities($bukukembali); ?></span>
                </div>

                <div class="flex justify-between items-center mb3">
                    <span class="f5 b">Buku Dipinjam:</span>
                    <span class="f4"><?php echo htmlentities($bukudipinjam); ?></span>
                </div>

                <div class="flex justify-between items-center mb3">
                    <span class="f5 b">Status:</span>
                    <span class="f4"><?php echo htmlentities($statusText); ?></span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="f5 b">Tanggal Registrasi:</span>
                    <span class="f4"><?php echo htmlentities($regDate); ?></span>
                </div>
            </div>
        </section>


        <?php include('includes/footer.php'); ?>

    </body>

    </html>
<?php } ?>
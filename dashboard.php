<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
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
    $bukukembali = $result->buku_kembali;
    $bukudipinjam = $result->buku_dipinjam;
    $statusText = ($result->Status == 1) ? "Active" : "Blocked";
    $regDate = date('d F Y', strtotime($result->RegDate));
} else {
    $bukukembali = 0;
    $bukudipinjam = 0;
    $statusText = "Unknown";
    $regDate = "Unknown";
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">

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
    <div class="container" style="display: flex; height: 100%; width: 100%; align-items: center; justify-content: center;">
        <div class="grid" style="display: grid; height: 100%; width: 100%; grid-template-columns: repeat(3, 1fr); grid-template-rows: repeat(4, 1fr); gap: 16px; background-color: #f4f4f4; padding: 8px; border-radius: 8px;">

            <!-- Rekomedasi Section -->
            <div style="grid-column: span 3; grid-row: span 1; padding: 16px;">
                <h3>Rekomendasi Buku Untuk Kamu</h3>
                <div id="recommendations" class="horizontal-scroll" style="display: flex; gap: 16px; overflow-x: auto; scrollbar-width: 1px; scroll-behavior: smooth; padding: 8px;">
                    <!-- Books will be inserted here dynamically -->
                </div>
            </div>

            <!-- Data Siswa -->
            <div style="grid-column: span 2; grid-row: span 3; background-color: #f9f9f9; border-radius: 8px; padding: 16px; margin: 2px 0 0 26px">
                <h3>Data Siswa</h3>
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

            <!-- Complaint Form -->
            <div style="grid-column: span 1; grid-row: span 3; background-color: #02AB68; border-radius: 8px; padding: 16px;">
                <h3>Complaint Form</h3>
                <form action="submit_complaint.php" method="POST">
                    <div class="mb3">
                        <label for="complaint">Your Complaint:</label>
                        <textarea id="complaint" name="complaint" rows="3" style="width: 100%;"></textarea>
                    </div>
                    <div>
                        <button type="submit" style="padding: 8px 16px; background-color: #007bff; color: white; border: none; border-radius: 4px;">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="admin/assets/js/jquery-1.10.2.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'controller/recommendationHandler.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.message) {
                        $('#recommendations').html('<p>' + response.message + '</p>');
                    } else {
                        let html = '';
                        $.each(response, function(index, book) {
                            html += `
                            <div class="card" style="flex: 0 0 200px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1); background-color: white;">
                                <img src="${book.BookCover}" alt="${book.BookName}" style="width: 100%; height: 300px; object-fit: cover;">
                                <div class="card-content" style="padding: 16px;">
                                    <h4 class="f5 b">${book.BookName}</h4>
                                    <p class="f6">by ${book.AuthorName}</p>
                                    <p class="f7">Category: ${book.CategoryName}</p>
                                </div>
                            </div>
                        `;
                        });

                        $('#recommendations').html(html);
                    }
                },
                error: function(xhr, status, error) {
                    console.log("Error: " + error);
                    console.log("Status: " + status);
                    console.dir(xhr);
                    $('#recommendations').html('<p>Error fetching recommendations.</p>');
                }
            });
        });
    </script>

    <?php include('includes/footer.php'); ?>
</body>
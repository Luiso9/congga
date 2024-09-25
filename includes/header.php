<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <!-- Navbar -->
    <header class="bg-black-90 sticky w-100 ph3 pv3 pv2-ns ph4-m ph5-l">
        <nav class="f6 fw6 ttu tracked">
            <?php if ($_SESSION['login']) { ?>
                <a class="link dim white dib mr3" href="dashboard.php" title="Dashboard">Dashboard</a>
                <a class="link dim white dib mr3" href="issued-books.php" title="Buku Dipinjam">Buku Dipinjam</a>
                <a class="link dim white dib mr3" href="daftar-buku.php" title="Daftar Buku">Daftar Buku</a>
                <a class="link dim white dib" href="logout.php" title="Keluar">Keluar</a>

                <span class="link dim white dib ml3">
                    <?php
                    $sid = $_SESSION['stdid'];
                    $sql = "SELECT StudentId, FullName, Status FROM tblstudents WHERE StudentId=:sid";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <div class="flex items-center justify-between mb3">
                                <div class="text-right">
                                    <p class="fw6 ttu mr3 yellow"><?php echo htmlentities($result->FullName); ?></p>
                                </div>
                                <?php if ($result->Status == 1) { ?>
                                    <div class="bg-green white br-pill ph3 pv2">Active</div>
                                <?php } else { ?>
                                    <div class="bg-red white br-pill ph3 pv2">Blocked</div>
                                <?php } ?>
                            </div>
                    <?php }
                    } ?>
                </span>
            <?php } else { ?>
                <a class="link dim white dib mr3" href="adminlogin.php" title="Admin Login">Admin Login</a>
                <a class="link dim white dib mr3" href="signup.php" title="User Signup">User Signup</a>
                <a class="link dim white dib" href="index.php" title="User Login">User Login</a>
            <?php } ?>
        </nav>
    </header>
</body>

</html>
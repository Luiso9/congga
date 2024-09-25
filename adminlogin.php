<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') $_SESSION['alogin'] = ''; // Reset session if already logged in

if (isset($_POST['login'])) {
    // Captcha verification
    if ($_POST["vercode"] != $_SESSION["vercode"] || $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT UserName, Password FROM admin WHERE UserName=:username AND Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $username;
            echo "<script type='text/javascript'>document.location = 'admin/dashboard.php';</script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Admin Login - Perpustakaan</title>
    <link href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet" />
</head>

<body class="bg-light-gray">
    <!-- MENU SECTION START -->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END -->

    <div class="content-wrapper">
        <div class="container center">
            <div class="flex justify-center items-center min-vh-100">
                <div class="w-100 w-50-m w-30-l pa4 bg-white shadow-4 br3">
                    <h4 class="tc f3 fw6 dark-red mb4">ADMIN LOGIN FORM</h4>

                    <!-- LOGIN PANEL START -->
                    <form role="form" method="post">
                        <div class="mb3">
                            <label for="username" class="f6 b db mb2">Username</label>
                            <input type="text" id="username" name="username" placeholder="admin" required
                                   class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <div class="mb3">
                            <label for="password" class="f6 b db mb2">Password</label>
                            <input type="password" name="password" required
                                   class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <div class="mb3">
                            <label for="vercode" class="f6 b db mb2">Verification Code</label>
                            <input type="text" name="vercode" maxlength="5" autocomplete="off" required
                                   class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                            <img src="captcha.php" class="db mt3" alt="Captcha">
                        </div>

                        <button type="submit" name="login"
                                class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib">
                            Submit
                        </button>
                    </form>
                    <!-- LOGIN PANEL END -->
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER SECTION START -->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END -->

    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>

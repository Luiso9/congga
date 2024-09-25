<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Perpustakaan</title>
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="flex justify-center items-center">
                <div class="my-4">
                    <h4 class="header-line text-neutral">ADMIN LOGIN FORM</h4>
                </div>
            </div>

            <!--LOGIN PANEL START-->
            <form role="form" method="post">
                <div>
                    <label for="email">Email kamu</label>
                    <input type="text" id="username" name="username"
                        placeholder="cina@gmail.com" required />
                </div>
                <div class="mb-5">
                    <label for="password">Password</label>
                    <input type="password" name="password"
                        required />
                </div>
                <div class="mb-5">
                    <label>Verification code
                        <input type="text" name="vercode" maxlength="5" autocomplete="off" required />&nbsp;<img
                            src="captcha.php">
                    </label>
                </div>
                <button type="submit" name="login">Submit</button>
            </form>

        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="assets/js/custom.js"></script>
    </script>
</body>

</html>
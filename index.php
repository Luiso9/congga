<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
  $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
  if ($_POST["vercode"] != $_SESSION["vercode"] || empty($_SESSION["vercode"])) {
    echo "<script>alert('Incorrect verification code');</script>";
  } else {
    $email = $_POST['emailid'];
    $password = md5($_POST['password']); 

    // Mengecek status admin
    $sqlAdmin = "SELECT AdminEmail FROM admin WHERE AdminEmail = :email AND Password = :password";
    $queryAdmin = $dbh->prepare($sqlAdmin);
    $queryAdmin->bindParam(':email', $email, PDO::PARAM_STR);
    $queryAdmin->bindParam(':password', $password, PDO::PARAM_STR);
    $queryAdmin->execute();

    if ($queryAdmin->rowCount() > 0) {
      $_SESSION['alogin'] = $email; 
      echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
    } else {
      // Jika bukan admin tetapi akun valid, akan diarahkan sebagai siswa
      $sqlStudent = "SELECT EmailId, Password, StudentId, Status FROM tblstudents WHERE EmailId = :email AND Password = :password";
      $queryStudent = $dbh->prepare($sqlStudent);
      $queryStudent->bindParam(':email', $email, PDO::PARAM_STR);
      $queryStudent->bindParam(':password', $password, PDO::PARAM_STR);
      $queryStudent->execute();

      if ($queryStudent->rowCount() > 0) {
        foreach ($queryStudent->fetchAll(PDO::FETCH_OBJ) as $result) {
          $_SESSION['stdid'] = $result->StudentId; 
          if ($result->Status == 1) {
            $_SESSION['login'] = $email; 
            echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
          } else {
            echo "<script>alert('Your account has been blocked. Please contact admin.');</script>";
          }
        }
      } else {
        echo "<script>alert('Invalid details. Please check your email and password.');</script>";
      }
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
  <link href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet" />
  <link href="assets/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body class="bg-light-gray">
  <!-- MENU SECTION START-->

  <!-- MENU SECTION END-->

  <div class="content-wrapper">
    <div class="container center">
      <div class="flex justify-center items-center min-vh-100">
        <div class="w-100 w-50-m w-30-l pr4 pl4 pb4 bg-white shadow-4 br3">
          <h4 class="header-line f3 fw6 tc dark-red mb4">LOGIN</h4>

          <!-- LOGIN PANEL START -->
          <form role="form" method="post">
            <div class="mb3">
              <label for="email" class="f6 b db mb2">Email kamu</label>
              <input type="text" id="username" name="emailid" placeholder="cina@gmail.com" required
                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
            </div>

            <div class="mb3">
              <label for="password" class="f6 b db mb2">Password</label>
              <input type="password" name="password" required
                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
            </div>

            <div class="mb3">
              <label for="vercode" class="f6 b db mb2">Verification code</label>
              <input type="text" name="vercode" maxlength="5" autocomplete="off" required
                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
              <img src="captcha.php" class="db mt3" alt="Verification code" />
            </div>

            <button type="submit" name="login" class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib">Submit</button>
            <div class="lh-copy mt3">
              <a class="f6 link dim black db" href="signup.php">Sign up</a>
              <a class="f6 link dim black db" href="user-forgot-password.php">Forgot your password?</a>
            </div>
          </form>
          <!-- LOGIN PANEL END -->
        </div>
      </div>
    </div>
  </div>

  <!-- CONTENT-WRAPPER SECTION END -->
  <?php include('includes/footer.php'); ?>
  <!-- FOOTER SECTION END -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
</body>

</html>
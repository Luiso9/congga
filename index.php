<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['login'] != '') {
  $_SESSION['login'] = '';
}
if (isset($_POST['login'])) {
  //code for captach verification
  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('Incorrect verification code');</script>";
  } else {
    $email = $_POST['emailid'];
    $password = md5($_POST['password']);
    $sql = "SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($query->rowCount() > 0) {
      foreach ($results as $result) {
        $_SESSION['stdid'] = $result->StudentId;
        if ($result->Status == 1) {
          $_SESSION['login'] = $_POST['emailid'];
          echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
        } else {
          echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
        }
      }
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

<body class="">
  <!------MENU SECTION START-->
  <?php include('includes/header.php'); ?>
  <!-- MENU SECTION END-->

  <div class="content-wrapper">
    <div class="container mx-auto">
      <div class="flex justify-center items-center">
        <div class="my-4">
          <h4 class="header-line text-2xl font-bold text-primary">CINA DILARANG LOGIN</h4>
        </div>
      </div>

      <!--LOGIN PANEL START-->
      <form  role="form" method="post">
        <div >
          <label for="email">Email kamu</label>
          <input type="text" id="username" name="emailid"
            placeholder="cina@gmail.com" required />
        </div>
        <div class="mb-5">
          <label for="password" >Password</label>
          <input type="password" name="password"
            required />
        </div>
        <div >
          <label >Verification code</label>
          <input type="text" name="vercode" maxlength="5" autocomplete="off" required />
          <img src="captcha.php" class="mt-2" />
        </div>
        <button type="submit" name="login">Submit</button>
      </form>
      <!---LOGIN PANEL END-->
    </div>
  </div>

  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
  <!-- FOOTER SECTION END-->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- CUSTOM SCRIPTS  -->
  <script src="assets/js/custom.js"></script>
</body>

</html>
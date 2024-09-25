<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $email = $_SESSION['login'];
    $sql = "SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tblstudents set Password=:newpassword where EmailId=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Your Password successfully changed";
    } else {
      $error = "Your current password is wrong";
    }
  }
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="assets\css\style.css">
  </head>

  <body>
    <?php include('includes/header.php'); ?>

    <div>
      <div>
        <h2>Change Password</h2>

        <?php if ($error) { ?>
          <div>
            <strong>ERROR:</strong> <?php echo htmlentities($error); ?>
          </div>
        <?php } elseif ($msg) { ?>
          <div>
            <strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>

        <form mthod="post" onSubmit="return valid();" name="chngpwd" class="mt-4">
          <div class="mb-4">
            <label for="current-password">Current Password</label>
            <input type="password" name="password" id="current-password" required>
          </div>

          <div class="mb-4">
            <label for="new-password">New Password</label>
            <input type="password" name="newpassword" id="new-password" required>
          </div>

          <div class="mb-4">
            <label for="confirm-password">Confirm New Password</label>
            <input type="password" name="confirmpassword" id="confirm-password" required>
          </div>

          <button type="submit" name="change">
            Change Password
          </button>
        </form>
      </div>
    </div>

    <?php include('includes/footer.php'); ?>
    <script>
      function valid() {
        if (document.chngpwd.newpassword.value !== document.chngpwd.confirmpassword.value) {
          alert("New Password and Confirm Password fields do not match!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
  </body>

  </html>
<?php } ?>

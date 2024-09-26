<?php
session_start();
include ('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $username = $_SESSION['alogin'];
    $sql = "SELECT Password FROM admin where UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update admin set Password=:newpassword where UserName=:username";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Your Password succesfully changed";
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
    <title>Administrasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
    <style>
      .error-message {
        @apply bg-red-100 text-red-700 p-2 rounded-md;
      }

      .success-message {
        @apply bg-green-100 text-green-700 p-2 rounded-md;
      }
    </style>
  </head>

  <body>
    <?php include ('includes/header.php'); ?>

    <div >
    <div >
      <h2 >Change Password</h2>

        <?php if ($error) { ?>
          <div >
            <strong>ERROR:</strong> <?php echo htmlentities($error); ?>
          </div>
        <?php } elseif ($msg) { ?>
          <div >
            <strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>

        <form method="post" onSubmit="return valid();" name="chngpwd" >
          <div >
            <label for="current-password" >Current Password</label>
            <input type="password" name="password" id="current-password"
              
              required>
          </div>

          <div >
            <label for="new-password" >Enter New Password</label>
            <input type="password" name="newpassword" id="new-password"
              
              required>
          </div>

          <div >
            <label for="confirm-password" >Confirm New Password</label>
            <input type="password" name="confirmpassword" id="confirm-password"
              
              required>
          </div>

          <button type="submit" name="change"
            >
            Change Password
          </button>
        </form>
      </div>
    </div>


    <?php include ('includes/footer.php'); ?>
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
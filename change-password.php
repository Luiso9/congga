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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets\css\style.css">
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              primary: '#DB924B', // Primary color
              secondary: '#C27852', // Secondary color
              accent: '#A6692F', // Accent color
              neutral: '#1B1A17', // Neutral color for text and backgrounds
              'base-100': '#F7F3E3', // Base background color
              'base-200': '#EFE6D8', // Slightly darker than base-100
              'base-300': '#E1D3C3', // Slightly darker than base-200
              'base-content': '#1B1A17', // Default content color for base-100
              info: '#9AB8D5', // Info messages
              success: '#57B078', // Success messages
              warning: '#CB9442', // Warning messages
              error: '#D95C52', // Error messages
            },
          }
        }
      }
    </script>
  </head>

  <body class="bg-base-100 text-neutral">
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper container mx-auto px-4 py-8">
      <div class="max-w-md mx-auto">
        <h2 class="text-2xl font-bold text-center text-primary">Change Password</h2>

        <?php if ($error) { ?>
          <div class="bg-red-100 text-red-700 p-4 rounded-md mt-4">
            <strong>ERROR:</strong> <?php echo htmlentities($error); ?>
          </div>
        <?php } elseif ($msg) { ?>
          <div class="bg-green-100 text-green-700 p-4 rounded-md mt-4">
            <strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>

        <form method="post" onSubmit="return valid();" name="chngpwd" class="mt-4">
          <div class="mb-4">
            <label for="current-password" class="block text-sm font-medium text-neutral">Current Password</label>
            <input type="password" name="password" id="current-password" class="block w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
          </div>

          <div class="mb-4">
            <label for="new-password" class="block text-sm font-medium text-neutral">New Password</label>
            <input type="password" name="newpassword" id="new-password" class="block w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
          </div>

          <div class="mb-4">
            <label for="confirm-password" class="block text-sm font-medium text-neutral">Confirm New Password</label>
            <input type="password" name="confirmpassword" id="confirm-password" class="block w-full px-3 py-2 border border-base-300 rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm" required>
          </div>

          <button type="submit" name="change" class="w-full flex bg-primary justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-black hover:text-white hover:bg-accent focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-base-100">
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

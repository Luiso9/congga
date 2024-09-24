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

    <div class="container mx-auto px-4 py-8 min-h-screen">
    <div class="max-w-md mx-auto">
      <h2 class="text-2xl font-bold text-center">Change Password</h2>

        <?php if ($error) { ?>
          <div class="error-message mt-4">
            <strong>ERROR:</strong> <?php echo htmlentities($error); ?>
          </div>
        <?php } elseif ($msg) { ?>
          <div class="success-message mt-4">
            <strong>SUCCESS:</strong> <?php echo htmlentities($msg); ?>
          </div>
        <?php } ?>

        <form method="post" onSubmit="return valid();" name="chngpwd" class="mt-4">
          <div class="mb-4">
            <label for="current-password" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" name="password" id="current-password"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required>
          </div>

          <div class="mb-4">
            <label for="new-password" class="block text-sm font-medium text-gray-700">Enter New Password</label>
            <input type="password" name="newpassword" id="new-password"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required>
          </div>

          <div class="mb-4">
            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <input type="password" name="confirmpassword" id="confirm-password"
              class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              required>
          </div>

          <button type="submit" name="change"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-indigo-200">
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
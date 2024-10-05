<?php
session_start();
include('includes/config.php');
error_reporting(0);

require_once('controller/cpHandler.php');

?>
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

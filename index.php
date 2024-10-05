<?php
session_start();
error_reporting(0);
include('includes/config.php');

require_once('controller/loginHandler.php');
?>

<body class="bg-light-gray">
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
</body>
</html>
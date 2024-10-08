<?php
session_start();
error_reporting(0);
include('includes/config.php');

require_once('controller/fpHandler.php');

?>
<link href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet" />
<script type="text/javascript">
  function valid() {
    if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
      alert("New Password and Confirm Password Field do not match  !!");
      document.chngpwd.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>

<body>
  <div class="content-wrapper">
    <div class="container">
      <!--LOGIN PANEL START-->
      <div class="flex justify-center">
        <div class="w-100 w-50-m w-40-l pa3">
          <div class="ba b--light-silver pa3 br3 bg-near-white">
            <h3 class="header-line f3 fw6 tc dark-red mb4 josefin-sans  ">How pathetic are you?</h3>
            <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

              <!-- Email Field -->
              <div class="mb3">
                <label for="email" class="f6 b db mb2">Enter Reg Email id</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="email" name="email" required autocomplete="off" />
              </div>

              <!-- Mobile Number Field -->
              <div class="mb3">
                <label for="mobile" class="f6 b db mb2">Enter Reg Mobile No</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="text" name="mobile" required autocomplete="off" />
              </div>

              <!-- New Password Field -->
              <div class="mb3">
                <label for="newpassword" class="f6 b db mb2">Password</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="password" name="newpassword" required autocomplete="off" />
              </div>

              <!-- Confirm Password Field -->
              <div class="mb3">
                <label for="confirmpassword" class="f6 b db mb2">Confirm Password</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="password" name="confirmpassword" required autocomplete="off" />
              </div>

              <!-- Verification Code -->
              <div class="mb3">
                <label for="vercode" class="f6 b db mb2">Verification code</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="text" name="vercode" maxlength="5" autocomplete="off" required />
                <img src="captcha.php" class="db mt3" alt="Verification code" />
              </div>

              <!-- Submit Button -->
              <div class="flex justify-center">
                <button type="submit" name="change" class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib">Change Password</button>
                <span class="mh2">|</span>
                <a href="index.php" class="f6 link dim ph3 pv2 mb2 dib dark-gray">Login</a>
              </div>

            </form>
          </div>
        </div>
      </div>
      <!---LOGIN PABNEL END-->
    </div>
  </div>
  <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php'); ?>
</body>
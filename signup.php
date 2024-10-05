<?php
session_start();
include('includes/config.php');
error_reporting(0);

require_once('controller/signupHandler.php');
?>


<link href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet" />

<script type="text/javascript">
    function valid() {
        if (document.signup.password.value != document.signup.confirmpassword.value) {
            alert("Password and Confirm Password do not match!");
            document.signup.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>
<script>
    function checkAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'emailid=' + $("#emailid").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
</script>

<body class="bg-near-white">
    <div class="content-wrapper">
        <div class="container center">
            <div class="flex justify-center items-center min-vh-100">
                <div class="w-100 w-50-m w-30-l pa4 bg-white shadow-4 br3">
                    <h4 class="header-line f3 fw6 tc dark-red">SIGN UP</h4>
                    <hr>

                    <!-- Sign Up Form -->
                    <form name="signup" role="form" onSubmit="return valid();" method="POST">
                        <!-- Full Name -->
                        <div class="mb3">
                            <label for="fullanme" class="f6 b db mb2">Nama Lengkap</label>
                            <input type="text" name="fullanme" id="fullanme" autocomplete="off" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <!-- Nomer Hp -->
                        <div class="mb3">
                            <label for="mobileno" class="f6 b db mb2">No. Hp</label>
                            <input type="text" name="mobileno" id="mobileno" maxlength="10" autocomplete="off" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <!-- Email -->
                        <div class="mb3">
                            <label for="email" class="f6 b db mb2">Email</label>
                            <input type="email" name="email" id="emailid" placeholder="cina@gmail.com" onBlur="checkAvailability()" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                            <span id="user-availability-status" class="f6 mt2 red"></span>
                        </div>

                        <!-- Password -->
                        <div class="mb3">
                            <label for="password" class="f6 b db mb2">Password</label>
                            <input type="password" name="password" id="password" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb3">
                            <label for="confirmpassword" class="f6 b db mb2">Confirm Password</label>
                            <input type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <!-- Verification Code -->
                        <div class="mb3">
                            <label for="vercode" class="f6 b db mb2">Verification Code</label>
                            <img src="captcha.php" alt="Verification Code" class="db mt3">
                            <input type="text" name="vercode" id="vercode" maxlength="5" autocomplete="off" required
                                class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mb3">
                            <button type="submit" name="signup"
                                class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib">Register Now</button>
                        </div>

                        <!-- Links -->
                        <div class="lh-copy mt3">
                            <a class="f6 link dim black db" href="index.php">Login</a>
                            <a class="f6 link dim black db" href="user-forgot-password.php">Forgot your password?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
</body>
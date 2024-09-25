<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {
    //code for captcha verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        //Code for student ID
        $count_my_page = ("studentid.txt");
        $hits = file($count_my_page);
        $hits[0]++;
        $fp = fopen($count_my_page, "w");
        fputs($fp, "$hits[0]");
        fclose($fp);
        $StudentId = $hits[0];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;
        $sql = "INSERT INTO  tblstudents(StudentId, FullName, MobileNumber, EmailId, Password, Status) 
                VALUES(:StudentId, :fname, :mobileno, :email, :password, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':StudentId', $StudentId, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Your Registration successful and your student id is $StudentId');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
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
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
                success: function (data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>
</head>

<body class="bg-near-white">
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container center">
            <div class="flex justify-center items-center">
                <div class="my-4">
                    <h4 class="f3 fw6 dark-red tc">USER SIGN UP</h4>
                </div>
            </div>

            <div class="w-100 w-50-m w-30-l center pa4 bg-white br3 shadow-3">
                <form name="signup" method="post" onSubmit="return valid();">
                    <div class="mb3">
                        <label for="fullanme" class="f6 b db mb2">Full Name</label>
                        <input type="text" name="fullanme" id="fullanme" autocomplete="off" required
                            class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                    </div>

                    <div class="mb3">
                        <label for="mobileno" class="f6 b db mb2">Mobile Number</label>
                        <input type="text" name="mobileno" id="mobileno" maxlength="10" autocomplete="off" required
                            class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                    </div>

                    <div class="mb3">
                        <label for="emailid" class="f6 b db mb2">Email</label>
                        <input type="email" name="email" id="emailid" onBlur="checkAvailability()" autocomplete="off"
                            required class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                        <span id="user-availability-status" class="f6 mt2 red"></span>
                    </div>

                    <div class="mb3">
                        <label for="password" class="f6 b db mb2">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required
                            class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                    </div>

                    <div class="mb3">
                        <label for="confirmpassword" class="f6 b db mb2">Confirm Password</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required
                            class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                    </div>

                    <div class="mb3">
                        <label for="vercode" class="f6 b db mb2">Verification Code</label>
                        <img src="captcha.php" alt="CAPTCHA Image" class="db mt2">
                        <input type="text" name="vercode" id="vercode" maxlength="5" autocomplete="off" required
                            class="input-reset ba b--black-20 pa2 mb2 db w-100" />
                    </div>

                    <button type="submit" name="signup"
                        class="b ph3 pv2 input-reset ba b--black bg-transparent grow pointer f6 dib">Register
                        Now</button>
                </form>
            </div>
        </div>
    </div>

    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
</body>

</html>

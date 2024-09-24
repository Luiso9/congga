<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (isset($_POST['signup'])) {
    //code for captach verification
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
        $sql = "INSERT INTO  tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
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
            echo '<script>alert("Your Registration successfull and your student id is  "+"' . $StudentId . '")</script>';
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
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match  !!");
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
    <script> // Warna teks input form
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#DB924B', // Primary color
                        secondary: '#C27852', // Secondary color
                        accent: '#A6692F', // Accent color
                        asli: '#1B1A17', // Neutral color for text and backgrounds
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

<body class="bg-base-100 text-asli">
    <!------MENU SECTION START-->
    <?php include('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="flex justify-center items-center">
                <div class="my-4">
                    <h4 class="header-line">USER SIGN UP</h4>
                </div>
            </div>

        </div>
        <div class="max-w-xl p-5 mt-5 mx-auto shadow-md">
            <div class="mb-5">
                <div class="panel panel-danger">
                    <div class="panel-body">
                        <form name="signup" method="post" onSubmit="return valid();">
                            <div class="mb-5">
                                <label for="fullanme" class="block mb-2 text-sm font-medium text-gray-900">Enter
                                    Full Name</label>
                                <input type="text" name="fullanme" id="fullanme" autocomplete="off" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="mb-5">
                                <label for="mobileno" class="block mb-2 text-sm font-medium text-gray-900">Mobile
                                    Number</label>
                                <input type="text" name="mobileno" id="mobileno" maxlength="10" autocomplete="off"
                                    required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="mb-5">
                                <label for="emailid" class="block mb-2 text-sm font-medium text-gray-900">Enter
                                    Email</label>
                                <input type="email" name="email" id="emailid" onBlur="checkAvailability()"
                                    autocomplete="off" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                                <span id="user-availability-status" style="font-size:12px;"></span>
                            </div>
                            <div class="mb-5">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Enter
                                    Password</label>
                                <input type="password" name="password" id="password" autocomplete="off" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="mb-5">
                                <label for="confirmpassword"
                                    class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
                                <input type="password" name="confirmpassword" id="confirmpassword" autocomplete="off"
                                    required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="mb-5">
                                <label for="vercode" class="block mb-2 text-sm font-medium text-gray-900">Verification
                                    code</label>
                                <img src="captcha.php" alt="CAPTCHA Image" class="rounded-md mb-2 inline-block">
                                <input type="text" name="vercode" id="vercode" maxlength="5" autocomplete="off" required
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20 p-2" />
                            </div>
                            <button type="submit" name="signup"
                                class="bg-primary hover:bg-secondary text-white focus:ring-4 focus:outline-none focus:bg-accent font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center" href="index.php">Register
                                Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
</body>

</html>
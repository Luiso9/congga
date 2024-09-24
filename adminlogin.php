<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['alogin'] != '') {
    $_SESSION['alogin'] = '';
}
if (isset($_POST['login'])) {
    //code for captach verification
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {

        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            $_SESSION['alogin'] = $_POST['username'];
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            echo "<script>alert('Invalid Details');</script>";
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
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script>
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
                    <h4 class="header-line text-neutral">ADMIN LOGIN FORM</h4>
                </div>
            </div>

            <!--LOGIN PANEL START-->
            <form class="max-w-md p-5 mt-5 mx-auto shadow-md" role="form" method="post">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email kamu</label>
                    <input type="text" id="username" name="username"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="cina@gmail.com" required />
                </div>
                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium">Password</label>
                    <input type="password" name="password"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required />
                </div>
                <div class="mb-5">
                    <label class="block mb-2 text-sm font-medium text-gray-900">Verification code
                        <input type="text" name="vercode" maxlength="5" autocomplete="off" required
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-20 p-2" />&nbsp;<img
                            src="captcha.php">
                    </label>
                </div>
                <button type="submit" name="login"
                    class="bg-primary hover:bg-secondary text-white focus:ring-4 focus:outline-none focus:bg-accent font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
            </form>

        </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="assets/js/custom.js"></script>
    </script>
</body>

</html>
<?php
session_start();
include('includes/config.php');
error_reporting(0);
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['stdid'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];

        $sql = "update tblstudents set FullName=:fname,MobileNumber=:mobileno where StudentId=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Profil mu sudah siap!!!")</script>';
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
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <body class="bg-base-100 text-neutral">
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container mx-auto py-8">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line text-2xl font-bold text-primary">Profil</h4>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="flex items-center justify-center bg-primary p-6">
                        <img class="h-24 w-24 rounded-full border-4 border-white" src="https://picsum.photos/150" alt="User Profile Picture">
                    </div>
                    <div class="p-6">
                        <?php
                        $sid = $_SESSION['stdid'];
                        $sql = "SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from tblstudents where StudentId=:sid ";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Student ID:</label>
                                    <p class="text-base-content"><?php echo htmlentities($result->StudentId); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Reg Date:</label>
                                    <p class="text-base-content"><?php echo htmlentities($result->RegDate); ?></p>
                                </div>
                                <?php if ($result->UpdationDate != "") { ?>
                                    <div class="mb-4">
                                        <label class="block text-neutral font-bold">Last Updation Date:</label>
                                        <p class="text-base-content"><?php echo htmlentities($result->UpdationDate); ?></p>
                                    </div>
                                <?php } ?>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Profile Status:</label>
                                    <p class="text-base-content">
                                        <?php if ($result->Status == 1) { ?>
                                            <span class="text-success font-semibold">Active</span>
                                        <?php } else { ?>
                                            <span class="text-error font-semibold">Blocked</span>
                                        <?php } ?>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Nama Lengkap:</label>
                                    <p class="text-base-content"><?php echo htmlentities($result->FullName); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Telp:</label>
                                    <p class="text-base-content"><?php echo htmlentities($result->MobileNumber); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-neutral font-bold">Enter Email:</label>
                                    <p class="text-base-content"><?php echo htmlentities($result->EmailId); ?></p>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="text-center mt-8">
                    <a href="edit-profile.php" class="bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded-full">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
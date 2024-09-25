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
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <body>
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
                <div>
                    <div>
                        <img src="https://picsum.photos/150" alt="User Profile Picture">
                    </div>
                    <div>
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
                                    <label>Student ID:</label>
                                    <p><?php echo htmlentities($result->StudentId); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label>Reg Date:</label>
                                    <p><?php echo htmlentities($result->RegDate); ?></p>
                                </div>
                                <?php if ($result->UpdationDate != "") { ?>
                                    <div class="mb-4">
                                        <label>Last Updation Date:</label>
                                        <p><?php echo htmlentities($result->UpdationDate); ?></p>
                                    </div>
                                <?php } ?>

                                <div class="mb-4">
                                    <label>Profile Status:</label>
                                    <p>
                                        <?php if ($result->Status == 1) { ?>
                                            <span>Active</span>
                                        <?php } else { ?>
                                            <span>Blocked</span>
                                        <?php } ?>
                                    </p>
                                </div>

                                <div>
                                    <label>Nama Lengkap:</label>
                                    <p><?php echo htmlentities($result->FullName); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label>Telp:</label>
                                    <p><?php echo htmlentities($result->MobileNumber); ?></p>
                                </div>

                                <div class="mb-4">
                                    <label>Enter Email:</label>
                                    <p><?php echo htmlentities($result->EmailId); ?></p>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </div>

                <!-- Edit Profile Button -->
                <div class="text-center mt-8">
                    <a href="edit-profile.php">
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
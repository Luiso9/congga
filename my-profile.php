<?php
session_start();
include ('includes/config.php');
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
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body data-theme="light">
        <!------MENU SECTION START-->
        <?php include ('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container mx-auto">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Profil</h4>
                    </div>
                </div>
            </div>

            <!-- Batas -->
            <section class="container mx-auto flex justify-center items-center">
                <div class="card shadow-xl bg-indigo-400 image-full min-w-max group">
                    <figure class="duration-300 transition blur-none ease-in-out group-hover:blur-md group-hover:duration-500">
                        <img src="https://media.discordapp.net/attachments/809988356611112980/1270696869940428922/wallhaven-zxkpyy.jpg?ex=66b4a42e&is=66b352ae&hm=9e72c0ecbf6c529e375b104665c16d8835b713a1f13efacce1aef58642c6037c&=&format=webp&width=663&height=442"
                            alt="Shoes" />
                    </figure>

                    <div class="card-body">
                        <?php
                        $sid = $_SESSION['stdid'];
                        $sql = "SELECT StudentId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblstudents  where StudentId=:sid ";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>

                                <div class="join">
                                    <label class="join-item mx-5 font-bold text-indigo-400">Student ID : </label>
                                    <?php echo htmlentities($result->StudentId); ?>
                                </div>

                                <div class="join">
                                    <label class="join-item mx-5 font-bold">Reg Date : </label>
                                    <?php echo htmlentities($result->RegDate); ?>
                                </div>
                                <?php if ($result->UpdationDate != "") { ?>
                                    <div class="join-item mx-5">
                                        <label class="font-bold">Last Updation Date : </label>
                                        <?php echo htmlentities($result->UpdationDate); ?>
                                    </div>
                                <?php } ?>


                                <div class="join">
                                    <label class="join-item mx-5 font-bold">Profile Status : </label>
                                    <?php if ($result->Status == 1) { ?>
                                        <span style="color: green">Active</span>
                                    <?php } else { ?>
                                        <span style="color: red">Blocked</span>
                                    <?php } ?>
                                </div>


                                <div class="join">
                                    <label class="join-item mx-5 font-bold">Nama Lengkap : </label>
                                    <?php echo htmlentities($result->FullName); ?>
                                </div>


                                <div class="join">
                                    <label class="join-item mx-5 font-bold">Telp :</label>
                                    <?php echo htmlentities($result->MobileNumber); ?>
                                </div>

                                <div class="join">
                                    <label class="join-item mx-5 font-bold">Enter Email :</label>
                                    <?php echo htmlentities($result->EmailId); ?>
                                </div>
                            <?php }
                        } ?>
            </section>

            <!-- Batas -->
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include ('includes/footer.php'); ?>
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
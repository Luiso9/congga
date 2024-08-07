<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Online Library Management System | Admin Dash Board</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include ('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
            <div class="container mx-auto">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">ADMIN DASHBOARD</h4>
                    </div>
                </div>

        <!-- Start -->

        <section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4 text-center">
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sql = "SELECT id from tblbooks ";
                  $query = $dbh->prepare($sql);
                  $query->execute();
                  $results = $query->fetchAll(PDO::FETCH_OBJ);
                  $listdbooks = $query->rowCount();
                  ?>
                  <?php echo htmlentities($listdbooks); ?>
                </h2>
                <p class="leading-relaxed">Buku tersedia</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sql1 = "SELECT id from tblissuedbookdetails ";
                  $query1 = $dbh->prepare($sql1);
                  $query1->execute();
                  $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                  $issuedbooks = $query1->rowCount();
                  ?>
                  <?php echo htmlentities($issuedbooks); ?>
                </h2>
                <p class="leading-relaxed">Total berapa buku telah dipinjam</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $status = 1;
                  $sql2 = "SELECT id from tblissuedbookdetails where RetrunStatus=:status";
                  $query2 = $dbh->prepare($sql2);
                  $query2->bindParam(':status', $status, PDO::PARAM_STR);
                  $query2->execute();
                  $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                  $returnedbooks = $query2->rowCount();
                  ?>
                  <?php echo htmlentities($returnedbooks); ?>
                </h2>
                <p class="leading-relaxed">Total berapa buku dikembalikan</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sql3 = "SELECT id from tblstudents ";
                  $query3 = $dbh->prepare($sql3);
                  $query3->execute();
                  $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                  $regstds = $query3->rowCount();
                  ?>
                  <?php echo htmlentities($regstds); ?>
                </h2>
                <p class="leading-relaxed">User ter-register</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sql4 = "SELECT id from tblauthors";
                  $query4 = $dbh->prepare($sql4);
                  $query4->execute();
                  $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
                  $listdathrs = $query4->rowCount();
                  ?>
                  <?php echo htmlentities($listdathrs); ?>
                </h2>
                <p class="leading-relaxed">Authors terlist</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sql5 = "SELECT CategoryName from tblcategory ";
                  $query5 = $dbh->prepare($sql5);
                  $query5->execute();
                  $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
                  $listdcats = $query5->rowCount();
                  ?>
                  <?php echo htmlentities($listdcats); ?>
                </h2>
                <p class="leading-relaxed">Kategori terlist</p>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <!-- CONTENT-WRAPPER SECTION END-->
    <?php include ('includes/footer.php'); ?>
    <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
  </body>

  </html>
<?php } ?>
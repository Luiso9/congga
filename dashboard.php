<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>
  <!DOCTYPE html>
  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css" />
    <script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              'hover-fill': '#ff6347',
            }
          }
        }
      }
    </script>
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
      .fill-transition {
        transition: fill 0.3s ease;
      }
    </style>
  </head>

  <body>
    <!------MENU SECTION START-->
    <?php include ('includes/header.php'); ?>
    <!-- MENU SECTION END-->
    <div class="content-wrapper">
      <div class="container mx-auto">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line font-bold">ADMIN DASHBOARD</h4>
          </div>
        </div>

        <section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4 text-center">
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                <?php
                  $sid = $_SESSION['stdid'];
                  $sql1 = "SELECT id from tblissuedbookdetails where StudentID=:sid";
                  $query1 = $dbh->prepare($sql1);
                  $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query1->execute();
                  $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                  $bukukembali = $query1->rowCount();
                  ?>
                  <?php echo htmlentities($bukukembali); ?>
                </h2>
                <p class="leading-relaxed mt-2">Buku Dikembalikan</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sid = $_SESSION['stdid'];
                  $sql1 = "SELECT id FROM tblissuedbookdetails WHERE StudentID=:sid AND ReturnDate IS NULL";
                  $query1 = $dbh->prepare($sql1);
                  $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query1->execute();
                  $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                  $bukudipinjam = $query1->rowCount();
                  ?>
                  <?php echo htmlentities($bukudipinjam); ?>
                </h2>
                <p class="leading-relaxed mt-2">Total buku dipinjam</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sid = $_SESSION['stdid'];
                  $sql1 = "SELECT RegDate, Status FROM tblstudents WHERE StudentId=:sid";
                  $query1 = $dbh->prepare($sql1);
                  $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query1->execute();
                  $result1 = $query1->fetch(PDO::FETCH_OBJ);
                  ?>
                  <?php echo date('d F Y', strtotime($result1->RegDate)); ?>
                </h2>
                <p class="leading-relaxed mt-2">Tanggal Registerasi</p>
              </div>
              <div class="p-4 sm:w-1/4 w-1/2">
                <h2 class="title-font font-medium sm:text-4xl text-3xl text-gray-900">
                  <?php
                  $sid = $_SESSION['stdid'];
                  $sql1 = "SELECT Status FROM tblstudents WHERE StudentId=:sid";
                  $query1 = $dbh->prepare($sql1);
                  $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
                  $query1->execute();
                  $result1 = $query1->fetch(PDO::FETCH_OBJ);

                  $statusText = ($result1->Status == 1) ? "Active" : "Blocked";
                  ?>
                  <?php echo htmlentities($statusText); ?>
                </h2>
                <p class="leading-relaxed mt-2">Status</p>
              </div>
            </div>
          </div>
        </section>

        <!-- Blog post, untuk memberikan opsi buku yang baru saja ditambahkan -->
        <section class="text-gray-600 body-font">
          <div class="container px-5 py-24 mx-auto">
            <h4 class="header-line text-md font-bold mb-5">BUKU BARU SAJA DITAMBAHKAN</h4>
            <div class="flex flex-wrap -m-4">
              <?php
              $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.BookPrice, tblbooks.RegDate 
              FROM tblbooks 
              JOIN tblcategory ON tblbooks.CatId = tblcategory.id 
              JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id 
              ORDER BY tblbooks.id DESC LIMIT 3";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <div class="p-4 lg:w-1/3 group">
                    <div
                      class="transform h-full bg-indigo-400 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative transition duration-500 hover:scale-125 hover:z-10">
                      <h2 class="tracking-widest text-xs title-font font-medium text-white mb-1">
                        <?php echo htmlentities($result->CategoryName); ?>
                      </h2>
                      <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">
                        <?php echo htmlentities($result->BookName); ?>
                      </h1>
                      <p class="leading-relaxed mb-3"><?php echo htmlentities($result->BookDescription); ?></p>
                      <div class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
                        <span
                          class="text-gray-700 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                          <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg><?php echo htmlentities($result->AuthorName); ?>
                        </span>
                        <span class="text-gray-900 inline-flex items-center leading-none text-sm">
                          <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" viewBox="0 0 24 24">
                            <path
                              d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                            </path>
                          </svg><?php echo date('d M Y', strtotime($result->RegDate)); ?>
                        </span>
                      </div>
                    </div>
                  </div>
                <?php }
              } ?>
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
    <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
  </body>

  </html>
<?php } ?>
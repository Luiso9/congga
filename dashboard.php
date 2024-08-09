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
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap"
      rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css" />
    <script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              blue: '#2e3440',
              'dark-blue': '#3b4252',
              'slate-blue': '#434c5e',
              gray: '#4c566a',
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
    <!-- MENU SECTION START-->
    <?php include ('includes/header.php'); ?>
    <!-- MENU SECTION END-->

    <div class="content">
      <div class="container mx-auto py-12">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line font-bold text-3xl text-gray-800">ADMIN DASHBOARD</h4>
          </div>
        </div>

        <section class="text-gray-600 body-font">
          <div class="grid grid-cols-2 gap-8 my-12">
            <!-- Buku Dikembalikan -->
            <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl">
              <h2 class="text-4xl font-bold text-gray-800">
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
              <p class="leading-relaxed mt-2 text-gray-600">Buku Dikembalikan</p>
            </div>

            <!-- Total Buku Dipinjam -->
            <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl">
              <h2 class="text-4xl font-bold text-gray-800">
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
              <p class="leading-relaxed mt-2 text-gray-600">Total Buku Dipinjam</p>
            </div>

            <!-- Tanggal Registrasi -->
            <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl">
              <h2 class="text-4xl font-bold text-gray-800">
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
              <p class="leading-relaxed mt-2 text-gray-600">Tanggal Registrasi</p>
            </div>

            <!-- Status -->
            <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl">
              <h2 class="text-4xl font-bold text-<?php echo $result1->Status == 1 ? 'green-600' : 'red-600'; ?>">
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
              <p class="leading-relaxed mt-2 text-gray-600">Status</p>
            </div>
          </div>
        </section>

        <!-- Buku yang baru saja ditambahkan -->
        <section class="text-gray-600 body-font" style="font-family:'Manrope', sans-serif">
          <div class="container px-5 py-24 mx-auto">
            <h4 class="header-line text-md font-bold mb-5 text-gray-800">BUKU YANG BARU SAJA DITAMBAHKAN</h4>
            <div class="flex flex-wrap -m-4">
              <?php
              $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.BookPrice, tblbooks.RegDate, tblbooks.BookCover
              FROM tblbooks 
              JOIN tblcategory ON tblbooks.CatId = tblcategory.id 
              JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id 
              ORDER BY tblbooks.id DESC LIMIT 4";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              if ($query->rowCount() > 0) {
                foreach ($results as $result) { ?>
                  <div class="p-4 sm:w-1/2 md:w-1/3 lg:w-1/4 gap-2">
                    <div class="group h-96 w-64 [perspective:1000px] mx-auto">
                      <div
                        class="relative h-full w-full rounded-xl shadow-xl transition-all duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <!-- Harus e penampilan depan (Sebelum card di hover akan menampilkan gambar berikut)-->
                        <div class="absolute inset-0">
                          <?php
                          $imagePath = htmlentities($result->BookCover);
                          echo "<img class='h-full w-full rounded-xl object-cover shadow-xl shadow-black/40 [backface-visibility:hidden]' src='admin/$imagePath' alt='Book Cover' />";
                          ?>
                        </div>
                        <!-- Mana lagi kalau bukan belakang (dan ini setelahnya)-->
                        <div
                          class="absolute inset-0 h-full w-full rounded-xl bg-black/80 px-4 py-6 text-center text-slate-200 [backface-visibility:hidden] [transform:rotateY(180deg)]">
                          <div class="flex flex-col justify-center h-full">
                            <h1 class="text-xl font-bold mb-2">
                              <?php echo htmlentities($result->BookName); ?>
                            </h1>
                            <h2 class="text-sm font-semibold mb-4">
                              <?php echo htmlentities($result->CategoryName); ?>
                            </h2>
                            <p class="text-sm font-semibold text-left">Author:</p>
                            <ul class="list-none mb-4">
                              <li class="text-xs text-left">
                                <?php echo htmlentities($result->AuthorName); ?>
                              </li>
                            </ul>
                            <p class="text-sm font-semibold text-left">Ditambahkan pada:</p>
                            <ul class="list-none mb-4">
                              <li class="text-xs text-left">
                                <?php echo htmlentities($result->RegDate); ?>
                              </li>
                            </ul>
                            <p class="text-sm font-semibold text-left">Harga:</p>
                            <ul class="list-none mb-4">
                              <li class="text-xs text-left">
                                <?php echo htmlentities($result->BookPrice); ?>k
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }
              } ?>
            </div>
          </div>
        </section>



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
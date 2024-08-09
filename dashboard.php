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
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700&display=swap"
      rel="stylesheet" />
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
        <section class="text-gray-600 body-font" style="font-family:'Manrope', sans-serif">
          <div class="container px-5 py-24 mx-auto">
            <h4 class="header-line text-md font-bold mb-5">BUKU YANG BARU SAJA DITAMBAHKAN</h4>
            <div class="flex flex-wrap -m-4">
              <?php
              $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.BookPrice, tblbooks.RegDate, tblbooks.BookCover
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
                    <div class="group h-96 w-64 [perspective:1000px] mx-auto">
                      <div
                        class="relative h-full w-full rounded-xl shadow-xl transition-all duration-500 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <div class="absolute inset-0">
                          <img class="h-full w-full rounded-xl object-cover shadow-xl shadow-black/40 blur-md"
                            src="https://picsum.photos/id/870/200/300?grayscale&blur=2?random=2"
                            alt="<?php echo htmlentities($result->BookName); ?>" />
                        </div>
                        <div
                          class="absolute p-4 inset-0 h-full w-full rounded-xl bg-black/80 px-12 text-center text-slate-200 [backface-visibility:hidden] [transform:rotateY(180deg)]">
                          <div class="flex flex-col justify-around gap-6">
                            <div>
                              <h1 class="text-xl font-bold"><?php echo htmlentities($result->BookName); ?></h1>
                              <h2 class="text-sm font-semibold"><?php echo htmlentities($result->CategoryName); ?></h2>
                            </div>
                            <div>
                              <p class="text-sm font-semibold text-left">Author:</p>
                              <ul class="list-none">
                                <li class="text-xs text-left"><?php echo htmlentities($result->AuthorName); ?></li>
                              </ul>
                            </div>
                            <button class="w-full mt-2 rounded-xl bg-neutral-800 px-2 py-1 text-sm hover:bg-neutral-900/60"><a
                                href="#" target="_blank">More Info</a></button>
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
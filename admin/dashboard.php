<?php
session_start();
error_reporting(0);
include('includes/config.php');
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
        <title>Administrasi Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#DB924B', // Primary color
                            secondary: '#C27852', // Secondary color
                            accent: '#A6692F', // Accent color
                            neutral: '#1B1A17', // Neutral color for text and backgrounds
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

    <body class="bg-base-100 text-neutral">
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper ">
            <div class="container mx-auto">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Administrasi</h4>
                    </div>
                </div>

                <!-- Start Data Stastitik -->
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

                <!-- Card Baru -->
                <!-- <section class="relative min-h-screen flex flex-col justify-center bg-base-100 overflow-hidden text-neutral">
                    <div class="grid grid-cols-3 grid-rows-3 place-items-center gap-4">
                        <div class="bg-gradient-to-t from-red-200 to-neutral-200 rounded-lg shadow-md w-96 h-24 border border-red-900">
                            <div class="text-center p-4">4</div>
                            <div class="text-center p-2">Buku Tersedia</div>
                        </div>
                        <div class="w-96 h-24 border border-red-900">Buku telah dipinjam</div>
                        <div class="row-span-3 w-96 h-80 border border-red-900">
                            <div class="">Buku dikembalikan</div>
                        </div>
                        <div class="w-96 h-24 border border-red-900">Siswa terdaftar</div>
                        <div class="w-96 h-24 border border-red-900">Author terdaftar</div>
                        <div class="col-span-2 row-start-3 border border-red-900 w-[56.5rem] h-24">Kategori terdaftar</div>
                    </div>
                </section> -->

                <!-- Start recent user -->
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-24 mx-auto">
                        <h4 class="header-line text-md font-bold mb-5">MURID YANG BARU SAJA MEMINJAM BUKU</h4>
                        <div class="flex flex-wrap -m-4">
                            <?php
                            $sql = "SELECT tblissuedbookdetails.IssuesDate, tblissuedbookdetails.StudentId, tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName 
							FROM tblissuedbookdetails 
							JOIN tblbooks ON tblissuedbookdetails.BookId = tblbooks.id 
							JOIN tblcategory ON tblbooks.CatId = tblcategory.id 
							JOIN tblauthors ON tblbooks.AuthorId = tblauthors.id 
							ORDER BY tblissuedbookdetails.id DESC LIMIT 3";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <div class="p-4 lg:w-1/3 group">
                                        <div
                                            class="transform h-full shadow-xl mx-6 bg-blue-500 bg-opacity-75 px-8 pt-16 pb-24 rounded-lg overflow-hidden text-center relative transition duration-500 hover:scale-125 hover:z-10">
                                            <h2 class="tracking-widest text-xs title-font font-medium text-white mb-1">
                                                <?php echo htmlentities($result->CategoryName); ?>
                                            </h2>
                                            <h1 class="title-font sm:text-2xl text-xl font-medium text-gray-900 mb-3">
                                                <?php echo htmlentities($result->BookName); ?>
                                            </h1>
                                            <p class="leading-relaxed mb-3"><?php echo htmlentities($result->AuthorName); ?></p>
                                            <div
                                                class="text-center mt-2 leading-none flex justify-center absolute bottom-0 left-0 w-full py-4">
                                                <span
                                                    class="text-gray-700 mr-3 inline-flex items-center leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    <?php
                                                    $sid = $_SESSION['stdid'];
                                                    $sql = "SELECT FullName, Status FROM tblstudents WHERE StudentId = :sid";
                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                    $query->execute();
                                                    $result = $query->fetch(PDO::FETCH_OBJ);
                                                    ?>

                                                    <?php if ($result) { ?>
                                                        <?php echo htmlentities($result->FullName); ?>
                                                    <?php } else { ?>
                                                        <?php echo "Gagal menggambil nama murid!"; ?>
                                                    <?php } ?>
                                                </span>
                                                <span class="text-gray-900 inline-flex items-center leading-none text-sm">
                                                    <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                                        <path
                                                            d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                                        </path>
                                                    </svg><?php echo htmlentities($result->IssuesDate); ?>
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
        <?php include('includes/footer.php'); ?>
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
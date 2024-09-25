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
        <title>Administrasi Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <body class="bg-light-gray black">
        <?php include('includes/header.php'); ?>
        <div class="content-wrapper ">
            <div class="container mw9 center">
                <div class="pa4">
                    <h4 class="f3">Administrasi</h4>
                </div>

                <!-- Start Data Stastitik -->
                <section class="pa4">
                    <div class="flex flex-wrap justify-between">
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $sql = "SELECT id from tblbooks ";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $listdbooks = $query->rowCount();
                                echo htmlentities($listdbooks);
                                ?>
                            </h2>
                            <p class="f6">Buku tersedia</p>
                        </div>
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $sql1 = "SELECT id from tblissuedbookdetails ";
                                $query1 = $dbh->prepare($sql1);
                                $query1->execute();
                                $issuedbooks = $query1->rowCount();
                                echo htmlentities($issuedbooks);
                                ?>
                            </h2>
                            <p class="f6">Total berapa buku telah dipinjam</p>
                        </div>
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $status = 1;
                                $sql2 = "SELECT id from tblissuedbookdetails where RetrunStatus=:status";
                                $query2 = $dbh->prepare($sql2);
                                $query2->bindParam(':status', $status, PDO::PARAM_STR);
                                $query2->execute();
                                $returnedbooks = $query2->rowCount();
                                echo htmlentities($returnedbooks);
                                ?>
                            </h2>
                            <p class="f6">Total berapa buku dikembalikan</p>
                        </div>
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $sql3 = "SELECT id from tblstudents ";
                                $query3 = $dbh->prepare($sql3);
                                $query3->execute();
                                $regstds = $query3->rowCount();
                                echo htmlentities($regstds);
                                ?>
                            </h2>
                            <p class="f6">User ter-register</p>
                        </div>
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $sql4 = "SELECT id from tblauthors";
                                $query4 = $dbh->prepare($sql4);
                                $query4->execute();
                                $listdathrs = $query4->rowCount();
                                echo htmlentities($listdathrs);
                                ?>
                            </h2>
                            <p class="f6">Authors terlist</p>
                        </div>
                        <div class="w-100 w-25-ns pa2">
                            <h2 class="f2">
                                <?php
                                $sql5 = "SELECT CategoryName from tblcategory ";
                                $query5 = $dbh->prepare($sql5);
                                $query5->execute();
                                $listdcats = $query5->rowCount();
                                echo htmlentities($listdcats);
                                ?>
                            </h2>
                            <p class="f6">Kategori terlist</p>
                        </div>
                    </div>
                </section>

                <!-- Start recent user -->
                <section class="pa4">
                    <h4 class="f3 b mb3">MURID YANG BARU SAJA MEMINJAM BUKU</h4>
                    <div class="flex flex-wrap -m2">
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
                                <div class="pa2 w-100 w-33-ns">
                                    <div class="bg-light-blue br3 pa3 shadow-1">
                                        <h2 class="f4 mb2"><?php echo htmlentities($result->BookName); ?></h2>
                                        <p class="f6"><?php echo htmlentities($result->AuthorName); ?></p>
                                        <p class="f6"><?php echo htmlentities($result->CategoryName); ?></p>
                                        <p class="f6">
                                            <?php
                                            $sid = $_SESSION['stdid'];
                                            $sql = "SELECT FullName, Status FROM tblstudents WHERE StudentId = :sid";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                            $query->execute();
                                            $student = $query->fetch(PDO::FETCH_OBJ);
                                            echo $student ? htmlentities($student->FullName) : "Gagal menggambil nama murid!";
                                            ?>
                                        </p>
                                        <p class="f6"><?php echo htmlentities($result->IssuesDate); ?></p>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                    </div>
                </section>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
        <script src="assets/js/jquery-1.10.2.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
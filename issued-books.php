<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblbooks WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted successfully ";
        header('location:manage-books.php');
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
        <link href="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css" />
        <script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
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
                            primary: '#DB924B',
                            secondary: '#C27852',
                            accent: '#A6692F',
                            neutral: '#1B1A17',
                            'base-100': '#F7F3E3',
                            'base-200': '#EFE6D8',
                            'base-300': '#E1D3C3',
                            'base-content': '#1B1A17',
                            info: '#9AB8D5',
                            success: '#57B078',
                            warning: '#CB9442',
                            error: '#D95C52',
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

        <div class="content-wrapper">
            <div class="container mx-auto">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line text-2xl font-bold text-primary">Data Buku</h4>
                    </div>
                </div>

                <!-- Table Form -->
                <section class="flex flex-col">
                    <div class="overflow-x-auto min-h-screen">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <?php
                                $sid = $_SESSION['stdid'];
                                $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                if ($query->rowCount() > 0) {
                                    $cnt = 1;
                                ?>
                                    <table class="min-w-full rounded-xl">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize rounded-tl-xl">#</th>
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize">Judul Buku</th>
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize">ID Buku</th>
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize">Dipinjam</th>
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize">Status Pengembalian</th>
                                                <th scope="col" class="p-5 text-left text-sm leading-6 font-semibold text-base-content capitalize rounded-tr-xl">Denda</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-base-200">
                                            <?php foreach ($results as $result) { ?>
                                                <tr class="bg-base-100 transition-all duration-500 hover:bg-base-200">
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral rounded-bl-xl"><?php echo htmlentities($cnt); ?></td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral"><?php echo htmlentities($result->BookName); ?></td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral"><?php echo htmlentities($result->IssuesDate); ?></td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral">
                                                        <?php if ($result->ReturnDate == "") { ?>
                                                            <span class="text-error">Belum</span>
                                                        <?php } else { ?>
                                                            <span><?php echo htmlentities($result->ReturnDate == "1") ? "Belum" : "Sudah"; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-neutral rounded-br-xl"><?php echo htmlentities($result->fine); ?>k</td>
                                                </tr>
                                            <?php $cnt = $cnt + 1;
                                            } ?>
                                        </tbody>
                                    </table>
                                <?php
                                } else { ?>
                                    <div class="flex flex-col items-center justify-center min-h-screen text-center">
                                        <!-- Skeleton Loader -->
                                        <div class="w-full max-w-xl p-4 mb-4">
                                            <div class="animate-pulse">
                                                <div class="h-4 bg-base-300 rounded mb-2"></div>
                                                <div class="h-4 bg-base-300 rounded mb-2"></div>
                                                <div class="h-4 bg-base-300 rounded mb-2"></div>
                                                <div class="h-4 bg-base-300 rounded mb-2"></div>
                                                <div class="h-4 bg-base-300 rounded mb-2"></div>
                                            </div>
                                        </div>
                                        <!-- No History Message -->
                                        <p class="text-lg font-semibold text-neutral">Tidak ada history buku yang telah dipinjam.</p>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- End -->
            </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->

        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE LOADING TIME  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>

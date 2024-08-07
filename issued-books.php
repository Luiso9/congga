<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblbooks  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
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
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                        <h4 class="header-line">Index</h4>
                    </div>
                </div>
                <!-- Table Formm -->
                <div class="flex flex-col">
                    <div class=" overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">

                            <div class="overflow-hidden ">
                                <table class=" min-w-full rounded-xl">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">
                                                # </th>
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">
                                                Judul Buku </th>
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">
                                                ID Buku </th>
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize">
                                                Dipinjam </th>
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">
                                                Status Pengembalian </th>
                                            <th scope="col"
                                                class="p-5 text-left text-sm leading-6 font-semibold text-gray-900 capitalize rounded-t-xl">
                                                Denda </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-300 ">
                                        <?php
                                        $sid = $_SESSION['stdid'];
                                        $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate,tblissuedbookdetails.ReturnDate,tblissuedbookdetails.id as rid,tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentId join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid order by tblissuedbookdetails.id desc";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr class="bg-white transition-all duration-500 hover:bg-gray-50">
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        <?php echo htmlentities($cnt); ?>
                                                    </td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        <?php echo htmlentities($result->BookName); ?>
                                                    </td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        <?php echo htmlentities($result->ISBNNumber); ?>
                                                    </td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        <?php echo htmlentities($result->IssuesDate); ?>
                                                    </td>
                                                    <td class="p-5 whitespace-nowrap text-sm leading-6 font-medium text-gray-900">
                                                        <?php if ($result->ReturnDate == "") { ?>
                                                            <span style="color:red">Belum</span>
                                                        <?php } else { ?>
                                                            <span><?php echo htmlentities($result->ReturnDate == "1") ? "Belum" : "Sudah"; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="center"><?php echo htmlentities($result->fine); ?></td>

                                                </tr>
                                                <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir -->
            </div>
        </div>
        </div>

        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include ('includes/footer.php'); ?>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
<?php } ?>
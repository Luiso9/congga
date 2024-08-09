<?php
session_start();
error_reporting(0);
include ('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Issued Books</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" rel="stylesheet">
    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Include header -->
        <?php include ('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="content-wrapper flex-grow">
            <div class="container mx-auto py-6">
                <div class="mb-4">
                    <h4 class="header-line">Manage Issued Books</h4>
                </div>

                <!-- Displaying Messages -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <?php if ($_SESSION['error'] != "") { ?>
                        <div class="alert alert-danger">
                            <strong>Error :</strong> <?php echo htmlentities($_SESSION['error']); ?>
                            <?php $_SESSION['error'] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php $_SESSION['msg'] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['delmsg'] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION['delmsg']); ?>
                            <?php $_SESSION['delmsg'] = ""; ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Issued Books Table -->
                <div class="overflow-x-auto">
                    <table id="issued-books-table" class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Issued Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Return Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            $sql = "SELECT tblstudents.FullName, tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid 
                                    FROM tblissuedbookdetails 
                                    JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
                                    JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
                                    ORDER BY tblissuedbookdetails.id DESC";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($cnt); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->FullName); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->BookName); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->IssuesDate); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->ReturnDate ? $result->ReturnDate : "Not Returned Yet"); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        </td>
                                    </tr>
                                <?php $cnt++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include ('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dataTable = new simpleDatatables.DataTable("#issued-books-table", {
                    searchable: true,
                    fixedHeight: true,
                });
            });
        </script>
    </body>

    </html>
<?php } ?>

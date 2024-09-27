<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrasi Perpustakaan</title>
    </head>

    <body class="bg-light-gray flex flex-column min-vh-100">

        <!-- Include header -->
        <?php include('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="flex-grow-1 pa4">
            <h2 class="f2 lh-title tc josefin-sans">Manage Issued Books</h2>

            <!-- Displaying Messages -->
            <?php include('includes/error.php'); ?>

            <!-- Issued Books Table -->
            <div class="pa2">
                <table id="data-table" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="fw6 tl pb3 pr3">#</th>
                            <th class="fw6 tl pb3 pr3">Student Name</th>
                            <th class="fw6 tl pb3 pr3">Book Name</th>
                            <th class="fw6 tl pb3 pr3">ISBN</th>
                            <th class="fw6 tl pb3 pr3">Issued Date</th>
                            <th class="fw6 tl pb3 pr3">Return Date</th>
                            <th class="fw6 tl pb3 pr3">Return Status</th>
                            <th class="fw6 tl pb3 pr3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT tblstudents.FullName, tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.ActualReturnDate 
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
                                <tr class="hover-bg-lightest-blue">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->FullName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->IssuesDate); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ReturnDate); ?></td>
                                    <td class="pv3 pr3">
                                        <?php
                                        if ($result->ActualReturnDate) {
                                            $actualReturnDate = new DateTime($result->ActualReturnDate);
                                            $returnDate = new DateTime($result->ReturnDate);
                                            if ($actualReturnDate <= $returnDate) {
                                                echo "Returned";
                                            } else {
                                                echo "Overdue";
                                            }
                                        } else {
                                            echo "Not Returned Yet";
                                        }
                                        ?>
                                    </td>
                                    <td class="pv3 pr3">
                                        <a href="backend/update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid); ?>" class="link dim blue">Edit</a>
                                        <a href="manage-issued-books.php?del=<?php echo htmlentities($result->rid); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

            <!-- Borrow Requests Section -->
            <h2 class="f2 lh-title tc mt5">Pending Borrow Requests</h2>
            <div class="overflow-auto">
                <table id="borrow-requests-table" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="fw6 tl pb3 pr3">#</th>
                            <th class="fw6 tl pb3 pr3">Student ID</th>
                            <th class="fw6 tl pb3 pr3">ISBN</th>
                            <th class="fw6 tl pb3 pr3">Request Date</th>
                            <th class="fw6 tl pb3 pr3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT UserId, ISBN, RequestDate FROM tblborrow_requests ORDER BY RequestDate DESC";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $requests = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($requests as $request) { ?>
                                <tr class="stripe-dark">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($request->UserId); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($request->ISBN); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($request->RequestDate); ?></td>
                                    <td class="pv3 pr3">
                                        <form action="admin/backend/process_confirm_borrow.php" method="POST">
                                            <input type="hidden" name="isbn" value="<?php echo htmlentities($request->ISBN); ?>">
                                            <input type="hidden" name="userid" value="<?php echo htmlentities($request->UserId); ?>">
                                            <button type="submit" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-green">Confirm</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php $cnt++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="5" class="tc pv4">No pending requests</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Include footer -->
        <?php include('includes/footer.php'); ?>

        <!-- DataTable Initialization Script -->
        <script>
            initializeDataTable('#data-table');
        </script>
    </body>

    </html>

<?php } ?>
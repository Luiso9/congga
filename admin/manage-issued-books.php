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
                            <th class="fw6 tl pb3 pr3">Nama Siswa</th>
                            <th class="fw6 tl pb3 pr3">Nama Buku</th>
                            <th class="fw6 tl pb3 pr3">Nomor Buku</th>
                            <th class="fw6 tl pb3 pr3">Tanggal Pengajuan</th>
                            <th class="fw6 tl pb3 pr3">Tanggal Pengembalian</th>
                            <th class="fw6 tl pb3 pr3">Status</th>
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
                            foreach ($results as $result) {
                                $statusMessage = "";
                                $canEdit = true;
                                $canDelete= true;

                                if ($result->ActualReturnDate) {
                                    $actualReturnDate = new DateTime($result->ActualReturnDate);
                                    $returnDate = new DateTime($result->ReturnDate);

                                    if ($actualReturnDate <= $returnDate) {
                                        $statusMessage = "<span class='text-success'>Returned on time</span>";
                                        $canEdit = false; // jika sudah dikembalikan, maka disable edit
                                    } else {
                                        $statusMessage = "<span class='text-danger'>Overdue</span>";
                                        $canEdit = false; 
                                    }
                                } else {
                                    $statusMessage = "<span class='text-warning'>Not Returned Yet</span>";
                                        $canDelete = false; // jika belum dikembalikan, maka disable delete
                                }
                        ?>
                                <tr class="hover-bg-lightest-blue">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->FullName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->IssuesDate); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ReturnDate); ?></td>
                                    <td class="pv3 pr3"><?php echo $statusMessage; ?></td>
                                    <td class="pv3 pr3">
                                        <?php if ($canEdit) { ?>
                                            <a href="backend/update-issue-bookdeails.php?rid=<?php echo htmlentities($result->rid); ?>" class="link dim blue">Edit</a>
                                        <?php } ?>
                                        <?php if ($canDelete) { ?>
                                        <a href="backend/update-issue-bookdeails.php?del=<?php echo htmlentities($result->rid); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php 
                                $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

            <!-- Include footer -->
            <?php include('includes/footer.php'); ?>

            <script>
                initializeDataTable('#data-table');
            </script>
    </body>

    </html>

<?php } ?>

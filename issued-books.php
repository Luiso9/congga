<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit;
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblbooks WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Book deleted successfully."; // Set success message
        header('location:manage-books.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Perpustakaan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/css/tachyons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-white flex flex-column min-vh-100">
    <?php include('includes/header.php'); ?>

    <div class="flex-grow-1 pa4">
        <h2 class="f2 lh-title tc black">Data Buku</h2>

        <div class="mb-4">
            <?php if (isset($_SESSION['success']) && $_SESSION['success'] != "") { ?>
                <div class="alert alert-success bg-green-200 text-green-700 p-4 rounded">
                    <strong>Success:</strong> <?php echo htmlentities($_SESSION['success']); ?>
                    <?php $_SESSION['success'] = ""; // Clear message after displaying 
                    ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['error']) && $_SESSION['error'] != "") { ?>
                <div class="alert alert-danger bg-red-200 text-red-700 p-4 rounded">
                    <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']); ?>
                    <?php $_SESSION['error'] = ""; // Clear message after displaying 
                    ?>
                </div>
            <?php } ?>
        </div>


        <div class="overflow-auto">
            <table id="booksTable" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="fw6 tl pb3 pr3">#</th>
                        <th class="fw6 tl pb3 pr3">Judul Buku</th>
                        <th class="fw6 tl pb3 pr3">ID Buku</th>
                        <th class="fw6 tl pb3 pr3">Dipinjam</th>
                        <th class="fw6 tl pb3 pr3">Status Pengembalian</th>
                        <th class="fw6 tl pb3 pr3">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sid = $_SESSION['stdid']; // Assuming student ID is stored in session
                    $sql = "SELECT tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine 
                            FROM tblissuedbookdetails 
                            JOIN tblstudents ON tblstudents.StudentId = tblissuedbookdetails.StudentId 
                            JOIN tblbooks ON tblbooks.id = tblissuedbookdetails.BookId 
                            WHERE tblstudents.StudentId = :sid 
                            ORDER BY tblissuedbookdetails.id DESC";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                    if ($query->rowCount() > 0) {
                        $cnt = 1;
                        foreach ($results as $result) {
                    ?>
                            <tr class="hover-bg-lightest-blue">
                                <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->BookName); ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->IssuesDate); ?></td>
                                <td class="pv3 pr3"><?php echo $result->ReturnDate == "" ? "<span class='red'>Belum</span>" : "<span class='green'>Sudah</span>"; ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->fine); ?></td>
                            </tr>
                        <?php
                            $cnt++;
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6" class="tc pv4">Tidak ada history buku yang telah dipinjam.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#booksTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true // Make DataTable responsive
            });
        });
    </script>
</body>

</html>
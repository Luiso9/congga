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
        $_SESSION['delmsg'] = "Book deleted successfully.";
        header('location:manage-books.php');
        exit;
    }
}
?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/css/tachyons.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- jQuery (required by DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 5 JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<body class="bg-white flex flex-column min-vh-100">
    <?php include('includes/header.php'); ?>

    <div class="container mt-4">
        <h2 class="text-center">Data Buku</h2>

        <div class="mb-4">
            <?php if (isset($_SESSION['success']) && $_SESSION['success'] != "") { ?>
                <div class="alert alert-success">
                    <strong>Success:</strong> <?php echo htmlentities($_SESSION['success']); ?>
                    <?php $_SESSION['success'] = ""; ?>
                </div>
            <?php } ?>

            <?php if (isset($_SESSION['error']) && $_SESSION['error'] != "") { ?>
                <div class="alert alert-danger">
                    <strong>Error:</strong> <?php echo htmlentities($_SESSION['error']); ?>
                    <?php $_SESSION['error'] = ""; ?>
                </div>
            <?php } ?>
        </div>

        <div class="table-responsive">
            <table id="bukuDipinjam" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Buku</th>
                        <th>ID Buku</th>
                        <th>Dipinjam</th>
                        <th>Status Pengembalian</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sid = $_SESSION['stdid'];
                    $sql = "SELECT tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.ActualReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine 
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
                            <tr>
                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($result->BookName); ?></td>
                                <td><?php echo htmlentities($result->ISBNNumber); ?></td>
                                <td><?php echo htmlentities($result->IssuesDate); ?></td>
                                <td>
                                    <?php
                                    if ($result->ActualReturnDate) {
                                        $actualReturnDate = new DateTime($result->ActualReturnDate);
                                        $returnDate = new DateTime($result->ReturnDate);
                                        if ($actualReturnDate <= $returnDate) {
                                            echo "<span class='text-success'>Returned</span>";
                                        } else {
                                            echo "<span class='text-danger'>Overdue</span>";
                                        }
                                    } else {
                                        echo "<span class='text-warning'>Not Returned Yet</span>";
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlentities($result->fine); ?></td>
                            </tr>
                        <?php
                            $cnt++;
                        }
                    } else { ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Info!</strong> Tidak ada history buku yang dipinjam.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>


    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function() {
            $('#bukuDipinjam').DataTable({
                responsive: true,
                pagingType: "simple",
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                },
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>
    <!-- FOoter -->
    <?php include('includes/footer.php'); ?>
</body>

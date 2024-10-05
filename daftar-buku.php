<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit;
} else {
    try {
        $sql = "
            SELECT b.BookName, b.ISBNNumber, b.BookPrice, b.BookCover, c.CategoryName, a.AuthorName
            FROM tblbooks b
            JOIN tblcategory c ON b.CatId = c.id
            JOIN tblauthors a ON b.AuthorId = a.id
        ";
        $query = $dbh->prepare($sql);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);
        include('includes/header.php');
?>

        <main class="container my-5">
            <h1 class="text-center mb-5">Daftar Buku</h1>

            <!-- Error Message -->
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger text-center" role="alert">
                    <?php echo htmlentities($_SESSION['error']);
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php
            // Pagination Logic
            $booksPerPage = 6; 
            $totalBooks = count($books);
            $totalPages = ceil($totalBooks / $booksPerPage);

            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            if ($currentPage < 1) {
                $currentPage = 1;
            }

            $startIndex = ($currentPage - 1) * $booksPerPage;

            $currentBooks = array_slice($books, $startIndex, $booksPerPage);
            ?>

            <!-- Book Listing -->
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php if ($currentBooks): ?>
                    <?php foreach ($currentBooks as $book): ?>
                        <div class="col">
                            <div class="db center shadow-4 mt3 w400px" style="width: 400px;">
                                <!-- Lazy loading image -->
                                <img src="<?php echo htmlspecialchars($book['BookCover']); ?>"
                                    alt="Cover of <?php echo htmlspecialchars($book['BookName']); ?>" loading="lazy" style="width: 100%; columns: 300px; height: auto; object-fit: cover;">

                                <!-- Book Details -->
                                <div class="pa4">
                                    <h1 class="f3 dark-grey ma0" style="overflow: hidden;"><?php echo htmlspecialchars($book['BookName']); ?></h1>
                                    <p class="mb4 mt2">
                                        <strong>Kategori:</strong> <?php echo htmlspecialchars($book['CategoryName']); ?><br>
                                        <strong>Penulis:</strong> <?php echo htmlspecialchars($book['AuthorName']); ?><br>
                                        <strong>No. Buku:</strong> <?php echo htmlspecialchars($book['ISBNNumber']); ?>
                                    </p>
                                </div>

                                <!-- Action Button -->
                                <div class="pa4">
                                    <button class="bn bg-green white pv2 br2 ph3 outline-0 bg-animate hover-bg-dark-green pointer"
                                        onclick="openModal('<?php echo htmlspecialchars($book['ISBNNumber']); ?>', '<?php echo htmlspecialchars($book['BookName']); ?>')"
                                        aria-label="Borrow <?php echo htmlspecialchars($book['BookName']); ?>">
                                        Pinjam Buku
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center">
                        <p class="lead">Tidak ada buku yang tersedia saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination Controls -->
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <!-- Previous Page Link -->
                        <li class="page-item <?php if ($currentPage <= 1) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- Page Number Links -->
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next Page Link -->
                        <li class="page-item <?php if ($currentPage >= $totalPages) echo 'disabled'; ?>">
                            <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </main>



<?php
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
include('includes/footer.php');
?>

<!-- Modal Structure -->
<div id="requestModal" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Confirm Borrow Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to borrow <strong id="modal-book-name"></strong>?</p>
                <form action="process_borrow_request.php" method="POST">
                    <input type="hidden" name="bookId" id="confirm-borrow-book-id">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Yes, borrow</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function openModal(bookId, bookName) {
        document.getElementById('confirm-borrow-book-id').value = bookId;
        document.getElementById('modal-book-name').innerText = bookName;
        var modal = new bootstrap.Modal(document.getElementById('requestModal'));
        modal.show();
    }
</script>
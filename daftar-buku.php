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
        if ($books) {
            include('includes/header.php');
            echo "<h1 class='tc'>Daftar Buku</h1>";
            echo "<section class='cf w-100 pa2-ns'>";
            foreach ($books as $book) {
                echo "<article class='fl w-100 w-50-m w-25-ns pa2-ns'>";
                echo "<div class='aspect-ratio aspect-ratio--1x1'>";
                $imagePath = htmlspecialchars($book['BookCover']);
                echo "<img src='admin/$imagePath' alt='Book Cover' class='db bg-center cover aspect-ratio--object' style='object-fit: cover; height: 100%; width: 100%;' />";
                echo "</div>";
                echo "<a href='javascript:void(0);' onclick=\"openModal('" . htmlspecialchars($book['ISBNNumber']) . "', '" . htmlspecialchars($book['BookName']) . "')\" class='ph2 ph0-ns pb3 link db'>";
                echo "<h3 class='f5 f4-ns mb0 black-90'>" . htmlspecialchars($book['BookName']) . "</h3>";
                echo "<p class='f6 f5 fw4 mt2 black-60'>Category: " . htmlspecialchars($book['CategoryName']) . "</p>";
                echo "<p class='f6 f5 fw4 mt2 black-60'>Author: " . htmlspecialchars($book['AuthorName']) . "</p>";
                echo "<p class='f6 f5 fw4 mt2 black-60'>ISBN: " . htmlspecialchars($book['ISBNNumber']) . "</p>";
                echo "</a>";
                echo "</article>";
            }
            echo "</section>";
        } else {
            $_SESSION['error'] = "No books found in the database.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>

<!-- Modal Structure -->
<div id="requestModal" class="modal fixed top-0 left-0 w-100 h-100 flex items-center justify-center bg-black-50" style="display:none; z-index: 1000;">
    <div class="modal-content bg-white br3 pa4 shadow-5">
        <span class="close fr f4 link dim" onclick="closeModal()">&times;</span>
        <h2 class="f5 black">Confirm Borrow Request</h2>
        <p>Are you sure you want to borrow <strong id="modal-book-name"></strong>?</p>
        <form action="process_borrow_request.php" method="POST">
            <input type="hidden" name="bookId" id="confirm-borrow-book-id">
            <button type="submit" class="f6 link dim br3 ph3 pv2 mb2 dib white bg-blue">Yes, borrow</button>
            <button type="button" class="f6 link dim br3 ph3 pv2 mb2 dib white bg-red" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

<style>
    body {
        background-color: white;
        font-family: "Roboto", sans-serif;
    }

    h1 {
        margin-top: 20px;
        color: black;
    }

    p {
        margin: 5px 0;
        color: black;
    }

    .aspect-ratio {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 100%;
    }

    .aspect-ratio--object {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        height: 100%;
        width: 100%;
    }
</style>

<script>
    function openModal(bookId, bookName) {
        document.getElementById('confirm-borrow-book-id').value = bookId;
        document.getElementById('modal-book-name').innerText = bookName;
        document.getElementById('requestModal').style.display = "flex";
    }

    function closeModal() {
        document.getElementById('requestModal').style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById('requestModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>

<?php include('includes/footer.php'); ?>
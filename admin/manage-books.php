<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblbooks WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Book deleted successfully";
        header('location:manage-books.php');
    }

    if (isset($_POST['add'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bookcover = $_FILES['bookcover']['name'];
        $target_dir = "bookcovers/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);  // Ensure directory exists
        }
        $target_file = $target_dir . basename($bookcover);

        if (move_uploaded_file($_FILES["bookcover"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO tblbooks(BookName, CatId, AuthorId, ISBNNumber, BookPrice, BookCover) 
                    VALUES(:bookname, :category, :author, :isbn, :price, :bookcover)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
            $query->bindParam(':category', $category, PDO::PARAM_STR);
            $query->bindParam(':author', $author, PDO::PARAM_STR);
            $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $query->bindParam(':price', $price, PDO::PARAM_STR);
            $query->bindParam(':bookcover', $target_file, PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();

            if ($lastInsertId) {
                $_SESSION['msg'] = "Book Listed successfully";
                header('location:manage-books.php');
            } else {
                $_SESSION['error'] = "Something went wrong. Please try again";
            }
        } else {
            $_SESSION['error'] = "Failed to upload book cover.";
        }
    }

    if (isset($_POST['update'])) {
        $bookid = intval($_POST['bookid']);
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];

        $sql = "UPDATE tblbooks SET BookName = :bookname, CatId = :category, AuthorId = :author, ISBNNumber = :isbn, BookPrice = :price WHERE id = :bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);

        if ($query->execute()) {
            $_SESSION['msg'] = "Book info updated successfully";
            header('location:manage-books.php');
            exit();
        } else {
            $_SESSION['error'] = "Failed to update book info.";
        }
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrasi Perpustakaan</title>
    </head>

    <body class="bg-light-gray flex flex-column min-vh-100">
        <?php include('includes/header.php'); ?>

        <div class="flex-grow-1 pa4">
            <h2 class="f2 lh-title tc josefin-sans">Manage Books</h2>
            <button id="addBookBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Books</button>

            <?php include('includes/error.php'); ?>

            <div class="pa2">
                <table id="booksTable" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="fw6 tl pb3 pr3">#</th>
                            <th class="fw6 tl pb3 pr3">Book Name</th>
                            <th class="fw6 tl pb3 pr3">Category</th>
                            <th class="fw6 tl pb3 pr3">Author</th>
                            <th class="fw6 tl pb3 pr3">ISBN</th>
                            <th class="fw6 tl pb3 pr3">Price</th>
                            <th class="fw6 tl pb3 pr3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT tblbooks.BookName, tblcategory.CategoryName, tblauthors.AuthorName, tblbooks.ISBNNumber, tblbooks.BookPrice, tblbooks.id as bookid 
                            FROM tblbooks 
                            JOIN tblcategory ON tblcategory.id = tblbooks.CatId 
                            JOIN tblauthors ON tblauthors.id = tblbooks.AuthorId";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr class="hover-bg-lightest-blue tc">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->CategoryName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->AuthorName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookPrice); ?>k</td>
                                    <td class="pv3 pr3">
                                        <button class="link dim blue editBookBtn"
                                            data-id="<?php echo htmlentities($result->bookid); ?>"
                                            data-name="<?php echo htmlentities($result->BookName); ?>"
                                            data-category="<?php echo htmlentities($result->CategoryName); ?>"
                                            data-author="<?php echo htmlentities($result->AuthorName); ?>"
                                            data-isbn="<?php echo htmlentities($result->ISBNNumber); ?>"
                                            data-price="<?php echo htmlentities($result->BookPrice); ?>"
                                            data-cover="<?php echo htmlentities($result->BookCover); ?>">
                                            Edit
                                        </button>
                                        <a href="manage-books.php?del=<?php echo htmlentities($result->bookid); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

            <?php include('modal/modalBuku.php'); ?>


            <!-- Scripts -->
            <script>
                $(document).ready(function() {
                    const addCategoryBtn = document.getElementById("addBookBtn");
                    const categoryModal = document.getElementById("bookModal");
                    const closeModalBtn = document.getElementById("closeModalBtn");

                    addCategoryBtn.addEventListener("click", () => {
                        categoryModal.classList.remove("dn");
                    });

                    closeModalBtn.addEventListener("click", () => {
                        categoryModal.classList.add("dn");
                    });
                });
            </script>

            <script>
                document.querySelectorAll('.editBookBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const bookId = this.getAttribute('data-id');
                        const bookName = this.getAttribute('data-name');
                        const category = this.getAttribute('data-category');
                        const author = this.getAttribute('data-author');
                        const isbn = this.getAttribute('data-isbn');
                        const price = this.getAttribute('data-price');

                        document.getElementById('editBookId').value = bookId;
                        document.getElementById('editBookName').value = bookName;
                        document.getElementById('editCategory').value = category;
                        document.getElementById('editAuthor').value = author;
                        document.getElementById('editISBN').value = isbn;
                        document.getElementById('editPrice').value = price;

                        document.getElementById('editBookModal').classList.remove('dn');
                    });
                });

                document.getElementById('closeEditModalBtn').addEventListener('click', function() {
                    document.getElementById('editBookModal').classList.add('dn');
                });
            </script>

            <script>
                initializeDataTable('#booksTable');
            </script>
    </body>

    </html>

<?php } ?>
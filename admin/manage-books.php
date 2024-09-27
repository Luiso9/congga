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
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Books</title>
    </head>

    <body class="bg-light-gray flex flex-column min-vh-100">
        <?php include('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="flex-grow-1 pa4">
            <h2 class="f2 lh-title tc josefin-sans">Manage Books</h2>

            <!-- Button to open modal -->
            <button id="addBookBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Books</button>

            <!-- Display Messages -->
            <?php include('includes/error.php'); ?>

            <!-- Books Table -->
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
                                <tr class="hover-bg-lightest-blue">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->CategoryName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->AuthorName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->ISBNNumber); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->BookPrice); ?>k</td>
                                    <td class="pv3 pr3">
                                        <a href="backend/edit-book.php?bookid=<?php echo htmlentities($result->bookid); ?>" class="link dim blue">Edit</a>
                                        <a href="manage-books.php?del=<?php echo htmlentities($result->bookid); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>


            <!-- Add Book Modal -->
            <div id="bookModal" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
                <div class="bg-white mw6 center mt5 pa4">
                    <div class="flex justify-between items-center">
                        <h3 class="f4">Tambah Buku</h3>
                        <button id="closeModalBtn" class="link dim black-80 f4">
                            <svg class="w2 h2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="mv3">
                            <label for="bookname" class="db mb2">Nama Buku</label>
                            <input type="text" name="bookname" id="bookname" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                        </div>
                        <div class="mv3">
                            <label for="category" class="db mb2">Kategori</label>
                            <select name="category" id="category" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                <?php
                                $status = 1;
                                $sql = "SELECT * FROM tblcategory WHERE Status=:status";
                                $query = $dbh->prepare($sql);
                                $query->bindParam(':status', $status, PDO::PARAM_STR);
                                $query->execute();
                                $categories = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($categories as $category) { ?>
                                    <option value="<?php echo htmlentities($category->id); ?>"><?php echo htmlentities($category->CategoryName); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mv3">
                            <label for="author" class="db mb2">Author</label>
                            <select name="author" id="author" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                                <option value="" disabled selected>Pilih Author</option>
                                <?php
                                $sql = "SELECT * FROM tblauthors";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $authors = $query->fetchAll(PDO::FETCH_OBJ);
                                foreach ($authors as $author) { ?>
                                    <option value="<?php echo htmlentities($author->id); ?>"><?php echo htmlentities($author->AuthorName); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mv3">
                            <label for="isbn" class="db mb2">Nomor ISBN</label>
                            <input type="text" name="isbn" id="isbn" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                        </div>
                        <div class="mv3">
                            <label for="price" class="db mb2">Harga</label>
                            <input type="text" name="price" id="price" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                        </div>
                        <div class="mv3">
                            <label for="bookcover" class="db mb2">Book Cover</label>
                            <input type="file" name="bookcover" id="bookcover" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                        </div>
                        <div class="mv3">
                            <button type="submit" name="add" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">Tambah Buku</button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Footer -->
            <?php include('includes/footer.php'); ?>

            <script>
                initializeDataTable('#booksTable');
            </script>

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
    </body>

    </html>
<?php } ?>
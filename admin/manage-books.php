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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tachyons@4.12.0/css/tachyons.min.css">
    </head>

    <body >

        <!-- Include header -->
        <?php include('includes/header.php'); ?>

        <!-- Main Content -->
        <div >
            <div >
                <div >
                    <h4 >Manage Books</h4>
                    <!-- <button id="openModalBtn" >
                        Add Book
                    </button> -->
                    <a id="openModalBtn" >
                        <?php include('component/button.php'); ?>
                    </a>
                </div>

                <!-- Display Messages -->
                <div >
                    <?php if ($_SESSION['error'] != "") { ?>
                        <div >
                            <strong>Error :</strong> <?php echo htmlentities($_SESSION['error']); ?>
                            <?php $_SESSION['error'] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") { ?>
                        <div >
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php $_SESSION['msg'] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['delmsg'] != "") { ?>
                        <div >
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION['delmsg']); ?>
                            <?php $_SESSION['delmsg'] = ""; ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Books Table -->
                <div >
                    <table id="books-table" >
                        <thead >
                            <tr>
                                <th >#</th>
                                <th >Book Name</th>
                                <th >Category</th>
                                <th >Author</th>
                                <th >ISBN</th>
                                <th >Price</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody >
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
                                    <tr>
                                        <td ><?php echo htmlentities($cnt); ?></td>
                                        <td ><?php echo htmlentities($result->BookName); ?></td>
                                        <td ><?php echo htmlentities($result->CategoryName); ?></td>
                                        <td ><?php echo htmlentities($result->AuthorName); ?></td>
                                        <td ><?php echo htmlentities($result->ISBNNumber); ?></td>
                                        <td ><?php echo htmlentities($result->BookPrice); ?>k</td>
                                        <td >
                                            <a href="backend/edit-book.php?bookid=<?php echo htmlentities($result->bookid); ?>" >Edit</a>
                                            <a href="manage-books.php?del=<?php echo htmlentities($result->bookid); ?>" onclick="return confirm('Are you sure you want to delete?');" >Delete</a>
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

        <!-- Add Book Modal -->
        <div id="categoryModal" >
            <div >
                <h3 >Tambah Buku</h3>
                <form method="post" enctype="multipart/form-data">
                    <div >
                        <label for="bookname" >Nama Buku</label>
                        <input type="text" name="bookname" id="bookname" required >
                    </div>
                    <div >
                        <label for="category" >Kategori</label>
                        <select name="category" id="category" required >
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
                    <div >
                        <label for="author" >Author</label>
                        <select name="author" id="author" required >
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
                    <div >
                        <label for="isbn" >Nomor ISBN</label>
                        <input type="text" name="isbn" id="isbn" required >
                    </div>
                    <div >
                        <label for="price" >Harga</label>
                        <input type="text" name="price" id="price" required >
                    </div>
                    <div >
                        <label for="bookcover" >Book Cover</label>
                        <input type="file" name="bookcover" id="bookcover" required >
                    </div>
                    <button type="submit" name="add" >Tambah Buku</button>
                </form>
                <button id="closeModalBtn" >Close</button>
            </div>
        </div>

        <!-- Footer -->
        <?php include('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            // Toggle modal visibility
            document.getElementById("openModalBtn").addEventListener("click", function() {
                document.getElementById("categoryModal").classList.remove("hidden");
            });

            document.getElementById("closeModalBtn").addEventListener("click", function() {
                document.getElementById("categoryModal").classList.add("hidden");
            });
        </script>
    </body>

    </html>
<?php } ?>
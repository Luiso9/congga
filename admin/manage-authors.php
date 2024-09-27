<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblauthors WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Author deleted";
        header('location:manage-authors.php');
    }
?>

    <?php
    if (isset($_POST['create'])) {
        $author = $_POST['author'];
        $sql = "INSERT INTO  tblauthors(AuthorName) VALUES(:author)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Author Listed successfully";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
        }
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Administrasi Perpustakaan</title>
    </head>

    <body>

        <!-- Include header -->
        <?php include('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="flex-grow-1 pa4">
            <h2 class="f2 lh-title tc josefin-sans">Manage Categories</h2>

            <!-- Button to open modal -->
            <button id="addAuthorsBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Category</button>

            <!-- Displaying Messages -->
            <?php include('includes/error.php'); ?>

            <!-- Authors Table -->
            <div class="pa2">
                <table id="authors" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="fw6 tl pb3 pr3">#</th>
                            <th class="fw6 tl pb3 pr3">Author</th>
                            <th class="fw6 tl pb3 pr3">Creation Date</th>
                            <th class="fw6 tl pb3 pr3">Updation Date</th>
                            <th class="fw6 tl pb3 pr3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tblauthors";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr class="hover-bg-lightest-blue">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->AuthorName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->creationDate); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->UpdationDate); ?></td>
                                    <td class="pv3 pr3">
                                        <a href="backend/edit-author.php?athrid=<?php echo htmlentities($result->id); ?>" class="link dim blue">Edit</a>
                                        <a href="manage-authors.php?del=<?php echo htmlentities($result->id); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>


            <!-- Add Author Modal -->
            <div id="authorsModal" tabindex="-1" aria-hidden="true" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
                <div class="bg-white mw6 center mt5 pa4">
                    <div class="flex justify-between items-center mb4">
                        <h3 class="f4">Tambah Author</h3>
                        <button id="closeModalBtn" class="link dim black-80 f4">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <form method="post">
                        <div class="mv3">
                            <label for="author" class="db mb2">Nama Author</label>
                            <input type="text" id="author" name="author" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                        </div>
                        <div>
                            <button type="submit" name="create" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">
                                Tambah Author
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Footer -->
            <?php include('includes/footer.php'); ?>

            <!-- Scripts -->
            <script>
                initializeDataTable('#authors');
            </script>
            <script>
                $(document).ready(function() {
                    const addCategoryBtn = document.getElementById("addAuthorsBtn");
                    const categoryModal = document.getElementById("authorsModal");
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
<?php
}
?>
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

    if (isset($_POST['create'])) {
        $author = $_POST['author'];
        $sql = "INSERT INTO tblauthors(AuthorName) VALUES(:author)";
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

    if (isset($_POST['update'])) {
        $athrid = $_POST['athrid'];
        $author = $_POST['author'];

        $sql = "UPDATE tblauthors SET AuthorName=:author WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':id', $athrid, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Author updated successfully";
        header('location:manage-authors.php');
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
            <h2 class="f2 lh-title tc josefin-sans">Manage Authors</h2>

            <!-- Button to open modal -->
            <button id="addAuthorsBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Category</button>

            <!-- Displaying Messages -->
            <?php include('includes/error.php'); ?>

            <!-- Authors Table -->
            <div class="pa2">
                <table id="authors" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4" cellspacing="0">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="fw6 tl pb3 pr3">#</th>
                            <th class="fw6 tl pb3 pr3">Author</th>
                            <th class="fw6 tl pb3 pr3">Tanggal Dibuat</th>
                            <th class="fw6 tl pb3 pr3">Terakhir Diupdate</th>
                            <th class="fw6 tl pb3 pr3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="stripe-dark">
                        <?php
                        $sql = "SELECT * FROM tblauthors";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr class="hover-bg-lightest-blue tc">
                                    <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->AuthorName); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->creationDate); ?></td>
                                    <td class="pv3 pr3"><?php echo htmlentities($result->UpdationDate); ?></td>
                                    <td class="pv3 pr3">
                                        <button class="link dim blue ml3" onclick="openEditModal(<?php echo htmlentities($result->id); ?>)">Edit</button>
                                        <a href="manage-authors.php?del=<?php echo htmlentities($result->id); ?>" class="link dim red ml3" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

            <?php include('modal/modalAuthors.php'); ?>

            <!-- Footer -->
            <?php include('includes/footer.php'); ?>

            <!-- Scripts -->
            <script>
                function openEditModal(id) {
                    fetch(`backend/get-author.php?athrid=${id}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('editAuthor').value = data.AuthorName;
                            document.getElementById('editAthrid').value = data.id;
                            document.getElementById('authorsEditModal').classList.remove('dn');
                        })
                        .catch(error => console.error('Error:', error));
                }

                document.getElementById('closeEditModalBtn').addEventListener('click', () => {
                    document.getElementById('authorsEditModal').classList.add('dn');
                });

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

            <script>
                initializeDataTable('#authors');
            </script>
    </body>

    </html>
<?php
}
?>
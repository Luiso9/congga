<?php
session_start();
error_reporting(0);
include ('includes/config.php');

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
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" rel="stylesheet">

    </head>

    <body >

        <!-- Include header -->
        <?php include ('includes/header.php'); ?>

        <!-- Main Content -->
        <div >
            <div >
                <div >
                    <h4 >Manage Authors</h4>
                    <a data-modal-target="categoryModal" data-modal-toggle="categoryModal" >
                        <?php include ('component/button.php'); ?>
                    </a>
                </div>

                <!-- Displaying Messages -->
                <div >
                    <?php if ($_SESSION['error'] != "") { ?>
                        <div >
                            <div >
                                <strong>Error :</strong> <?php echo htmlentities($_SESSION["error"]); ?>
                                <?php $_SESSION["error"] = ""; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['msg'] != "") { ?>
                        <div >
                            <div >
                                <strong>Success :</strong> <?php echo htmlentities($_SESSION["msg"]); ?>
                                <?php $_SESSION["msg"] = ""; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['updatemsg'] != "") { ?>
                        <div >
                            <div >
                                <strong>Success :</strong> <?php echo htmlentities($_SESSION["updatemsg"]); ?>
                                <?php $_SESSION["updatemsg"] = ""; ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION['delmsg'] != "") { ?>
                        <div >
                            <div >
                                <strong>Success :</strong> <?php echo htmlentities($_SESSION["delmsg"]); ?>
                                <?php $_SESSION["delmsg"] = ""; ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- Authors Table -->
                <div >
                    <table id="authors-table" >
                        <thead >
                            <tr>
                                <th >#
                                </th>
                                <th >
                                    Author</th>
                                <th >
                                    Creation Date</th>
                                <th >
                                    Updation Date</th>
                                <th >
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php
                            $sql = "SELECT * FROM tblauthors";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td ><?php echo htmlentities($cnt); ?></td>
                                        <td ><?php echo htmlentities($result->AuthorName); ?>
                                        </td>
                                        <td ><?php echo htmlentities($result->creationDate); ?>
                                        </td>
                                        <td ><?php echo htmlentities($result->UpdationDate); ?>
                                        </td>
                                        <td >
                                            <a href="backend/edit-author.php?athrid=<?php echo htmlentities($result->id); ?>"
                                                >Edit</a>
                                            <a href="manage-authors.php?del=<?php echo htmlentities($result->id); ?>"
                                                onclick="return confirm('Are you sure you want to delete?');"
                                                >Delete</a>
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

        <!-- Ini modal -->
        <div id="categoryModal" tabindex="-1" aria-hidden="true"
            >
            <div >
                <!-- Modal konteks -->
                <div >
                    <div >
                        <h3 >
                            Tambah Author
                        </h3>
                        <button type="button"
                            
                            data-modal-hide="categoryModal">
                            <svg  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div >
                        <form method="post">
                            <div>
                                <label for="author" >Nama Author</label>
                                <input type="text" id="author"
                                     name="author"
                                    required>
                            </div>
                            <div >
                                <button type="submit" name="create"
                                    >
                                    Tambah Kategori
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include ('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dataTable = new simpleDatatables.DataTable("#authors-table", {
                    searchable: true,
                    fixedHeight: true,
                });
            });
        </script>
    </body>

    </html>
    <?php
}
?>
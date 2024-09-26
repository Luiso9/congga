<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
    exit;
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblcategory WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Kategori berhasil dihapus";
        header('location:manage-categories.php');
        exit;
    }

    if (isset($_POST['create'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $sql = "INSERT INTO tblcategory(CategoryName,Status) VALUES(:category,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Kategori baru telah ditambahkan";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error'] = "Ada kesalahan saat menambahkan kategori baru";
            header('location:manage-categories.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi Perpustakaan</title>

    <!-- Tachyons for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/tachyons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
</head>

<body class="bg-light-gray flex flex-column min-vh-100">
    <?php include('includes/header.php'); ?>

    <div class="flex-grow-1 pa4">
        <h2 class="f2 lh-title tc josefin-sans">Manage Categories</h2>

        <!-- Button to open modal -->
        <button id="addCategoryBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Category</button>

        <!-- Displaying Messages -->
        <div class="mb-4">
            <?php if ($_SESSION["error"] != "") { ?>
                <div class="bg-washed-red pa3 mv3">
                    <strong>Error :</strong> <?php echo htmlentities($_SESSION["error"]); ?>
                    <?php $_SESSION["error"] = ""; ?>
                </div>
            <?php } ?>
            <?php if ($_SESSION["msg"] != "") { ?>
                <div class="bg-washed-green pa3 mv3">
                    <strong>Success :</strong> <?php echo htmlentities($_SESSION["msg"]); ?>
                    <?php $_SESSION["msg"] = ""; ?>
                </div>
            <?php } ?>
            <?php if ($_SESSION["delmsg"] != "") { ?>
                <div class="bg-light-yellow pa3 mv3">
                    <strong>Success :</strong> <?php echo htmlentities($_SESSION["delmsg"]); ?>
                    <?php $_SESSION["delmsg"] = ""; ?>
                </div>
            <?php } ?>
        </div>

        <!-- Categories Table -->
        <div class="overflow-auto">
            <table id="categoryTable" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="fw6 tl pb3 pr3">#</th>
                        <th class="fw6 tl pb3 pr3">Category</th>
                        <th class="fw6 tl pb3 pr3">Status</th>
                        <th class="fw6 tl pb3 pr3">Created Date</th>
                        <th class="fw6 tl pb3 pr3">Last Updated</th>
                        <th class="fw6 tl pb3 pr3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM tblcategory";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;
                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                            <tr class="hover-bg-lightest-blue">
                                <td class="pv3 pr3"><?php echo htmlentities($cnt); ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->CategoryName); ?></td>
                                <td class="pv3 pr3"><?php echo $result->Status == 1 ? '<span class="green">Active</span>' : '<span class="red">Inactive</span>'; ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->CreationDate); ?></td>
                                <td class="pv3 pr3"><?php echo htmlentities($result->UpdationDate); ?></td>
                                <td class="pv3 pr3">
                                    <a href="edit-category.php?catid=<?php echo htmlentities($result->id); ?>" class="link dim blue">Edit</a>
                                    <a href="manage-categories.php?del=<?php echo htmlentities($result->id); ?>" class="link dim red" onclick="return confirm('Are you sure you want to delete?');">Delete</a>
                                </td>
                            </tr>
                    <?php $cnt++;
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for adding category -->
    <div id="categoryModal" class="fixed z-999 top-0 left-0 w-100 h-100 bg-black-80 dn">
        <div class="bg-white mw6 center mt5 pa4">
            <div class="flex justify-between items-center">
                <h3 class="f4">Tambah Kategori</h3>
                <button id="closeModalBtn" class="link dim black-80 f4">
                    <svg class="w2 h2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <form method="post">
                <div class="mv3">
                    <label for="category" class="db mb2">Nama Kategori</label>
                    <input type="text" name="category" id="category" class="input-reset ba b--black-20 pa2 mb2 db w-100" required>
                </div>
                <div class="mv3">
                    <label for="status" class="db mb2">Status</label>
                    <label class="pa2">
                        <input type="radio" name="status" value="1" checked> Active
                    </label>
                    <label class="pa2">
                        <input type="radio" name="status" value="0"> Inactive
                    </label>
                </div>
                <div class="mv3">
                    <button type="submit" name="create" class="f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-blue">Tambah Kategori</button>
                </div>
            </form>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $('#categoryTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true
            });

            const addCategoryBtn = document.getElementById("addCategoryBtn");
            const categoryModal = document.getElementById("categoryModal");
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

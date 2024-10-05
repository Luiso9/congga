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

    if (isset($_POST['update'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $catid = intval($_POST['catid']);

        $sql = "UPDATE tblcategory SET CategoryName=:category, Status=:status WHERE id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':catid', $catid, PDO::PARAM_INT); 
        $query->execute();

        $_SESSION['updatemsg'] = "Kategori berhasil diupdate";
        header('location:manage-categories.php');
        exit();
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
        <h2 class="f2 lh-title tc josefin-sans">Manage Categories</h2>

        <!-- Button to open modal -->
        <button id="addCategoryBtn" class="f6 link dim br2 ph3 pv2 mb4 dib white bg-dark-blue josefin-sans">Add Category</button>

        <!-- Displaying Messages -->
        <?php include('includes/error.php'); ?>

        <!-- Categories Table -->
        <div class="pa2">
            <table id="kategori" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4 ma4">
                <thead>
                    <tr class="bg-light-gray">
                        <th class="fw6 tl pb3 pr3">#</th>
                        <th class="fw6 tl pb3 pr3">Kategori</th>
                        <th class="fw6 tl pb3 pr3">Status</th>
                        <th class="fw6 tl pb3 pr3">Tanggal Dibuat</th>
                        <th class="fw6 tl pb3 pr3">Terakhir Diupdate</th>
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
                                    <button class="link dim blue ml3" onclick="openEditModal(<?php echo htmlentities($result->id); ?>)">Edit</button>
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

    <?php include('modal/modalCategory.php'); ?>

    <?php include('includes/footer.php'); ?>

    <script>
        initializeDataTable('#kategori');
    </script>

    <!-- Edit Kategori -->
    <script>
        function openEditModal(catid) {
            fetch(`backend/get-category.php?catid=${catid}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editCategory').value = data.CategoryName;
                    document.getElementById('catid').value = data.id;
                    if (data.Status == 1) {
                        document.getElementById('statusActive').checked = true;
                    } else {
                        document.getElementById('statusInactive').checked = true;
                    }

                    document.getElementById('editCategoryModal').classList.remove('dn');
                })
                .catch(error => console.error('Error fetching category:', error));
        }

        // Close modal button event
        document.getElementById('closeEditModalBtn').addEventListener('click', () => {
            document.getElementById('editCategoryModal').classList.add('dn');
        });


        $(document).ready(function() {
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
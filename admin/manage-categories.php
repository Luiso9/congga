<?php
session_start();
error_reporting(0);
include "includes/config.php";

if (strlen($_SESSION["alogin"]) == 0) {
    header("location:index.php");
} else {
    if (isset($_GET["del"])) {
        $id = $_GET["del"];
        $sql = "DELETE FROM tblcategory WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION["delmsg"] = "Kategori berhasil dihapus";
        header("location:manage-categories.php");
    }
    ?>

    <?php
    if (isset($_POST['create'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $sql = "INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = " Kategori baru telah ditambahkan";
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $_SESSION['error'] = " Ada kesalahan saat menambahkan kategori baru";
            header('location:manage-categories.php');
        }

    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Administrasi Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" rel="stylesheet">

    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Include header -->
        <?php include "includes/header.php"; ?>

        <!-- Main Content -->
        <div class="content-wrapper flex-grow">
            <div class="container mx-auto py-6">
                <div class="grid grid-cols-2 w-full mx-auto mb-4">
                    <h4 class="col-span-1 header-line">Manage Categories</h4>
                    <a data-modal-target="categoryModal" data-modal-toggle="categoryModal" class="col-start-3">
                        <?php include ('component/button.php'); ?>
                    </a>
                </div>
                <!-- Displaying Messages -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <?php if ($_SESSION["error"] != "") { ?>
                        <div class="alert alert-danger">
                            <strong>Error :</strong> <?php echo htmlentities($_SESSION["error"]); ?>
                            <?php $_SESSION["error"] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION["msg"] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION["msg"]); ?>
                            <?php $_SESSION["msg"] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION["updatemsg"] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION["updatemsg"]); ?>
                            <?php $_SESSION["updatemsg"] = ""; ?>
                        </div>
                    <?php } ?>
                    <?php if ($_SESSION["delmsg"] != "") { ?>
                        <div class="alert alert-success">
                            <strong>Success :</strong> <?php echo htmlentities($_SESSION["delmsg"]); ?>
                            <?php $_SESSION["delmsg"] = ""; ?>
                        </div>
                    <?php } ?>
                </div>

                <!-- Categories Table -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full" id="category-table">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                No</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Created Date</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Last Updated</th>
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <?php
                                        $sql = "SELECT * FROM tblcategory";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($cnt); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <?php echo htmlentities($result->CategoryName); ?>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <?php echo $result->Status == 1 ? '<span class="text-green-600">Active</span>' : '<span class="text-red-600">Inactive</span>'; ?>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <?php echo htmlentities($result->CreationDate); ?>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <?php echo htmlentities($result->UpdationDate); ?>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <a href="edit-category.php?catid=<?php echo htmlentities($result->id); ?>"
                                                            class="text-blue-400 hover:text-blue-600">Edit</a>
                                                        <a href="manage-categories.php?del=<?php echo htmlentities($result->id); ?>"
                                                            onclick="return confirm('Are you sure you want to delete?');"
                                                            class="ml-4 text-red-400 hover:text-red-600">Delete</a>
                                                    </td>
                                                </tr>
                                                <?php $cnt++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ini modal tambah -->
        <div id="categoryModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <!-- Modal konteks -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Tambah Kategori
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="categoryModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-6 space-y-6">
                        <form method="post">
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                                <input type="text" name="category" id="category"
                                    class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" name="category" required>
                            </div>
                            <div class="mt-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-1 flex items-center">
                                    <input type="radio" name="status" value="1" checked
                                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <label for="status" class="ml-3 block text-sm font-medium text-gray-700">Active</label>
                                </div>
                                <div class="mt-1 flex items-center">
                                    <input type="radio" name="status" value="0"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                                    <label for="status"
                                        class="ml-3 block text-sm font-medium text-gray-700">Inactive</label>
                                </div>
                            </div>
                            <div class="mt-6">
                                <button type="submit" name="create"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                    Tambah Kategori
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        


        <!-- Footer -->
        <?php include "includes/footer.php"; ?>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dataTable = new simpleDatatables.DataTable("#category-table", {
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
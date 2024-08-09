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
        $_SESSION["delmsg"] = "Category deleted successfully";
        header("location:manage-categories.php");
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Categories</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" rel="stylesheet">
        
    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Include header -->
        <?php include "includes/header.php"; ?>

        <!-- Main Content -->
        <div class="content-wrapper flex-grow">
            <div class="container mx-auto py-6">
                <div class="mb-4">
                    <h4 class="header-line">Manage Categories</h4>
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
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Updated</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
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
                                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->CategoryName); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <?php echo $result->Status == 1 ? '<span class="text-green-600">Active</span>' : '<span class="text-red-600">Inactive</span>'; ?>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->CreationDate); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->UpdationDate); ?></td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <a href="edit-category.php?catid=<?php echo htmlentities($result->id); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                                        <a href="manage-categories.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to delete?');" class="ml-4 text-red-600 hover:text-red-800">Delete</a>
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

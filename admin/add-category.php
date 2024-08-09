<?php
session_start();
error_reporting(0);
include ('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

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
        <title>Online Library Management System | Add Categories</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include ('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container mx-auto">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">ADMIN DASHBOARD</h4>
                    </div>
                </div>

                <!-- Form Start Disini -->
                <div class="container mx-auto">
                    <div class="flex justify-center items-center">
                        <div class="px-5 grid gap-8 py-12 mx-auto bg-gray-100 text-gray-900 rounded-lg">
                            <h1 class="flex flex-col justify-center items-center text-4xl font-bold">Tambah Kategori</h1>
                            <!-- <div class="flex flex-col justify-center">
                                <div class="h-full text-center">
                                    <h4 class="text-4xl font-bold mb-6">Tambah Kategori</h4>
                                    <img src="https://picsum.photos/id/870/200/300?grayscale&blur=2" alt="Gambar" />
                                </div>
                            </div> -->
                            <form role="form" method="post">
                                <div>
                                    <span class="uppercase text-sm text-gray-600 font-bold">
                                        Nama Kategori
                                    </span>
                                    <input
                                        class="w-full bg-gray-200 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline focus:ring-2 focus:ring-indigo-400"
                                        type="text" name="category" autocomplete="off" required />
                                </div>
                                <div class="mt-8">
                                    <span class="uppercase text-sm text-gray-600 font-bold">
                                        Status
                                    </span>
                                    <label class="w-1/2 text-gray-900 mt-2 p-3 rounded-lg">
                                        <input type="radio" name="status" id="status" value="1" checked="checked" /> Active
                                    </label>
                                    <label class="w-1/2 text-gray-900 mt-2 p-3 rounded-lg">
                                        <input type="radio" name="status" id="status" value="0" />
                                        Inactive
                                    </label>
                                </div>
                                <button
                                    class="uppercase text-sm font-bold tracking-wide bg-indigo-500 text-gray-100 p-3 rounded-lg w-full focus:outline-none focus:shadow-outline hover:bg-indigo-700 mt-12"
                                    type="submit" name="create">
                                    Send Message
                                </button>
                        </div>
                        </form>
                    </div>


                    <?php if (isset($_SESSION['msg']) || isset($_SESSION['error'])): ?>
                        <div id="alert-additional-content-1"
                            class="p-4 mb-4 text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800 w-96 <?php echo isset($_SESSION['msg']) ? 'alert-success' : 'alert-error'; ?>"
                            role="alert">
                            <div class="flex items-center">
                                <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <h3 class="text-lg font-medium gap-2.5"><?php
                                echo isset($_SESSION['msg']) ? $_SESSION['msg'] : $_SESSION['error'];
                                unset($_SESSION['msg']);
                                unset($_SESSION['error']);
                                ?></h3>
                            </div>
                            <div class="mt-2 mb-4 text-sm">
                                Terimakasih telah menambahkan kategori baru.
                            </div>
                            <div class="flex">
                                <button type="button"
                                    class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 gap-2.5" onclick="manage-category.php">
                                    <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 14">
                                        <path
                                            d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                     Cek Kategori
                                </button>
                                <button type="button"
                                    class="text-blue-800 bg-transparent border border-blue-800 hover:bg-blue-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-200 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-blue-600 dark:border-blue-600 dark:text-blue-400 dark:hover:text-white dark:focus:ring-blue-800"
                                    data-dismiss-target="#alert-additional-content-1" aria-label="Close">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include ('includes/footer.php'); ?>

        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const alertDiv = document.getElementById('alert');
                if (alertDiv) {
                    setTimeout(() => {
                        alertDiv.style.display = 'none';
                    }, 5000); // Hide alert after 5 seconds
                }
            });
        </script>
        <!-- FOOTER SECTION END-->
        <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS  -->
        <script src="assets/js/bootstrap.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
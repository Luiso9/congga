<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblcategory  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Category deleted scuccessfully ";
        header('location:manage-categories.php');
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
        <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wrapper">
            <div class="container mx-auto">
                <div>
                    <div>
                        <h4 class="header-line">Manage Categories</h4>
                    </div>
                    <div>
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Error :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['updatemsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                    <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Success :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Advanced Tables -->
                <div class="flex flex-col">
                    <div class="overflow-x-auto min-h-[631px] ">
                        <div class="min-w-full inline-block align-middle">
                            <div data-hs-datatable='{
                                                "pageLength": 10,
                                                "pagingOptions": {
                                                "pageBtnClasses": "min-w-[40px] flex justify-center items-center text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 py-2.5 text-sm rounded-full disabled:opacity-50 disabled:pointer-events-none"
                                                },
                                                "selecting": true,
                                                "rowSelectingOptions": {
                                                "selectAllSelector": "#hs-table-search-checkbox-all"
                                                },
                                                "language": {
                                                "zeroRecords": "<div class=\"py-10 px-5 flex flex-col justify-center items-center text-center\"><svg class=\"shrink-0 size-6 text-gray-500" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><circle cx=\"11\" cy=\"11\" r=\"8\"/><path d=\"m21 21-4.3-4.3\"/></svg><div class=\"max-w-sm mx-auto\"><p class=\"mt-2 text-sm text-gray-600">No search results</p></div></div>"
                                                }
                                            }'>
                                <div class="py-3">
                                    <div class="relative max-w-xs">
                                        <label for="hs-table-input-search" class="sr-only">Search</label>
                                        <input type="text" name="hs-table-search" id="hs-table-input-search"
                                            class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none"
                                            placeholder="Search for items" data-hs-datatable-search="">
                                        <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                                            <svg class="size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <path d="m21 21-4.3-4.3"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="overflow-hidden min-h-[509px] ">
                                    <table class="min-w-full">
                                        <thead class="border-y border-gray-200">
                                            <tr>
                                                <th scope="col" class="py-1 px-3 pe-0 --exclude-from-ordering">
                                                    <div class="flex items-center h-5">
                                                        <input id="hs-table-search-checkbox-all" type="checkbox"
                                                            class="border-gray-300 rounded text-blue-600 focus:ring-blue-500">
                                                        <label for="hs-table-search-checkbox-all"
                                                            class="sr-only">Checkbox</label>
                                                    </div>
                                                </th>
                                                <th scope="col"
                                                    class="py-1 group text-start font-normal focus:outline-none">
                                                    <div
                                                        class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200">
                                                        Category
                                                        <svg class="size-3.5 ms-1 -me-0.5 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path class="hs-datatable-ordering-asc:text-blue-600"
                                                                d="m7 15 5 5 5-5"></path>
                                                            <path class="hs-datatable-ordering-desc:text-blue-600"
                                                                d="m7 9 5-5 5 5"></path>
                                                        </svg>
                                                    </div>
                                                </th>

                                                <th scope="col"
                                                    class="py-1 group text-start font-normal focus:outline-none">
                                                    <div
                                                        class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200">
                                                        Status
                                                        <svg class="size-3.5 ms-1 -me-0.5 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path class="hs-datatable-ordering-asc:text-blue-600"
                                                                d="m7 15 5 5 5-5"></path>
                                                            <path class="hs-datatable-ordering-desc:text-blue-600"
                                                                d="m7 9 5-5 5 5"></path>
                                                        </svg>
                                                    </div>
                                                </th>

                                                <th scope="col"
                                                    class="py-1 group text-start font-normal focus:outline-none">
                                                    <div
                                                        class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200">
                                                        Creation Date
                                                        <svg class="size-3.5 ms-1 -me-0.5 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path class="hs-datatable-ordering-asc:text-blue-600"
                                                                d="m7 15 5 5 5-5"></path>
                                                            <path class="hs-datatable-ordering-desc:text-blue-600"
                                                                d="m7 9 5-5 5 5"></path>
                                                        </svg>
                                                    </div>
                                                </th>

                                                <th scope="col"
                                                    class="py-1 group text-start font-normal focus:outline-none">
                                                    <div
                                                        class="py-1 px-2.5 inline-flex items-center border border-transparent text-sm text-gray-500 rounded-md hover:border-gray-200">
                                                        Update Date
                                                        <svg class="size-3.5 ms-1 -me-0.5 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path class="hs-datatable-ordering-asc:text-blue-600"
                                                                d="m7 15 5 5 5-5"></path>
                                                            <path class="hs-datatable-ordering-desc:text-blue-600"
                                                                d="m7 9 5-5 5 5"></path>
                                                        </svg>
                                                    </div>
                                                </th>

                                                <th scope="col"
                                                    class="py-2 px-3 text-end font-normal text-sm text-gray-500 --exclude-from-ordering">
                                                    Action</th>
                                            </tr>
                                        </thead>
                                        <?php $sql = "SELECT * from  tblcategory";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) { ?>
                                                <tbody class="divide-y divide-gray-200">
                                                    <tr>
                                                        <td class="py-3 ps-3">
                                                            <div class="flex items-center h-5">
                                                                <input id="hs-table-search-checkbox-1" type="checkbox"
                                                                    class="border-gray-300 rounded text-blue-600 focus:ring-blue-500"
                                                                    data-hs-datatable-row-selecting-individual="">
                                                                <label for="hs-table-search-checkbox-1"
                                                                    class="sr-only">Checkbox</label>
                                                            </div>
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap text-sm font-medium text-gray-800">
                                                            <?php echo htmlentities($result->CategoryName); ?>
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap text-sm text-gray-800">
                                                            <?php if ($result->Status == 1) { ?><a href="#"
                                                                    class="btn btn-success btn-xs">Active</a>
                                                            <?php } else { ?>
                                                                <a href="#" class="btn btn-danger btn-xs">Inactive</a>
                                                            <?php } ?>
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap text-sm text-gray-800">
                                                            <?php echo htmlentities($result->CreationDate); ?>
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap text-sm text-gray-800">
                                                            <?php echo htmlentities($result->UpdationDate); ?>
                                                        </td>
                                                        <td class="p-3 whitespace-nowrap text-end text-sm font-medium">
                                                            <a href="manage-categories.php?del=<?php echo htmlentities($result->id); ?>"
                                                                onclick="return confirm('Are you sure you want to delete?');">
                                                                <button type="button"
                                                                    class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none">Delete</button></a>
                                                        </td>
                                                    </tr>
                                            <?php $cnt = $cnt + 1;
                                            }
                                        } ?>
                                                </tbody>
                                    </table>
                                </div>

                                <div class="py-1 px-4 hidden" data-hs-datatable-paging="">
                                    <nav class="flex items-center space-x-1">
                                        <button type="button"
                                            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                                            data-hs-datatable-paging-prev="">
                                            <span aria-hidden="true">«</span>
                                            <span class="sr-only">Previous</span>
                                        </button>
                                        <div class="flex items-center space-x-1 [&>.active]:bg-gray-100"
                                            data-hs-datatable-paging-pages=""></div>
                                        <button type="button"
                                            class="p-2.5 min-w-[40px] inline-flex justify-center items-center gap-x-2 text-sm rounded-full text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none"
                                            data-hs-datatable-paging-next="">
                                            <span class="sr-only">Next</span>
                                            <span aria-hidden="true">»</span>
                                        </button>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
        <!-- CORE JQUERY  -->
        <script src="assets/js/jquery-1.10.2.js"></script>
        <script src="./node_modules/preline/dist/preline.js"></script>
        <!-- DATATABLE SCRIPTS  -->
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="admin\assets\js\dataTables\dataTables.js"></script>
        <script src="admin\assets\js\dataTables\dataTables.min.js"></script>
        <!-- CUSTOM SCRIPTS  -->
        <script src="assets/js/custom.js"></script>
    </body>

    </html>
<?php } ?>
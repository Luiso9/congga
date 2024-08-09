<?php
session_start();
error_reporting(0);
include ('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for blocking student    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "UPDATE tblstudents SET Status=:status WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }

    // code for activating student
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "UPDATE tblstudents SET Status=:status WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-students.php');
    }
    ?>

    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online Library Management System | Manage Reg Students</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" rel="stylesheet">
    </head>

    <body class="flex flex-col min-h-screen">

        <!-- Include header -->
        <?php include ('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="content-wrapper flex-grow">
            <div class="container mx-auto py-6">
                <div class="mb-4">
                    <h4 class="header-line">Manage Registered Students</h4>
                </div>

                <!-- Registered Students Table -->
                <div class="overflow-x-auto">
                    <table id="students-table" class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobile Number</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reg Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php
                            $sql = "SELECT * FROM tblstudents";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($cnt); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->StudentId); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->FullName); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->EmailId); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->MobileNumber); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->RegDate); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlentities($result->Status == 1 ? 'Active' : 'Blocked'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($result->Status == 1) { ?>
                                                <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to block this student?');" class="text-red-600 hover:text-red-800">Block</a>
                                            <?php } else { ?>
                                                <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to activate this student?');" class="text-green-600 hover:text-green-800">Activate</a>
                                            <?php } ?>
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

        <!-- Footer -->
        <?php include ('includes/footer.php'); ?>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dataTable = new simpleDatatables.DataTable("#students-table", {
                    searchable: true,
                    fixedHeight: true,
                });
            });
        </script>
    </body>

    </html>
<?php } ?>

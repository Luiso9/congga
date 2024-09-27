<?php
session_start();
error_reporting(0);
include('includes/config.php');

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
        <title>Administrasi Perpustakaan</title>
    </head>

    <body>

        <!-- Include header -->
        <?php include('includes/header.php'); ?>

        <!-- Main Content -->
        <div class="flex-grow-1 pa4">
            <h2 class="f2 lh-title tc josefin-sans">Manage Categories</h2>

            <!-- display message -->
            <?php include('includes/error.php'); ?>

            <!-- Table Siswa -->
            <div>
                <table id="siswa" class="collapse w-100 ba b--black-20">
                    <thead>
                        <tr class="bg-light-gray">
                            <th class="pa3">#</th>
                            <th class="pa3">Student ID</th>
                            <th class="pa3">Student Name</th>
                            <th class="pa3">Email ID</th>
                            <th class="pa3">Mobile Number</th>
                            <th class="pa3">Reg Date</th>
                            <th class="pa3">Status</th>
                            <th class="pa3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tblstudents";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <tr>
                                    <td class="pa3"><?php echo htmlentities($cnt); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->StudentId); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->FullName); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->EmailId); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->MobileNumber); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->RegDate); ?></td>
                                    <td class="pa3"><?php echo htmlentities($result->Status == 1 ? 'Active' : 'Blocked'); ?></td>
                                    <td class="pa3">
                                        <?php if ($result->Status == 1) { ?>
                                            <a href="reg-students.php?inid=<?php echo htmlentities($result->id); ?>" class="link dim red" onclick="return confirm('Are you sure you want to block this student?');">Block</a>
                                        <?php } else { ?>
                                            <a href="reg-students.php?id=<?php echo htmlentities($result->id); ?>" class="link dim green" onclick="return confirm('Are you sure you want to activate this student?');">Activate</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php $cnt++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>


            <!-- Footer -->
            <?php include('includes/footer.php'); ?>

            <!-- Scripts -->
            <script>
                initializeDataTable('#siswa');
            </script>
    </body>

    </html>
<?php } ?>
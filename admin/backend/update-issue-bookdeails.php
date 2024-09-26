<?php
session_start();
error_reporting(0);
include ('..\includes\config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:admin\index.php');
} else {
    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1; // Assuming 1 means the book has been returned
        $actualReturnDate = date('Y-m-d H:i:s'); // Get the current date and time

        // Update query to set fine, return status, and actual return date
        $sql = "UPDATE tblissuedbookdetails SET fine=:fine, RetrunStatus=:rstatus, ActualReturnDate=:actualReturnDate WHERE id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->bindParam(':actualReturnDate', $actualReturnDate, PDO::PARAM_STR); // Bind actual return date
        $query->execute();

        $_SESSION['msg'] = "Book Returned successfully";
        header('location:../manage-issued-books.php');
        exit;
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
        <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
        <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <link href="../assets/css/style.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
        <?php include ('..\includes\header.php'); ?>
        <div >
            <div >
                <div >
                    <div >
                        <h4 >Issued Book Details</h4>
                    </div>
                </div>
                <div >
                    <div >
                        <div >
                            <div >
                                Issued Book Details
                            </div>
                            <div >
                                <form role="form" method="post">
                                    <?php
                                    $rid = intval($_GET['rid']);
                                    $sql = "SELECT tblstudents.FullName, tblbooks.BookName, tblbooks.ISBNNumber, tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.id as rid, tblissuedbookdetails.fine, tblissuedbookdetails.RetrunStatus, tblissuedbookdetails.ActualReturnDate FROM tblissuedbookdetails JOIN tblstudents ON tblstudents.StudentId=tblissuedbookdetails.StudentId JOIN tblbooks ON tblbooks.id=tblissuedbookdetails.BookId WHERE tblissuedbookdetails.id=:rid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <div >
                                                <label>Student Name :</label>
                                                <?php echo htmlentities($result->FullName); ?>
                                            </div>
                                            <div >
                                                <label>Book Name :</label>
                                                <?php echo htmlentities($result->BookName); ?>
                                            </div>
                                            <div >
                                                <label>ISBN :</label>
                                                <?php echo htmlentities($result->ISBNNumber); ?>
                                            </div>
                                            <div >
                                                <label>Book Issued Date :</label>
                                                <?php echo htmlentities($result->IssuesDate); ?>
                                            </div>
                                            <div >
                                                <label>Book Returned Date :</label>
                                                <?php 
                                                if ($result->ActualReturnDate) {
                                                    $actualReturnDate = new DateTime($result->ActualReturnDate);
                                                    $returnDate = new DateTime($result->ReturnDate);
                                                    if ($actualReturnDate <= $returnDate) {
                                                        echo "Returned";
                                                    } else {
                                                        echo "Overdue";
                                                    }
                                                } else {
                                                    echo "Not Returned Yet"; ?>
                                                    <input type="hidden" name="rid" value="<?php echo htmlentities($result->rid); ?>">
                                                    <button type="submit" name="return" >Mark as Returned</button>
                                                <?php }
                                                ?>
                                            </div>
                                            <div >
                                                <label>Fine (in USD) :</label>
                                                <?php
                                                if ($result->fine == "") { ?>
                                                    <input  type="text" name="fine" id="fine" required />
                                                <?php } else {
                                                    echo htmlentities($result->fine);
                                                }
                                                ?>
                                            </div>
                                        <?php }
                                    } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include ('../includes/footer.php'); ?>
        <script src="assets/js/jquery-1.10.2.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/custom.js"></script>
    </body>
    </html>
<?php } ?>

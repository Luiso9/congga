<?php
session_start();
error_reporting(0);
include('../includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:admin/index.php');
} else {
    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1; 
        $actualReturnDate = date('Y-m-d H:i:s'); 

        $sql = "UPDATE tblissuedbookdetails SET fine=:fine, RetrunStatus=:rstatus, ActualReturnDate=:actualReturnDate WHERE id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->bindParam(':actualReturnDate', $actualReturnDate, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "Book Returned successfully";
        header('location:../manage-issued-books.php');
        exit;
    }

    if (isset($_GET['del'])) {
        $rid = intval($_GET['del']); 
    
        $sql = "DELETE FROM tblissuedbookdetails WHERE id = :rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->execute();
    
        $_SESSION['msg'] = "Book deleted successfully";
        header('location:../manage-issued-books.php');
        exit;
    }
    
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administrasi Perpustakaan</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tachyons/4.12.0/css/tachyons.min.css">
    </head>

    <body class="bg-light-gray flex flex-column min-vh-100">

        <?php include('../includes/header.php'); ?>

        <div class="flex-grow-1 pa4">
            <div class="bg-white br3 pa4 shadow-4">
                <h4 class="f4">Issued Book Details</h4>
                <div class="mt3">
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
                                <div class="mb3">
                                    <label class="f5 fw6">Student Name:</label>
                                    <p class="f6"><?php echo htmlentities($result->FullName); ?></p>
                                </div>
                                <div class="mb3">
                                    <label class="f5 fw6">Book Name:</label>
                                    <p class="f6"><?php echo htmlentities($result->BookName); ?></p>
                                </div>
                                <div class="mb3">
                                    <label class="f5 fw6">ISBN:</label>
                                    <p class="f6"><?php echo htmlentities($result->ISBNNumber); ?></p>
                                </div>
                                <div class="mb3">
                                    <label class="f5 fw6">Book Issued Date:</label>
                                    <p class="f6"><?php echo htmlentities($result->IssuesDate); ?></p>
                                </div>
                                <div class="mb3">
                                    <label class="f5 fw6">Book Returned Date:</label>
                                    <p class="f6">
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
                                            <button type="submit" name="return" class="f6 link dim br2 ba ph3 pv2 mb2 dib white bg-blue">Tandai bahwa sudah dikembalikan.</button>
                                        <?php }
                                        ?>
                                    </p>
                                </div>
                                <div class="mb3">
                                    <label class="f5 fw6">Denda:</label>
                                    <p class="f6">
                                        <?php
                                        if ($result->fine == "") { ?>
                                            <input type="text" name="fine" id="fine" class="input-reset ba b--black-20 pa2 mb2 db w-100" required />
                                        <?php } else {
                                            echo htmlentities($result->fine);
                                        }
                                        ?>
                                    </p>
                                </div>
                        <?php }
                        } ?>
                    </form>
                </div>
            </div>
        </div>

        <?php include('../includes/footer.php'); ?>
    </body>

    </html>
<?php } ?>
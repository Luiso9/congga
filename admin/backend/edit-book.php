<?php
session_start();
error_reporting(0);
include('..\includes\config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:admin\index.php');
} else {

    if (isset($_POST['update'])) {
        $bookname = $_POST['bookname'];
        $category = $_POST['category'];
        $author = $_POST['author'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];
        $bookid = intval($_GET['bookid']);
        $sql = "update  tblbooks set BookName=:bookname,CatId=:category,AuthorId=:author,ISBNNumber=:isbn,BookPrice=:price where id=:bookid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':bookname', $bookname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':author', $author, PDO::PARAM_STR);
        $query->bindParam(':isbn', $isbn, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "Book info updated successfully";
        header('location:manage-books.php');
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
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('..\includes\header.php'); ?>
        <!-- MENU SECTION END-->
        <div >
            <div >
                <div >
                    <div >
                        <div >
                            <h4 >Add Book</h4>
                        </div>

                    </div>
                    <div >
                        <div ">
                        <div >
                            <div >
                                Book Info
                            </div>
                            <div >
                                <form role="form" method="post">
                                    <?php
                                    $bookid = intval($_GET['bookid']);
                                    $sql = "SELECT tblbooks.BookName,tblcategory.CategoryName,tblcategory.id as cid,tblauthors.AuthorName,tblauthors.id as athrid,tblbooks.ISBNNumber,tblbooks.BookPrice,tblbooks.id as bookid from  tblbooks join tblcategory on tblcategory.id=tblbooks.CatId join tblauthors on tblauthors.id=tblbooks.AuthorId where tblbooks.id=:bookid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>

                                            <div >
                                                <label>Book Name<span style="color:red;">*</span></label>
                                                <input  type="text" name="bookname"
                                                    value="<?php echo htmlentities($result->BookName); ?>" required />
                                            </div>

                                            <div >
                                                <label> Category<span style="color:red;">*</span></label>
                                                <select  name="category" required="required">
                                                    <option value="<?php echo htmlentities($result->cid); ?>">
                                                        <?php echo htmlentities($catname = $result->CategoryName); ?>
                                                    </option>
                                                    <?php
                                                    $status = 1;
                                                    $sql1 = "SELECT * from  tblcategory where Status=:status";
                                                    $query1 = $dbh->prepare($sql1);
                                                    $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query1->rowCount() > 0) {
                                                        foreach ($resultss as $row) {
                                                            if ($catname == $row->CategoryName) {
                                                                continue;
                                                            } else {
                                                    ?>
                                                                <option value="<?php echo htmlentities($row->id); ?>">
                                                                    <?php echo htmlentities($row->CategoryName); ?>
                                                                </option>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>


                                            <div >
                                                <label> Author<span style="color:red;">*</span></label>
                                                <select  name="author" required="required">
                                                    <option value="<?php echo htmlentities($result->athrid); ?>">
                                                        <?php echo htmlentities($athrname = $result->AuthorName); ?>
                                                    </option>
                                                    <?php

                                                    $sql2 = "SELECT * from  tblauthors ";
                                                    $query2 = $dbh->prepare($sql2);
                                                    $query2->execute();
                                                    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query2->rowCount() > 0) {
                                                        foreach ($result2 as $ret) {
                                                            if ($athrname == $ret->AuthorName) {
                                                                continue;
                                                            } else {

                                                    ?>
                                                                <option value="<?php echo htmlentities($ret->id); ?>">
                                                                    <?php echo htmlentities($ret->AuthorName); ?>
                                                                </option>
                                                    <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div >
                                                <label>ISBN Number<span style="color:red;">*</span></label>
                                                <input  type="text" name="isbn"
                                                    value="<?php echo htmlentities($result->ISBNNumber); ?>" required="required" />
                                                <p >An ISBN is an International Standard Book Number.ISBN Must be
                                                    unique</p>
                                            </div>

                                            <div >
                                                <label>Price in USD<span style="color:red;">*</span></label>
                                                <input  type="text" name="price"
                                                    value="<?php echo htmlentities($result->BookPrice); ?>" required="required" />
                                            </div>
                                    <?php }
                                    } ?>
                                    <button type="submit" name="update" >Update </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- CONTENT-WRAPPER SECTION END-->
        <?php include('includes/footer.php'); ?>
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
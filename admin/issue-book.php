<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['issue'])) {
        $studentid = strtoupper($_POST['studentid']);
        $bookid = $_POST['bookdetails'];
        $sql = "INSERT INTO  tblissuedbookdetails(StudentID,BookId) VALUES(:studentid,:bookid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':studentid', $studentid, PDO::PARAM_STR);
        $query->bindParam(':bookid', $bookid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Book issued successfully";
            header('location:manage-issued-books.php');
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header('location:manage-issued-books.php');
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
        <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script>
            // function for get student name
            function getstudent() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_student.php",
                    data: 'studentid=' + $("#studentid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_student_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }

            function getbook() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "admin\backend\get_book.php",
                    data: 'bookid=' + $("#bookid").val(),
                    type: "POST",
                    success: function(data) {
                        $("#get_book_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function() {}
                });
            }
        </script>
        <style type="text/css">
            .others {
                color: red;
            }
        </style>


    </head>

    <body>
        <!------MENU SECTION START-->
        <?php include('includes/header.php'); ?>
        <!-- MENU SECTION END-->
        <div class="content-wra
    <div >
            <div >
                <div >
                    <div >
                        <h4 >Issue a New Book</h4>

                    </div>
                </div>
                <div >
                    <div ">
                            <div >
                        <div >
                            Issue a New Book
                        </div>
                        <div >
                            <form role="form" method="post">
                                <div >
                                    <label>Setudent id<span style="color:red;">*</span></label>
                                    <input  type="text" name="studentid" id="studentid"
                                        onBlur="getstudent()" autocomplete="off" required />
                                </div>
                                <div >
                                    <span id="get_student_name" style="font-size:16px;"></span>
                                </div>
                                <div >
                                    <label>ISBN Number or Book Title<span style="color:red;">*</span></label>
                                    <input  type="text" name="booikid" id="bookid" onBlur="getbook()"
                                        required="required" />
                                </div>
                                <div >
                                    <select  name="bookdetails" id="get_book_name" readonly>
                                    </select>
                                </div>
                                <button type="submit" name="issue" id="submit" >Issue Book </button>
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
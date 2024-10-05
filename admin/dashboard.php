<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else { ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Administrasi Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet">
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <body class="bg-near-white">
        <?php include('includes/header.php'); ?>

        <div class="pa3">
            <div class="flex flex-column items-center">
                <div class="mb3">
                    <h4 class="f3 fw6 tc">Administrasi Perpustakaan</h4>
                </div>

                <!-- Start Data Statistik -->
                <section class="mb4">
                    <?php
                    try {
                        $sql = "
                SELECT 
                (SELECT COUNT(id) FROM tblbooks) AS totalBooks,
                (SELECT COUNT(id) FROM tblissuedbookdetails) AS issuedBooks,
                (SELECT COUNT(id) FROM tblissuedbookdetails WHERE RetrunStatus = 1) AS returnedBooks,
                (SELECT COUNT(id) FROM tblstudents) AS totalStudents,
                (SELECT COUNT(id) FROM tblauthors) AS totalAuthors,
                (SELECT COUNT(id) FROM tblcategory) AS totalCategories
                ";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $stats = $query->fetch(PDO::FETCH_OBJ);
                    ?>

                        <article class="ph3 ph5-ns">
                            <h2 class="f3 fw4 pa3 mv0">Library Stats</h2>
                            <div class="cf pa2">
                                <!-- Books Available -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/open-book.gif" alt="Books Available"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Books Available</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100"><?php echo htmlentities($stats->totalBooks); ?>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Books Issued -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/reading.gif" alt="Books Issued"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Books Issued</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100">
                                                <?php echo htmlentities($stats->issuedBooks); ?></dd>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Books Returned -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/box.gif" alt="Books Returned"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Books Returned</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100">
                                                <?php echo htmlentities($stats->returnedBooks); ?></dd>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Registered Students -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/student.gif" alt="Registered Students"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Registered Students</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100">
                                                <?php echo htmlentities($stats->totalStudents); ?></dd>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Registered Authors -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/feather-pen.gif" alt="Registered Authors"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Registered Authors</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100">
                                                <?php echo htmlentities($stats->totalAuthors); ?></dd>
                                        </dl>
                                    </div>
                                </div>

                                <!-- Categories -->
                                <div class="fl w-50 w-25-m w-20-l pa2">
                                    <div class="db link dim tc">
                                        <img id="bukugambar" src="./assets/img/list.gif" alt="Categories"
                                            class="w-100 db outline black-10" loading="lazy" />
                                        <dl class="mt2 f6 lh-copy">
                                            <dt class="clip">Title</dt>
                                            <dd class="ml0 dark-gray truncate w-100 b josefin-sans">Categories</dd>
                                            <dt class="clip">Count</dt>
                                            <dd class="ml0 black truncate w-100">
                                                <?php echo htmlentities($stats->totalCategories); ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </article>

                    <?php } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    } ?>
                </section>

                <section class="flex-grow-1 pa4">
                    <?php include('includes/error.php'); ?>

                    <!-- Borrow Requests Section -->
                    <h2 class="f3 fw4 pa3 mv0">Pending Request</h2>
                    <div class="overflow-auto w-100">
                        <table id="borrow-requests-table" class="f6 w-100 mw8 center ba b--black-10 bg-white shadow-4">
                            <thead>
                                <tr class="bg-light-gray">
                                    <th class="fw6 tl pb3 pr3">#</th>
                                    <th class="fw6 tl pb3 pr3">NIS Siswa</th>
                                    <th class="fw6 tl pb3 pr3">Nomor Buku</th>
                                    <th class="fw6 tl pb3 pr3">Tanggal Pengajuan</th>
                                    <th class="fw6 tl pb3 pr3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT UserId, ISBN, RequestDate FROM tblborrow_requests ORDER BY RequestDate DESC";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $requests = $query->fetchAll(PDO::FETCH_OBJ);
                                $cnt = 1;
                                if ($query->rowCount() > 0) {
                                    foreach ($requests as $request) { ?>
                                        <tr class="stripe-dark">
                                            <td class="pv3 pr3 tc"><?php echo htmlentities($cnt); ?></td>
                                            <td class="pv3 pr3 tc"><?php echo htmlentities($request->UserId); ?></td>
                                            <td class="pv3 pr3 tc"><?php echo htmlentities($request->ISBN); ?></td>
                                            <td class="pv3 pr3 tc"><?php echo htmlentities($request->RequestDate); ?></td>
                                            <td class="pv3 pr3 tc">
                                                <form action="backend/process_confirm_borrow.php" method="POST">
                                                    <input type="hidden" name="isbn" value="<?php echo htmlentities($request->ISBN); ?>">
                                                    <input type="hidden" name="userid" value="<?php echo htmlentities($request->UserId); ?>">
                                                    <button type="submit" class="ml3 f6 link dim br2 ph3 pv2 mb2 dib white bg-dark-green">Confirm</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php $cnt++;
                                    }
                                } else { ?>
                                    <tr>
                                        <td colspan="5" class="tc pv4">No pending requests</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            </section>

            <!-- Start recent users -->
            <section class="mt5">
                <h4 class="f3 fw4 pa3 mv0 tc">Murid yang baru saja meminjam buku</h4>
                <div class="flex flex-wrap justify-between w-100 ma4">
                    <?php
                    try {
                        $sql =
                            "SELECT ib.IssuesDate, s.FullName, b.BookName, c.CategoryName, a.AuthorName, b.BookCover 
            FROM tblissuedbookdetails ib 
            JOIN tblbooks b ON ib.BookId = b.id 
            JOIN tblcategory c ON b.CatId = c.id 
            JOIN tblauthors a ON b.AuthorId = a.id 
            JOIN tblstudents s ON ib.StudentId = s.StudentId 
            ORDER BY ib.id DESC 
            LIMIT 3";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) { ?>
                                <a class="db center mw5 tc black link dim ma3"
                                    title="<?php echo htmlentities($result->FullName); ?> borrowed <?php echo htmlentities($result->BookName); ?>"
                                    href="#">

                                    <img class="db ba b--black-10 br3" alt="<?php echo htmlentities($result->BookName); ?> cover"
                                        src="<?php echo htmlentities($result->BookCover); ?>"
                                        style="max-height: 700px; object-fit: cover;">

                                    <dl class="mt2 f6 lh-copy">
                                        <dt class="clip">Borrower</dt>
                                        <dd class="ml0"><?php echo htmlentities($result->FullName); ?></dd>
                                        <dt class="clip">Book</dt>
                                        <dd class="ml0 gray"><?php echo htmlentities($result->BookName); ?></dd>
                                        <dt class="clip">Author</dt>
                                        <dd class="ml0 gray"><?php echo htmlentities($result->AuthorName); ?></dd>
                                        <dt class="clip">Category</dt>
                                        <dd class="ml0 gray"><?php echo htmlentities($result->CategoryName); ?></dd>
                                        <dt class="clip">Date</dt>
                                        <dd class="ml0 gray"><?php echo htmlentities($result->IssuesDate); ?></dd>
                                    </dl>
                                </a>
                    <?php }
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
            </section>
            <?php include('includes/footer.php'); ?>
    </body>

    </html>
<?php } ?>
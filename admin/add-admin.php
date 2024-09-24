<?php
session_start();
include ('includes/config.php');
error_reporting(0);

if (!isset($_SESSION['alogin'])) {
    header('location:index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['fullname'];
    $adminEmail = $_POST['adminemail'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM tbladmins WHERE UserName = :username OR AdminEmail = :adminEmail";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':adminEmail', $adminEmail, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $error = "Username or Email already exists.";
    } else {
        $sql = "INSERT INTO tbladmins (FullName, AdminEmail, UserName, Password) 
                VALUES (:fullname, :adminemail, :username, :password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fname, PDO::PARAM_STR);
        $query->bindParam(':adminemail', $adminEmail, PDO::PARAM_STR);
        $query->bindParam(':username', $username, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $success = "Admin account created successfully.";
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.0/dist/flowbite.js"></script>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include ('includes/header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Create Admin Account</h3>
                <hr />
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="adminemail" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Create Admin</button>
                </form>
            </div>
        </div>
    </div>

    <?php include ('includes/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>

</html>
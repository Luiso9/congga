<?php

if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
    if ($_POST["vercode"] != $_SESSION["vercode"] || empty($_SESSION["vercode"])) {
        echo "<script>alert('Incorrect verification code');</script>";
    } else {
        $email = $_POST['emailid'];
        $password = md5($_POST['password']);

        // Mengecek status admin
        $sqlAdmin = "SELECT AdminEmail FROM admin WHERE AdminEmail = :email AND Password = :password";
        $queryAdmin = $dbh->prepare($sqlAdmin);
        $queryAdmin->bindParam(':email', $email, PDO::PARAM_STR);
        $queryAdmin->bindParam(':password', $password, PDO::PARAM_STR);
        $queryAdmin->execute();

        if ($queryAdmin->rowCount() > 0) {
            $_SESSION['alogin'] = $email;
            echo "<script type='text/javascript'> document.location ='admin/dashboard.php'; </script>";
        } else {
            // Jika bukan admin tetapi akun valid, akan diarahkan sebagai siswa
            $sqlStudent = "SELECT EmailId, Password, StudentId, Status FROM tblstudents WHERE EmailId = :email AND Password = :password";
            $queryStudent = $dbh->prepare($sqlStudent);
            $queryStudent->bindParam(':email', $email, PDO::PARAM_STR);
            $queryStudent->bindParam(':password', $password, PDO::PARAM_STR);
            $queryStudent->execute();

            if ($queryStudent->rowCount() > 0) {
                foreach ($queryStudent->fetchAll(PDO::FETCH_OBJ) as $result) {
                    $_SESSION['stdid'] = $result->StudentId;
                    if ($result->Status == 1) {
                        $_SESSION['login'] = $email;
                        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                    } else {
                        echo "<script>alert('Your account has been blocked. Please contact admin.');</script>";
                    }
                }
            } else {
                echo "<script>alert('Invalid details. Please check your email and password.');</script>";
            }
        }
    }
}

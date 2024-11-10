<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once '../connection/db.php';

$response = ["success" => false, "message" => ""]; 

// Handle the incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'] ?? '';

    switch ($action) {
        case 'login':
            $email = $data['emailid'] ?? '';
            $password = $data['password'] ?? '';
            $hashedPassword = md5($password);

            // Admin login check
            $sqlAdmin = "SELECT AdminEmail FROM admin WHERE AdminEmail = :email AND Password = :password";
            $queryAdmin = $dbh->prepare($sqlAdmin);
            $queryAdmin->bindParam(':email', $email, PDO::PARAM_STR);
            $queryAdmin->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $queryAdmin->execute();

            if ($queryAdmin->rowCount() > 0) {
                $_SESSION['alogin'] = $email;
                $response = ["success" => true, "role" => "admin", "message" => "Admin login successful."];
            } else {
                // Student login check
                $sqlStudent = "SELECT EmailId, Password, StudentId, Status FROM tblstudents WHERE EmailId = :email AND Password = :password";
                $queryStudent = $dbh->prepare($sqlStudent);
                $queryStudent->bindParam(':email', $email, PDO::PARAM_STR);
                $queryStudent->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $queryStudent->execute();

                if ($queryStudent->rowCount() > 0) {
                    $result = $queryStudent->fetch(PDO::FETCH_OBJ);
                    $_SESSION['stdid'] = $result->StudentId;
                    if ($result->Status == 1) {
                        $_SESSION['login'] = $email;
                        $response = ["success" => true, "role" => "student", "message" => "Student login successful."];
                    } else {
                        $response["message"] = "Your account has been blocked. Please contact admin.";
                    }
                } else {
                    $response["message"] = "Invalid email or password.";
                }
            }
            break;

        case 'forgot_password':
            $email = $data['email'] ?? '';
            $mobile = $data['mobile'] ?? '';
            $newpassword = md5($data['newpassword'] ?? '');

            $sql = "SELECT EmailId FROM tblstudents WHERE EmailId=:email AND MobileNumber=:mobile";
            $query = $dbh->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $update_sql = "UPDATE tblstudents SET Password=:newpassword WHERE EmailId=:email AND MobileNumber=:mobile";
                $update_query = $dbh->prepare($update_sql);
                $update_query->bindParam(':email', $email, PDO::PARAM_STR);
                $update_query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
                $update_query->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
                $update_query->execute();

                $response = ["success" => true, "message" => "Your password has been successfully changed."];
            } else {
                $response["message"] = "Invalid email or mobile number.";
            }
            break;

        case 'change_password':
            if (empty($_SESSION['login'])) {
                $response = ["success" => false, "message" => "User not logged in"];
                echo json_encode($response);
                exit();
            }

            $currentPassword = md5($data['password'] ?? '');
            $newPassword = md5($data['newpassword'] ?? '');
            $email = $_SESSION['login'];

            $sql = "SELECT Password FROM tblstudents WHERE EmailId=:email AND Password=:password";
            $query = $dbh->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':password', $currentPassword, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() > 0) {
                $update_sql = "UPDATE tblstudents SET Password=:newpassword WHERE EmailId=:email";
                $update_query = $dbh->prepare($update_sql);
                $update_query->bindParam(':email', $email, PDO::PARAM_STR);
                $update_query->bindParam(':newpassword', $newPassword, PDO::PARAM_STR);
                $update_query->execute();

                $response = ["success" => true, "message" => "Your password has been successfully changed."];
            } else {
                $response["message"] = "Your current password is incorrect.";
            }
            break;

        default:
            $response["message"] = "Invalid action specified.";
    }
} else {
    $response["message"] = "Invalid request method.";
}

echo json_encode($response);
?>

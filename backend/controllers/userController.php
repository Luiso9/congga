<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once '../models/User.php';

$userModel = new User($dbh);
$response = ["success" => false, "message" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $action = $data['action'] ?? '';

    switch ($action) {
        case 'check_email':
            $email = $data['emailid'] ?? '';
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $response = ['status' => 'error', 'message' => 'Invalid email address'];
            } else {
                $isAvailable = $userModel->isEmailAvailable($email);
                if ($isAvailable) {
                    $response = ['status' => 'success', 'message' => 'Email available for registration'];
                } else {
                    $response = ['status' => 'error', 'message' => 'Email already exists'];
                }
            }
            break;

        case 'register':
            $userData = [
                'fullname' => $data['fullname'] ?? '',
                'mobileno' => $data['mobileno'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => md5($data['password'] ?? ''),
                'status' => 1
            ];

            // Register the user
            $studentId = $userModel->registerUser($userData);
            if ($studentId) {
                $response = [
                    "success" => true,
                    "message" => "Registration successful. Your student ID is $studentId."
                ];
            } else {
                $response["message"] = "Registration failed. Please try again.";
            }
            break;

        default:
            $response["message"] = "Invalid action specified.";
            break;
    }
} else {
    $response["message"] = "Invalid request method.";
}

echo json_encode($response);

<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost:5173"); // Test URL
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

require_once '../models/requestBook.php';

$response = ["success" => false, "message" => ""];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['login'])) {
        $response['message'] = 'User not logged in';
    } else {
        $data = json_decode(file_get_contents("php://input"), true);
        $userId = $_SESSION['login'];
        $isbn = htmlspecialchars($data['bookId'] ?? '');

        $bookRequestModel = new BookRequest($dbh);

        try { //Try to attempt book request
            if ($bookRequestModel->createRequest($userId, $isbn)) {
                $response = ['success' => true, 'message' => 'Borrow request submitted successfully.'];
            } else {
                $response['message'] = 'Failed to submit borrow request.';
            }
        } catch (PDOException $e) {
            $response = ['status' => 'error', 'message' => 'Error: ' . $e->getMessage()];
        }
    }
} else {
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);

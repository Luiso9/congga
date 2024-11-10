<?php
include('../models/getBook.php');

$bookModel = new Book($dbh);
$requestMethod = $_SERVER['REQUEST_METHOD'];

try {
    switch ($requestMethod) {
        case 'GET':
            $books = $bookModel->getAllBooks();
            echo json_encode(['status' => 'success', 'books' => $books ?: []]);
            break;

        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            if ($bookModel->addBook($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Book added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add book']);
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            if ($bookModel->updateBook($data)) {
                echo json_encode(['status' => 'success', 'message' => 'Book updated successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update book']);
            }
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            if ($bookModel->deleteBook($data['id'])) {
                echo json_encode(['status' => 'success', 'message' => 'Book deleted successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to delete book']);
            }
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Request method not supported']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database operation failed', 'details' => $e->getMessage()]);
}

?>

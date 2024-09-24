<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
    exit;
} else {
    try {
        $sql = "SELECT BookName, CatId, AuthorId, ISBNNumber, BookPrice, BookCover FROM tblbooks";
        $query = $dbh->prepare($sql);
        $query->execute();
        $books = $query->fetchAll(PDO::FETCH_ASSOC);
        if ($books) {
            include('includes/header.php');
            echo "<h1>Daftar Buku</h1>";
            echo "<div class='grid-container'>";
            foreach ($books as $book) {
                echo "<div class='book-card'>";
                $imagePath = htmlspecialchars($book['BookCover']);
                echo "<img src='admin/$imagePath' alt='Book Cover' class='book-cover'>";
                echo "<h3>" . htmlspecialchars($book['BookName']) . "</h3>";
                echo "<p>Category ID: " . htmlspecialchars($book['CatId']) . "</p>";
                echo "<p>Author ID: " . htmlspecialchars($book['AuthorId']) . "</p>";
                echo "<p>ISBN: " . htmlspecialchars($book['ISBNNumber']) . "</p>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            $_SESSION['error'] = "No books found in the database.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css">
</head>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .book-card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
        transition: transform 0.2s;
    }

    .book-card:hover {
        transform: scale(1.05);
    }

    .book-cover {
        width: 100%;
        height: auto;
        max-height: 250px;
        object-fit: cover;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
    }

    h3 {
        margin-bottom: 10px;
        font-size: 1.25rem;
    }

    p {
        margin: 5px 0;
    }
</style>
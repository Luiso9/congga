<?php
require_once '../connection/db.php';

class Book {
    private $dbh;

    public function __construct($dbh) {
        $this->dbh = $dbh;
    }

    // Fetch all books with details
    public function getAllBooks() {
        $sql = "
            SELECT 
                b.BookName, 
                b.ISBNNumber, 
                b.BookPrice, 
                b.BookCover, 
                c.CategoryName, 
                a.AuthorName
            FROM tblbooks b
            JOIN tblcategory c ON b.CatId = c.id
            JOIN tblauthors a ON b.AuthorId = a.id
        ";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new book
    public function addBook($data) {
        $sql = "INSERT INTO tblbooks (BookName, ISBNNumber, BookPrice, BookCover, CatId, AuthorId) 
                VALUES (:name, :isbn, :price, :cover, :category, :author)";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':name', $data['BookName']);
        $query->bindParam(':isbn', $data['ISBNNumber']);
        $query->bindParam(':price', $data['BookPrice']);
        $query->bindParam(':cover', $data['BookCover']);
        $query->bindParam(':category', $data['CatId']);
        $query->bindParam(':author', $data['AuthorId']);
        return $query->execute();
    }

    // Update an existing book
    public function updateBook($data) {
        $sql = "UPDATE tblbooks 
                SET BookName=:name, ISBNNumber=:isbn, BookPrice=:price, BookCover=:cover, CatId=:category, AuthorId=:author 
                WHERE id=:id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':id', $data['id']);
        $query->bindParam(':name', $data['BookName']);
        $query->bindParam(':isbn', $data['ISBNNumber']);
        $query->bindParam(':price', $data['BookPrice']);
        $query->bindParam(':cover', $data['BookCover']);
        $query->bindParam(':category', $data['CatId']);
        $query->bindParam(':author', $data['AuthorId']);
        return $query->execute();
    }

    // Delete a book by ID
    public function deleteBook($id) {
        $sql = "DELETE FROM tblbooks WHERE id=:id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(':id', $id);
        return $query->execute();
    }
}
?>

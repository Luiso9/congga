<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ryujinsayang');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}

$response = file_get_contents('https://api.jikan.moe/v4/manga?page=4'); // Replace with your API URL

$mangaData = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error parsing JSON: ' . json_last_error_msg());
}

$data = $mangaData['data'] ?? []; 

$sql = "INSERT INTO tblbooks (bookname, authorid, catid, isbnnumber, bookcover) VALUES (:bookname, :authorid, :catid, :isbnnumber, :bookcover)";
$stmt = $dbh->prepare($sql);

// Start a transaction
try {
    $dbh->beginTransaction();

    if (is_array($data)) {
        foreach ($data as $manga) {
            // Get the authors and genres
            $authors = $manga['authors'] ?? []; // Get authors array
            $genres = $manga['genres'] ?? []; // Get genres array
            $bookname = $manga['title']; // Manga title
            $isbnnumber = $manga['mal_id']; // Assuming mal_id as ISBN
            $bookcover = $manga['images']['jpg']['image_url'] ?? ''; // Get the cover image URL

            if (is_array($authors) && !empty($authors)) {
                $authorId = $authors[0]['mal_id']; 
                
                // Check if genres exist
                if (is_array($genres) && !empty($genres)) {
                    $catId = $genres[0]['mal_id']; 

                    // Check if the ISBN number already exists in the database
                    $checkSql = "SELECT COUNT(*) FROM tblbooks WHERE isbnnumber = :isbnnumber";
                    $checkStmt = $dbh->prepare($checkSql);
                    $checkStmt->bindParam(':isbnnumber', $isbnnumber);
                    $checkStmt->execute();

                    if ($checkStmt->fetchColumn() == 0) {
                        // Bind parameters
                        $stmt->bindParam(':bookname', $bookname);
                        $stmt->bindParam(':authorid', $authorId);
                        $stmt->bindParam(':catid', $catId);
                        $stmt->bindParam(':isbnnumber', $isbnnumber);
                        $stmt->bindParam(':bookcover', $bookcover);
                        
                        echo "Preparing to insert - Author ID: $authorId, Category ID: $catId, Book Name: $bookname<br>";

                        if (!$stmt->execute()) {
                            throw new Exception("Failed to insert book for Author ID: $authorId and Category ID: $catId");
                        } else {
                            echo "Inserted book for Author ID: $authorId and Category ID: $catId<br>";
                        }
                    } else {
                        echo "Book with ISBN $isbnnumber already exists. Skipping insert.<br>";
                    }
                } else {
                    echo "No genres available for this manga.<br>";
                }
            } else {
                echo "No authors available for this manga.<br>";
            }
        }
    } else {
        echo "No manga data available.<br>";
    }

    $dbh->commit();
} catch (Exception $e) {
    $dbh->rollBack();
    echo "Transaction failed: " . $e->getMessage();
}

// Close the database connection
$dbh = null;

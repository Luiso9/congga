import React, { useState, useEffect } from "react";
import { apiClient } from "../../apiClient";

const getBooks = async () => {
  try {
    const response = await apiClient("/controllers/bookController.php", {
      method: "GET",
    });
    return response.books || []; 
  } catch (error) {
    console.error("Error fetching books:", error);
    return [];  
  }
};

const StudentDashboard = () => {
  const [books, setBooks] = useState([]);

  useEffect(() => {
    const loadBooks = async () => {
      const result = await getBooks(); 
      setBooks(result); 
    };

    loadBooks(); 
  }, []); 

  return (
    <>
      <h1>Books List</h1>
      <ul>
        {books.map((book) => (
          <li key={book.id} style={{ listStyle: "none" }}>
            <p>
              <strong>{book.BookName}</strong>
            </p>
            <p>{book.AuthorName}</p>
          </li>
        ))}
      </ul>
    </>
  );
};

export default StudentDashboard;

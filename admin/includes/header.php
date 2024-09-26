<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
</head>

<body class="bg-near-white">

    <!-- Navbar -->
    <nav class="db dt-l w-100 border-box pa3 ph5-l">
        <!-- Logo or Branding -->
        <a href="#" class="db dtc-l v-mid mid-gray link dim w-100 w-25-l tc tl-l mb2 mb0-l" title="Home">
            <img src="..\assets\img\logo.png" class="dib w3 h3 br-100" alt="Library Manager">
        </a>

        <!-- Navigation Links -->
        <div class="db dtc-l v-mid w-100 w-75-l tc tr-l">
            <?php if ($_SESSION['alogin']) { ?>
                <a href="dashboard.php" class="link dim dark-gray f6 f5-l dib mr3 mr4-l">Dashboard</a>

                <div class="dib mr3 mr4-l">
                    <a href="#" class="link dim dark-gray f6 f5-l" onclick="toggleDropdown('categoriesDropdown')">Categories</a>
                    <ul id="categoriesDropdown" class="absolute bg-white list pa2 dn shadow-1">
                        <li><a href="manage-categories.php" class="black no-underline db pv1 f6 lh-copy">Manage Categories</a></li>
                    </ul>
                </div>

                <div class="dib mr3 mr4-l">
                    <a href="#" class="link dim dark-gray f6 f5-l" onclick="toggleDropdown('authorsDropdown')">Authors</a>
                    <ul id="authorsDropdown" class="absolute bg-white list pa2 dn shadow-1">
                        <li><a href="manage-authors.php" class="black no-underline db pv1 f6 lh-copy">Manage Authors</a></li>
                    </ul>
                </div>

                <div class="dib mr3 mr4-l">
                    <a href="#" class="link dim dark-gray f6 f5-l" onclick="toggleDropdown('booksDropdown')">Books</a>
                    <ul id="booksDropdown" class="absolute bg-white list pa2 dn shadow-1">
                        <li><a href="manage-books.php" class="black no-underline db pv1 f6 lh-copy">Manage Books</a></li>
                    </ul>
                </div>

                <div class="dib mr3 mr4-l">
                    <a href="#" class="link dim dark-gray f6 f5-l" onclick="toggleDropdown('issueBooksDropdown')">Issue Books</a>
                    <ul id="issueBooksDropdown" class="absolute bg-white list pa2 dn shadow-1">
                        <li><a href="manage-issued-books.php" class="black no-underline db pv1 f6 lh-copy">Manage Issued Books</a></li>
                    </ul>
                </div>

                <a href="reg-students.php" class="link dim dark-gray f6 f5-l dib mr3 mr4-l">Reg Students</a>

                <div class="dib">
                    <a href="#" class="link dim dark-gray f6 f5-l" onclick="toggleDropdown('managementDropdown')">Management</a>
                    <ul id="managementDropdown" class="absolute bg-white list pa2 dn shadow-1">
                        <li><a href="change-password.php" class="black no-underline db pv1 f6 lh-copy">Change Password</a></li>
                        <li><a href="logout.php" class="black no-underline db pv1 f6 lh-copy">LOG ME OUT</a></li>
                    </ul>
                </div>
            <?php } else { ?>
                <a href="adminlogin.php" class="link dim dark-gray f6 f5-l dib mr3 mr4-l">Admin Login</a>
                <a href="signup.php" class="link dim dark-gray f6 f5-l dib mr3 mr4-l">User Signup</a>
                <a href="index.php" class="link dim dark-gray f6 f5-l dib mr3 mr4-l">User Login</a>
            <?php } ?>
        </div>
    </nav>

    <script>
        // Toggle dropdown visibility for each section
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('dn');
        }
    </script>

</body>

</html>

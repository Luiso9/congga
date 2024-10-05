<?php
session_start();
include('includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Descriptive title for SEO -->
    <title>Perpustakaan - A Comprehensive Digital Library for Students and Researchers</title>

    <!-- Meta description with targeted keywords -->
    <meta name="description" content="Perpustakaan: Access thousands of books, journals, and academic resources online. Explore our digital library tailored for students, researchers, and educators." />

    <!-- Keywords for SEO -->
    <meta name="keywords" content="Perpustakaan, digital library, academic resources, books, journals, student library, research" />

    <!-- Author -->
    <meta name="author" content="barangtemuan.my.id" />

    <!-- Open Graph meta tags for social media integration (Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="Perpustakaan - A Comprehensive Digital Library" />
    <meta property="og:description" content="Explore thousands of digital resources tailored for students and researchers." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://www.yourwebsite.com" />
    <meta property="og:image" content="https://www.yourwebsite.com/assets/images/library-cover.jpg" />

    <!-- Twitter card for better Twitter link previews -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Perpustakaan - A Comprehensive Digital Library" />
    <meta name="twitter:description" content="Access thousands of books, journals, and academic resources online." />
    <meta name="twitter:image" content="https://www.yourwebsite.com/assets/images/library-cover.jpg" />

    <!-- Link to favicon for better branding -->
    <link rel="icon" href="./assets/img/ico/favicon.ico" type="image/x-icon" />

    <!-- CSS links -->
    <link href="https://unpkg.com/tachyons@4.12.0/css/tachyons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="assets/css/table.css">
    <link href="./assets/css/style.css" rel="stylesheet" />
    <link href="./assets/css/navbar.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <link data-optimized="2" rel="stylesheet" href="https://smkn3jogja.sch.id/wp-content/litespeed/css/6a8ee37791889cdd1827c84f26372544.css?ver=c5bfd">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
</head>

<body data-elementor-device-mode="mobile" data-rsssl="1">

    <!-- Navbar -->
    <header id="masthead" class="site-header" role="banner" itemtype="https://schema.org/WPHeader" itemscope="">
        <div id="main-header" class="site-header-wrap">
            <div class="site-header-inner-wrap">
                <div class="site-header-upper-wrap">
                    <!-- Atas Link -->
                    <div class="site-header-upper-inner-wrap">
                        <div class="site-top-header-wrap site-header-row-container site-header-focus-item site-header-row-layout-standard" data-section="kadence_customizer_header_top">
                            <div class="site-header-row-container-inner">
                                <div class="site-container">
                                    <div class="site-top-header-inner-wrap site-header-row site-header-row-has-sides site-header-row-no-center">
                                        <div class="site-header-top-section-left site-header-section site-header-section-left">
                                            <div class="site-header-item site-header-focus-item" data-section="kadence_customizer_header_social">
                                                <div class="header-social-wrap">
                                                    <div class="header-social-inner-wrap element-social-inner-wrap social-show-label-false social-style-outline social-show-brand-until"><a href="https://web.facebook.com/smkn3yogyakarta?_rdc=1&amp;_rdr" aria-label="&quot;Facebook&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-facebook"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-facebook-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="24" height="28" viewBox="0 0 24 28">
                                                                    <title>Facebook</title>
                                                                    <path d="M19.5 2c2.484 0 4.5 2.016 4.5 4.5v15c0 2.484-2.016 4.5-4.5 4.5h-2.938v-9.297h3.109l0.469-3.625h-3.578v-2.312c0-1.047 0.281-1.75 1.797-1.75l1.906-0.016v-3.234c-0.328-0.047-1.469-0.141-2.781-0.141-2.766 0-4.672 1.687-4.672 4.781v2.672h-3.125v3.625h3.125v9.297h-8.313c-2.484 0-4.5-2.016-4.5-4.5v-15c0-2.484 2.016-4.5 4.5-4.5h15z"></path>
                                                                </svg></span></a><a href="https://twitter.com/smkn3jogja" aria-label="&quot;Twitter&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-twitter"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-twitter-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
                                                                    <title>Twitter</title>
                                                                    <path d="M25.312 6.375c-0.688 1-1.547 1.891-2.531 2.609 0.016 0.219 0.016 0.438 0.016 0.656 0 6.672-5.078 14.359-14.359 14.359-2.859 0-5.516-0.828-7.75-2.266 0.406 0.047 0.797 0.063 1.219 0.063 2.359 0 4.531-0.797 6.266-2.156-2.219-0.047-4.078-1.5-4.719-3.5 0.313 0.047 0.625 0.078 0.953 0.078 0.453 0 0.906-0.063 1.328-0.172-2.312-0.469-4.047-2.5-4.047-4.953v-0.063c0.672 0.375 1.453 0.609 2.281 0.641-1.359-0.906-2.25-2.453-2.25-4.203 0-0.938 0.25-1.797 0.688-2.547 2.484 3.062 6.219 5.063 10.406 5.281-0.078-0.375-0.125-0.766-0.125-1.156 0-2.781 2.25-5.047 5.047-5.047 1.453 0 2.766 0.609 3.687 1.594 1.141-0.219 2.234-0.641 3.203-1.219-0.375 1.172-1.172 2.156-2.219 2.781 1.016-0.109 2-0.391 2.906-0.781z"></path>
                                                                </svg></span></a><a href="https://www.instagram.com/smkn3jogja/" aria-label="&quot;Instagram&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-instagram"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-instagram-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                    <title>Instagram</title>
                                                                    <path d="M21.138 0.242c3.767 0.007 3.914 0.038 4.65 0.144 1.52 0.219 2.795 0.825 3.837 1.821 0.584 0.562 0.987 1.112 1.349 1.848 0.442 0.899 0.659 1.75 0.758 3.016 0.021 0.271 0.031 4.592 0.031 8.916s-0.009 8.652-0.030 8.924c-0.098 1.245-0.315 2.104-0.743 2.986-0.851 1.755-2.415 3.035-4.303 3.522-0.685 0.177-1.304 0.26-2.371 0.31-0.381 0.019-4.361 0.024-8.342 0.024s-7.959-0.012-8.349-0.029c-0.921-0.044-1.639-0.136-2.288-0.303-1.876-0.485-3.469-1.784-4.303-3.515-0.436-0.904-0.642-1.731-0.751-3.045-0.031-0.373-0.039-2.296-0.039-8.87 0-2.215-0.002-3.866 0-5.121 0.006-3.764 0.037-3.915 0.144-4.652 0.219-1.518 0.825-2.795 1.825-3.833 0.549-0.569 1.105-0.975 1.811-1.326 0.915-0.456 1.756-0.668 3.106-0.781 0.374-0.031 2.298-0.038 8.878-0.038h5.13zM15.999 4.364v0c-3.159 0-3.555 0.014-4.796 0.070-1.239 0.057-2.084 0.253-2.824 0.541-0.765 0.297-1.415 0.695-2.061 1.342s-1.045 1.296-1.343 2.061c-0.288 0.74-0.485 1.586-0.541 2.824-0.056 1.241-0.070 1.638-0.070 4.798s0.014 3.556 0.070 4.797c0.057 1.239 0.253 2.084 0.541 2.824 0.297 0.765 0.695 1.415 1.342 2.061s1.296 1.046 2.061 1.343c0.74 0.288 1.586 0.484 2.825 0.541 1.241 0.056 1.638 0.070 4.798 0.070s3.556-0.014 4.797-0.070c1.239-0.057 2.085-0.253 2.826-0.541 0.765-0.297 1.413-0.696 2.060-1.343s1.045-1.296 1.343-2.061c0.286-0.74 0.482-1.586 0.541-2.824 0.056-1.241 0.070-1.637 0.070-4.797s-0.015-3.557-0.070-4.798c-0.058-1.239-0.255-2.084-0.541-2.824-0.298-0.765-0.696-1.415-1.343-2.061s-1.295-1.045-2.061-1.342c-0.742-0.288-1.588-0.484-2.827-0.541-1.241-0.056-1.636-0.070-4.796-0.070zM14.957 6.461c0.31-0 0.655 0 1.044 0 3.107 0 3.475 0.011 4.702 0.067 1.135 0.052 1.75 0.241 2.16 0.401 0.543 0.211 0.93 0.463 1.337 0.87s0.659 0.795 0.871 1.338c0.159 0.41 0.349 1.025 0.401 2.16 0.056 1.227 0.068 1.595 0.068 4.701s-0.012 3.474-0.068 4.701c-0.052 1.135-0.241 1.75-0.401 2.16-0.211 0.543-0.463 0.93-0.871 1.337s-0.794 0.659-1.337 0.87c-0.41 0.16-1.026 0.349-2.16 0.401-1.227 0.056-1.595 0.068-4.702 0.068s-3.475-0.012-4.702-0.068c-1.135-0.052-1.75-0.242-2.161-0.401-0.543-0.211-0.931-0.463-1.338-0.87s-0.659-0.794-0.871-1.337c-0.159-0.41-0.349-1.025-0.401-2.16-0.056-1.227-0.067-1.595-0.067-4.703s0.011-3.474 0.067-4.701c0.052-1.135 0.241-1.75 0.401-2.16 0.211-0.543 0.463-0.931 0.871-1.338s0.795-0.659 1.338-0.871c0.41-0.16 1.026-0.349 2.161-0.401 1.073-0.048 1.489-0.063 3.658-0.065v0.003zM16.001 10.024c-3.3 0-5.976 2.676-5.976 5.976s2.676 5.975 5.976 5.975c3.3 0 5.975-2.674 5.975-5.975s-2.675-5.976-5.975-5.976zM16.001 12.121c2.142 0 3.879 1.736 3.879 3.879s-1.737 3.879-3.879 3.879c-2.142 0-3.879-1.737-3.879-3.879s1.736-3.879 3.879-3.879zM22.212 8.393c-0.771 0-1.396 0.625-1.396 1.396s0.625 1.396 1.396 1.396 1.396-0.625 1.396-1.396c0-0.771-0.625-1.396-1.396-1.396v0.001z"></path>
                                                                </svg></span></a><a href="https://www.youtube.com/skagatatv" aria-label="&quot;YouTube&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-youtube"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-youtube-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                                                                    <title>YouTube</title>
                                                                    <path d="M11.109 17.625l7.562-3.906-7.562-3.953v7.859zM14 4.156c5.891 0 9.797 0.281 9.797 0.281 0.547 0.063 1.75 0.063 2.812 1.188 0 0 0.859 0.844 1.109 2.781 0.297 2.266 0.281 4.531 0.281 4.531v2.125s0.016 2.266-0.281 4.531c-0.25 1.922-1.109 2.781-1.109 2.781-1.062 1.109-2.266 1.109-2.812 1.172 0 0-3.906 0.297-9.797 0.297v0c-7.281-0.063-9.516-0.281-9.516-0.281-0.625-0.109-2.031-0.078-3.094-1.188 0 0-0.859-0.859-1.109-2.781-0.297-2.266-0.281-4.531-0.281-4.531v-2.125s-0.016-2.266 0.281-4.531c0.25-1.937 1.109-2.781 1.109-2.781 1.062-1.125 2.266-1.125 2.812-1.188 0 0 3.906-0.281 9.797-0.281v0z"></path>
                                                                </svg></span></a><a href="mailto:humas@smkn3jogja.sch.id" aria-label="&quot;Email&quot;" class="social-button header-social-item social-link-email"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-email-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                    <title>Email</title>
                                                                    <path d="M15 2h-14c-0.55 0-1 0.45-1 1v10c0 0.55 0.45 1 1 1h14c0.55 0 1-0.45 1-1v-10c0-0.55-0.45-1-1-1zM5.831 9.773l-3 2.182c-0.1 0.073-0.216 0.108-0.33 0.108-0.174 0-0.345-0.080-0.455-0.232-0.183-0.251-0.127-0.603 0.124-0.786l3-2.182c0.251-0.183 0.603-0.127 0.786 0.124s0.127 0.603-0.124 0.786zM13.955 11.831c-0.11 0.151-0.282 0.232-0.455 0.232-0.115 0-0.23-0.035-0.33-0.108l-3-2.182c-0.251-0.183-0.307-0.534-0.124-0.786s0.535-0.307 0.786-0.124l3 2.182c0.251 0.183 0.307 0.535 0.124 0.786zM13.831 4.955l-5.5 4c-0.099 0.072-0.215 0.108-0.331 0.108s-0.232-0.036-0.331-0.108l-5.5-4c-0.251-0.183-0.307-0.534-0.124-0.786s0.535-0.307 0.786-0.124l5.169 3.759 5.169-3.759c0.251-0.183 0.603-0.127 0.786 0.124s0.127 0.603-0.124 0.786z"></path>
                                                                </svg></span></a></div>
                                                </div>
                                            </div><!-- data-section="header_social" -->
                                        </div>
                                        <div class="site-header-top-section-right site-header-section site-header-section-right">
                                            <div class="site-header-item site-header-focus-item site-header-item-main-navigation header-navigation-layout-stretch-false header-navigation-layout-fill-stretch-false" data-section="kadence_customizer_secondary_navigation">
                                                <nav id="secondary-navigation" class="secondary-navigation header-navigation nav--toggle-sub header-navigation-style-standard header-navigation-dropdown-animation-fade-up" role="navigation" aria-label="Secondary Navigation">
                                                    <div class="secondary-menu-container header-menu-container">
                                                        <ul id="secondary-menu" class="menu">
                                                            <li id="menu-item-1647" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1647"><a href="https://smkn3jogja.sch.id/berita/">Berita</a></li>
                                                            <li id="menu-item-1648" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1648"><a href="https://smkn3jogja.sch.id/artikel/">Artikel</a></li>
                                                            <li id="menu-item-1649" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-1649"><a href="https://smkn3jogja.sch.id/pengumuman/">Pengumuman</a></li>
                                                            <li id="menu-item-1692" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1692"><a href="http://kelasiber.skagata.sch.id/">LMS Kelasiber</a></li>
                                                            <li id="menu-item-1669" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1669"><a href="http://email.smkn3jogja.sch.id">Email Sekolah sch.id</a></li>
                                                        </ul>
                                                    </div>
                                                </nav><!-- #secondary-navigation -->
                                            </div><!-- data-section="secondary_navigation" -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="site-main-header-wrap site-header-row-container site-header-focus-item site-header-row-layout-standard" data-section="kadence_customizer_header_main">
                            <div class="site-header-row-container-inner">
                                <div class="site-container">
                                    <div class="site-main-header-inner-wrap site-header-row site-header-row-only-center-column site-header-row-center-column">
                                        <div class="site-header-main-section-center site-header-section site-header-section-center">
                                            <div class="site-header-item site-header-focus-item" data-section="title_tagline">
                                                <div class="site-branding branding-layout-standard site-brand-logo-only"><a class="brand" href="https://smkn3jogja.sch.id/" rel="home" aria-label="SMK Negeri 3 Yogyakarta"><img width="493" height="77" src="https://smkn3jogja.sch.id/wp-content/uploads/2016/05/cropped-Logo-WEB.png" class="custom-logo" alt="SMK Negeri 3 Yogyakarta" decoding="async" srcset="https://smkn3jogja.sch.id/wp-content/uploads/2016/05/cropped-Logo-WEB.png 493w, https://smkn3jogja.sch.id/wp-content/uploads/2016/05/cropped-Logo-WEB-768x119.png 768w" sizes="(max-width: 493px) 100vw, 493px"></a></div>
                                            </div><!-- data-section="title_tagline" -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Link Bawah -->
                <div class="site-bottom-header-wrap site-header-row-container site-header-focus-item site-header-row-layout-standard" data-section="kadence_customizer_header_bottom">
                    <div class="site-header-row-container-inner">
                        <div class="site-container">
                            <div class="site-bottom-header-inner-wrap site-header-row site-header-row-has-sides site-header-row-center-column">
                                <div class="site-header-bottom-section-left site-header-section site-header-section-left">
                                    <div class="site-header-bottom-section-left-center site-header-section site-header-section-left-center">
                                    </div>
                                </div>
                                <div class="site-header-bottom-section-center site-header-section site-header-section-center">
                                    <div class="site-header-item site-header-focus-item site-header-item-main-navigation header-navigation-layout-stretch-false header-navigation-layout-fill-stretch-false" data-section="kadence_customizer_primary_navigation">
                                        <nav id="site-navigation" class="main-navigation header-navigation nav--toggle-sub header-navigation-style-underline-fullheight header-navigation-dropdown-animation-fade-up" role="navigation" aria-label="Primary Navigation">
                                            <div class="primary-menu-container header-menu-container">
                                                <ul id="primary-menu" class="menu">
                                                    <li id="menu-item-453" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-453"><a href="dashboard.php" aria-current="page">Home</a></li>
                                                    <li id="menu-item-721" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721"><a href="daftar-buku.php">Daftar Buku</a></li>
                                                    <li id="menu-item-721" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721"><a href="issued-books.php">Buku Dipinjam</a></li>
                                                    <li id="menu-item-721" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721">
                                                        <?php
                                                        $sid = $_SESSION['stdid'];
                                                        $sql = "SELECT StudentId, FullName, Status FROM tblstudents WHERE StudentId=:sid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) { ?>
                                                                <p class="ml4 yellow f5">Welcome, <?php echo htmlentities($result->FullName); ?></p>
                                                        <?php }
                                                        } ?>
                                                    </li>
                                                    <li id="menu-item-721" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721 ml3"><a href="logout.php">Logout</a></li>
                                                </ul>
                                            </div>
                                        </nav><!-- #site-navigation -->
                                    </div><!-- data-section="primary_navigation" -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Respnosive Mobile Header -->
        <div id="mobile-header" class="site-mobile-header-wrap">
            <div class="site-header-inner-wrap">
                <div class="site-header-upper-wrap">
                    <div class="site-header-upper-inner-wrap" style="height: 161px;">
                        <div class="site-top-header-wrap site-header-focus-item site-header-row-layout-standard site-header-row-tablet-layout-default site-header-row-mobile-layout-default ">
                            <div class="site-header-row-container-inner">
                                <div class="site-container">
                                    <div class="site-top-header-inner-wrap site-header-row site-header-row-only-center-column site-header-row-center-column">
                                        <div class="site-header-top-section-center site-header-section site-header-section-center">
                                            <div class="site-header-item site-header-focus-item" data-section="kadence_customizer_mobile_social">
                                                <div class="header-mobile-social-wrap">
                                                    <div class="header-mobile-social-inner-wrap element-social-inner-wrap social-show-label-false social-style-outline social-show-brand-always"><a href="https://web.facebook.com/smkn3yogyakarta?_rdc=1&amp;_rdr" aria-label="&quot;Facebook&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-facebook"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-facebook-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="24" height="28" viewBox="0 0 24 28">
                                                                    <title>Facebook</title>
                                                                    <path d="M19.5 2c2.484 0 4.5 2.016 4.5 4.5v15c0 2.484-2.016 4.5-4.5 4.5h-2.938v-9.297h3.109l0.469-3.625h-3.578v-2.312c0-1.047 0.281-1.75 1.797-1.75l1.906-0.016v-3.234c-0.328-0.047-1.469-0.141-2.781-0.141-2.766 0-4.672 1.687-4.672 4.781v2.672h-3.125v3.625h3.125v9.297h-8.313c-2.484 0-4.5-2.016-4.5-4.5v-15c0-2.484 2.016-4.5 4.5-4.5h15z"></path>
                                                                </svg></span></a><a href="https://twitter.com/smkn3jogja" aria-label="&quot;Twitter&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-twitter"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-twitter-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="26" height="28" viewBox="0 0 26 28">
                                                                    <title>Twitter</title>
                                                                    <path d="M25.312 6.375c-0.688 1-1.547 1.891-2.531 2.609 0.016 0.219 0.016 0.438 0.016 0.656 0 6.672-5.078 14.359-14.359 14.359-2.859 0-5.516-0.828-7.75-2.266 0.406 0.047 0.797 0.063 1.219 0.063 2.359 0 4.531-0.797 6.266-2.156-2.219-0.047-4.078-1.5-4.719-3.5 0.313 0.047 0.625 0.078 0.953 0.078 0.453 0 0.906-0.063 1.328-0.172-2.312-0.469-4.047-2.5-4.047-4.953v-0.063c0.672 0.375 1.453 0.609 2.281 0.641-1.359-0.906-2.25-2.453-2.25-4.203 0-0.938 0.25-1.797 0.688-2.547 2.484 3.062 6.219 5.063 10.406 5.281-0.078-0.375-0.125-0.766-0.125-1.156 0-2.781 2.25-5.047 5.047-5.047 1.453 0 2.766 0.609 3.687 1.594 1.141-0.219 2.234-0.641 3.203-1.219-0.375 1.172-1.172 2.156-2.219 2.781 1.016-0.109 2-0.391 2.906-0.781z"></path>
                                                                </svg></span></a><a href="https://www.instagram.com/smkn3jogja/" aria-label="&quot;Instagram&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-instagram"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-instagram-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                                                                    <title>Instagram</title>
                                                                    <path d="M21.138 0.242c3.767 0.007 3.914 0.038 4.65 0.144 1.52 0.219 2.795 0.825 3.837 1.821 0.584 0.562 0.987 1.112 1.349 1.848 0.442 0.899 0.659 1.75 0.758 3.016 0.021 0.271 0.031 4.592 0.031 8.916s-0.009 8.652-0.030 8.924c-0.098 1.245-0.315 2.104-0.743 2.986-0.851 1.755-2.415 3.035-4.303 3.522-0.685 0.177-1.304 0.26-2.371 0.31-0.381 0.019-4.361 0.024-8.342 0.024s-7.959-0.012-8.349-0.029c-0.921-0.044-1.639-0.136-2.288-0.303-1.876-0.485-3.469-1.784-4.303-3.515-0.436-0.904-0.642-1.731-0.751-3.045-0.031-0.373-0.039-2.296-0.039-8.87 0-2.215-0.002-3.866 0-5.121 0.006-3.764 0.037-3.915 0.144-4.652 0.219-1.518 0.825-2.795 1.825-3.833 0.549-0.569 1.105-0.975 1.811-1.326 0.915-0.456 1.756-0.668 3.106-0.781 0.374-0.031 2.298-0.038 8.878-0.038h5.13zM15.999 4.364v0c-3.159 0-3.555 0.014-4.796 0.070-1.239 0.057-2.084 0.253-2.824 0.541-0.765 0.297-1.415 0.695-2.061 1.342s-1.045 1.296-1.343 2.061c-0.288 0.74-0.485 1.586-0.541 2.824-0.056 1.241-0.070 1.638-0.070 4.798s0.014 3.556 0.070 4.797c0.057 1.239 0.253 2.084 0.541 2.824 0.297 0.765 0.695 1.415 1.342 2.061s1.296 1.046 2.061 1.343c0.74 0.288 1.586 0.484 2.825 0.541 1.241 0.056 1.638 0.070 4.798 0.070s3.556-0.014 4.797-0.070c1.239-0.057 2.085-0.253 2.826-0.541 0.765-0.297 1.413-0.696 2.060-1.343s1.045-1.296 1.343-2.061c0.286-0.74 0.482-1.586 0.541-2.824 0.056-1.241 0.070-1.637 0.070-4.797s-0.015-3.557-0.070-4.798c-0.058-1.239-0.255-2.084-0.541-2.824-0.298-0.765-0.696-1.415-1.343-2.061s-1.295-1.045-2.061-1.342c-0.742-0.288-1.588-0.484-2.827-0.541-1.241-0.056-1.636-0.070-4.796-0.070zM14.957 6.461c0.31-0 0.655 0 1.044 0 3.107 0 3.475 0.011 4.702 0.067 1.135 0.052 1.75 0.241 2.16 0.401 0.543 0.211 0.93 0.463 1.337 0.87s0.659 0.795 0.871 1.338c0.159 0.41 0.349 1.025 0.401 2.16 0.056 1.227 0.068 1.595 0.068 4.701s-0.012 3.474-0.068 4.701c-0.052 1.135-0.241 1.75-0.401 2.16-0.211 0.543-0.463 0.93-0.871 1.337s-0.794 0.659-1.337 0.87c-0.41 0.16-1.026 0.349-2.16 0.401-1.227 0.056-1.595 0.068-4.702 0.068s-3.475-0.012-4.702-0.068c-1.135-0.052-1.75-0.242-2.161-0.401-0.543-0.211-0.931-0.463-1.338-0.87s-0.659-0.794-0.871-1.337c-0.159-0.41-0.349-1.025-0.401-2.16-0.056-1.227-0.067-1.595-0.067-4.703s0.011-3.474 0.067-4.701c0.052-1.135 0.241-1.75 0.401-2.16 0.211-0.543 0.463-0.931 0.871-1.338s0.795-0.659 1.338-0.871c0.41-0.16 1.026-0.349 2.161-0.401 1.073-0.048 1.489-0.063 3.658-0.065v0.003zM16.001 10.024c-3.3 0-5.976 2.676-5.976 5.976s2.676 5.975 5.976 5.975c3.3 0 5.975-2.674 5.975-5.975s-2.675-5.976-5.975-5.976zM16.001 12.121c2.142 0 3.879 1.736 3.879 3.879s-1.737 3.879-3.879 3.879c-2.142 0-3.879-1.737-3.879-3.879s1.736-3.879 3.879-3.879zM22.212 8.393c-0.771 0-1.396 0.625-1.396 1.396s0.625 1.396 1.396 1.396 1.396-0.625 1.396-1.396c0-0.771-0.625-1.396-1.396-1.396v0.001z"></path>
                                                                </svg></span></a><a href="https://www.youtube.com/skagatatv" aria-label="&quot;YouTube&quot;" target="_blank" rel="noopener noreferrer" class="social-button header-social-item social-link-youtube"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-youtube-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
                                                                    <title>YouTube</title>
                                                                    <path d="M11.109 17.625l7.562-3.906-7.562-3.953v7.859zM14 4.156c5.891 0 9.797 0.281 9.797 0.281 0.547 0.063 1.75 0.063 2.812 1.188 0 0 0.859 0.844 1.109 2.781 0.297 2.266 0.281 4.531 0.281 4.531v2.125s0.016 2.266-0.281 4.531c-0.25 1.922-1.109 2.781-1.109 2.781-1.062 1.109-2.266 1.109-2.812 1.172 0 0-3.906 0.297-9.797 0.297v0c-7.281-0.063-9.516-0.281-9.516-0.281-0.625-0.109-2.031-0.078-3.094-1.188 0 0-0.859-0.859-1.109-2.781-0.297-2.266-0.281-4.531-0.281-4.531v-2.125s-0.016-2.266 0.281-4.531c0.25-1.937 1.109-2.781 1.109-2.781 1.062-1.125 2.266-1.125 2.812-1.188 0 0 3.906-0.281 9.797-0.281v0z"></path>
                                                                </svg></span></a><a href="mailto:humas@smkn3jogja.sch.id" aria-label="&quot;Email&quot;" class="social-button header-social-item social-link-email"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-email-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                                                                    <title>Email</title>
                                                                    <path d="M15 2h-14c-0.55 0-1 0.45-1 1v10c0 0.55 0.45 1 1 1h14c0.55 0 1-0.45 1-1v-10c0-0.55-0.45-1-1-1zM5.831 9.773l-3 2.182c-0.1 0.073-0.216 0.108-0.33 0.108-0.174 0-0.345-0.080-0.455-0.232-0.183-0.251-0.127-0.603 0.124-0.786l3-2.182c0.251-0.183 0.603-0.127 0.786 0.124s0.127 0.603-0.124 0.786zM13.955 11.831c-0.11 0.151-0.282 0.232-0.455 0.232-0.115 0-0.23-0.035-0.33-0.108l-3-2.182c-0.251-0.183-0.307-0.534-0.124-0.786s0.535-0.307 0.786-0.124l3 2.182c0.251 0.183 0.307 0.535 0.124 0.786zM13.831 4.955l-5.5 4c-0.099 0.072-0.215 0.108-0.331 0.108s-0.232-0.036-0.331-0.108l-5.5-4c-0.251-0.183-0.307-0.534-0.124-0.786s0.535-0.307 0.786-0.124l5.169 3.759 5.169-3.759c0.251-0.183 0.603-0.127 0.786 0.124s0.127 0.603-0.124 0.786z"></path>
                                                                </svg></span></a></div>
                                                </div>
                                            </div><!-- data-section="mobile_social" -->

                                            <div id="mobile-drawer" class="popup-drawer popup-drawer-layout-sidepanel popup-drawer-animation-fade popup-drawer-side-right show-drawer active pop-animated" data-drawer-target-string="#mobile-drawer">
                                                <div class="drawer-overlay" data-drawer-target-string="#mobile-drawer"></div>
                                                <div class="drawer-inner">
                                                    <div class="drawer-header">
                                                        <button class="menu-toggle-close drawer-toggle" aria-label="Close menu" data-toggle-target="#mobile-drawer" data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="true" data-set-focus=".menu-toggle-open" value="">
                                                            <span class="toggle-close-bar"></span>
                                                            <span class="toggle-close-bar"></span>
                                                        </button>
                                                    </div>
                                                    <div class="drawer-content mobile-drawer-content content-align-left content-valign-top">
                                                        <div class="site-header-item site-header-focus-item site-header-item-mobile-navigation mobile-navigation-layout-stretch-false" data-section="kadence_customizer_mobile_navigation">
                                                            <nav id="mobile-site-navigation" class="mobile-navigation drawer-navigation drawer-navigation-parent-toggle-false" role="navigation" aria-label="Primary Mobile Navigation">
                                                                <div class="mobile-menu-container drawer-menu-container">
                                                                    <ul id="mobile-menu" class="menu has-collapse-sub-nav">
                                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-453"><a href="dashboard.php" aria-current="page">Home</a></li>
                                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721"><a href="daftar-buku.php">Daftar Buku</a></li>
                                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721"><a href="issued-books.php">Buku dipinjam</a></li>
                                                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-721"><a href="logout.php">Logout</a></li>
                                                                    </ul>
                                                                </div>
                                                            </nav><!-- #site-navigation -->
                                                        </div><!-- data-section="mobile_navigation" -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="site-main-header-wrap site-header-focus-item site-header-row-layout-standard site-header-row-tablet-layout-default site-header-row-mobile-layout-default  kadence-sticky-header" data-shrink="true" data-shrink-height="60" data-start-height="125">
                            <div class="site-header-row-container-inner">
                                <div class="site-container">
                                    <div class="site-main-header-inner-wrap site-header-row site-header-row-has-sides site-header-row-no-center" data-start-height="125" style="height: 125px; min-height: 125px; max-height: 125px;">
                                        <div class="site-header-main-section-left site-header-section site-header-section-left">
                                            <div class="site-header-item site-header-focus-item" data-section="title_tagline">
                                                <div class="site-branding mobile-site-branding branding-layout-standard branding-tablet-layout-inherit site-brand-logo-only branding-mobile-layout-standard site-brand-logo-only"><a class="brand" href="https://smkn3jogja.sch.id/" rel="home" aria-label="SMK Negeri 3 Yogyakarta"><img width="1567" height="1566" src="https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk.png" class="custom-logo extra-custom-logo" alt="SMK Negeri 3 Yogyakarta" decoding="async" fetchpriority="high" srcset="https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk.png 1567w, https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk-300x300.png 300w, https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk-1024x1024.png 1024w, https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk-768x767.png 768w, https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk-1536x1536.png 1536w, https://smkn3jogja.sch.id/wp-content/uploads/2021/07/logosmk3yk-2048x2048.png 2048w" sizes="(max-width: 1567px) 100vw, 1567px" style="max-height: 100%;"></a></div>
                                            </div><!-- data-section="title_tagline" -->
                                        </div>

                                        <div class="site-header-main-section-right site-header-section site-header-section-right">
                                            <div class="site-header-item site-header-focus-item site-header-item-navgation-popup-toggle" data-section="kadence_customizer_mobile_trigger">
                                                <div class="mobile-toggle-open-container" style="position: relative; z-index: 9999;">
                                                    <button id="mobile-toggle" class="menu-toggle-open drawer-toggle menu-toggle-style-default" aria-label="Open menu" data-toggle-target="#mobile-drawer" data-toggle-body-class="showing-popup-drawer-from-right" aria-expanded="false" data-set-focus=".menu-toggle-close">
                                                        <span class="menu-toggle-icon"><span class="kadence-svg-iconset"><svg class="kadence-svg-icon kadence-menu2-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svg" width="24" height="28" viewBox="0 0 24 28">
                                                                    <title>Toggle Menu</title>
                                                                    <path d="M24 21v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 13v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 5v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1z"></path>
                                                                </svg></span></span>
                                                    </button>
                                                </div>
                                            </div><!-- data-section="mobile_trigger" -->
                                            <div class="site-header-item site-header-focus-item" data-section="kadence_customizer_header_search">
                                                <div class="search-toggle-open-container">
                                                    <button class="search-toggle-open drawer-toggle search-toggle-style-default" aria-label="View Search Form" data-toggle-target="#search-drawer" data-toggle-body-class="showing-popup-drawer-from-full" aria-expanded="false" data-set-focus="#search-drawer .search-field">
                                                        <span class="search-toggle-icon"><span class="kadence-svg-iconset"><svg aria-hidden="true" class="kadence-svg-icon kadence-search-svg" fill="currentColor" version="1.1" xmlns="https://www.w3.org/2000/svFg" width="26" height="28" viewBox="0 0 26 28">
                                                                    <title>Search</title>
                                                                    <path d="M18 13c0-3.859-3.141-7-7-7s-7 3.141-7 7 3.141 7 7 7 7-3.141 7-7zM26 26c0 1.094-0.906 2-2 2-0.531 0-1.047-0.219-1.406-0.594l-5.359-5.344c-1.828 1.266-4.016 1.937-6.234 1.937-6.078 0-11-4.922-11-11s4.922-11 11-11 11 4.922 11 11c0 2.219-0.672 4.406-1.937 6.234l5.359 5.359c0.359 0.359 0.578 0.875 0.578 1.406z"></path>
                                                                </svg></span></span>
                                                    </button>
                                                </div>
                                            </div><!-- data-section="header_search" -->
                                            <div id="mobile-drawer" class="popup-drawer popup-drawer-layout-sidepanel popup-drawer-animation-fade popup-drawer-side-right" data-drawer-target-string="#mobile-drawer">
                                                <div class="drawer-overlay" data-drawer-target-string="#mobile-drawer"></div>
                                                <div class="drawer-inner">
                                                    <div class="drawer-header">
                                                        <button class="menu-toggle-close drawer-toggle" aria-label="Close menu" data-toggle-target="#mobile-drawer" aria-expanded="false">
                                                            <span class="toggle-close-bar"></span>
                                                            <span class="toggle-close-bar"></span>
                                                        </button>
                                                    </div>
                                                    <div class="drawer-content mobile-drawer-content content-align-left content-valign-top">
                                                        <nav id="mobile-site-navigation" class="mobile-navigation" role="navigation" aria-label="Primary Mobile Navigation">
                                                            <div class="mobile-menu-container drawer-menu-container">
                                                                <ul id="mobile-menu" class="menu has-collapse-sub-nav">
                                                                    <li class="menu-item menu-item-home"><a href="dashboard.php">Home</a></li>
                                                                    <li class="menu-item"><a href="daftar-buku.php">Daftar Buku</a></li>
                                                                    <li class="menu-item"><a href="issued-books.php">Buku dipinjam</a></li>
                                                                    <li class="menu-item"><a href="logout.php">Logout</a></li>
                                                                </ul>
                                                            </div>
                                                        </nav>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const drawer = document.getElementById('mobile-drawer');
            const toggleButton = document.getElementById('mobile-toggle');
            const closeButton = drawer.querySelector('.menu-toggle-close');
            const overlay = drawer.querySelector('.drawer-overlay');

            // Open drawer
            toggleButton.addEventListener('click', function() {
                const isOpen = drawer.classList.contains('show-drawer');
                drawer.classList.toggle('show-drawer', !isOpen);
                drawer.classList.toggle('active', !isOpen);
                toggleButton.setAttribute('aria-expanded', !isOpen);
            });

            // Close drawer when overlay or close button is clicked
            [closeButton, overlay].forEach(el => {
                el.addEventListener('click', function() {
                    drawer.classList.remove('show-drawer', 'active');
                    toggleButton.setAttribute('aria-expanded', false);
                });
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= MAINTITLE; ?> <?= (isset($title)) ? '| ' . $title : '';  ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- Libraries Stylesheet -->
        <link href="<?= base_url('assets/user/') ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
        <link href="<?= base_url('assets/user/') ?>lib/lightbox/css/lightbox.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?= base_url('assets/user/') ?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?= base_url('assets/user/') ?>css/style.css" rel="stylesheet">
        <link href="<?= base_url('assets/user/') ?>css/organization.css" rel="stylesheet">
        <link href="<?= base_url('assets/user/') ?>css/carousel.css" rel="stylesheet">

        <!-- Link Fontawesome -->
        <link rel="stylesheet" 
            href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity= "sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" 
            referrerpolicy="no-referrer" />

        <!-- Link Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top px-0">
            <div class="container px-0">
                <div class="topbar d-none">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-8">
                            <div class="topbar-info d-flex flex-wrap">
                                <a href="#" class="text-light me-4"><i class="fas fa-envelope text-white me-2"></i>Example@gmail.com</a>
                                <a href="#" class="text-light"><i class="fas fa-phone-alt text-white me-2"></i>+01234567890</a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="topbar-icon d-flex align-items-center justify-content-end">
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="btn-square text-white me-2"><i class="fab fa-pinterest"></i></a>
                                <a href="#" class="btn-square text-white me-0"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <nav class="navbar navbar-light bg-light navbar-expand-xl p-2">
                    <a href="index.html" class="navbar-brand ms-3">
                        <h1 class="text-primary display-5">Desaku</h1>
                    </a>
                    <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="#banner" class="nav-item nav-link active">Banner</a>
                            <a href="#tentang" class="nav-item nav-link">Tentang Desa</a>
                            <a href="#agenda" class="nav-item nav-link">Agenda</a>
                            <a href="#berita" class="nav-item nav-link">Berita</a>
                            <a href="#wisata" class="nav-item nav-link">Wisata</a>
                            <a href="favorit.html" class="nav-item nav-link">Favorit</a>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalDaftar" class="btn-hover-bg btn btn-outline-primary text-primary py-2 px-4 ms-3">Daftar</button>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap pt-xl-0" style="margin-right: 15px;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalLogin" class="btn-hover-bg btn btn-primary text-white py-2 px-4 ms-3">Masuk</button>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

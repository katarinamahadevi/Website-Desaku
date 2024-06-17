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
         <link rel="shortcut icon" href="<?= image_check($setting->icon,'icon'); ?>" />
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
        <link href="<?= base_url('assets/public/') ?>css/custom_pribadi.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/public/js/alert/sweetalert2.css') ?>">
        <!-- Link Fontawesome -->
        <link rel="stylesheet" 
            href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity= "sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" 
            referrerpolicy="no-referrer" />

        <!-- Link Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
            .absolute-modal-btn{
                position: absolute !important;
                right: 0 !important;
                width: 80px !important;
            }
            .image_profil{
                width : 50px;
                height : 50px;
                background-position : center;
                background-repeat : no-repeat;
                background-size : cover;
                border-radius : 100%;
            }
            input[type="checkbox"]{
                cursor: pointer;
            }
        </style>
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top px-0" >
            <div class="container shadow-sm px-0" style="max-width : 85%">
                <nav class="navbar navbar-light bg-light navbar-expand-xl p-2 px-4">
                    <a href="<?= base_url('beranda') ?>" class="navbar-brand ms-3">
                        <img width="150px" src="<?= image_check($setting->logo,'logo') ?>" class="my-3">
                    </a>
                    <button class="navbar-toggler py-2 px-3 me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light" id="navbarCollapse">
                        <div class="navbar-nav ms-auto">
                            <a href="#beranda" class="nav-item nav-link active">Beranda</a>
                            <a href="#tentang" class="nav-item nav-link">Tentang Desa</a>
                            <a href="#agenda" class="nav-item nav-link">Agenda</a>
                            <a href="#berita" class="nav-item nav-link">Berita</a>
                            <a href="#wisata" class="nav-item nav-link">Wisata</a>
                            <?php if($this->session->userdata(PREFIX_SESSION.'_id_user')) : ?>
                                <a role="button" class="nav-item nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavorit" aria-controls="offcanvasFavorit">Favorit</a>
                            <?php endif;?>
                        </div>
                        <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                            <?php if(!$this->session->userdata(PREFIX_SESSION.'_id_user')) : ?>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalAuth" class="btn-hover-bg btn btn-outline-primary text-primary py-2 px-4 ms-3">Masuk</button>
                            <?php else: ?>
                                <div class="image_profil" style="background-image : url('<?= image_check($this->session->userdata(PREFIX_SESSION.'_foto'),'user') ?>');">
                                    <button type="button" class="bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#offcanvasProfil" aria-controls="offcanvasProfil" style="width: 100%; height: 100%; border: none;"></button>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

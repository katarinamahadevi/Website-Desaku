<!-- Banner Start -->
<section id="banner">
    <div class="container-fluid carousel-header vh-100 px-0">
        <div id="carouselId" class="carousel" data-bs-ride="">
            <ol class="carousel-indicators d-none">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="<?= base_url('assets/user/') ?>img/carousel-1.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Protect Environment</h1>
                            <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            </p>
                            <div class="d-flex align-items-center justify-content-center d-none">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item d-none">
                    <img src="<?= base_url('assets/user/') ?>img/carousel-2.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Protect Environment</h1>
                            <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item d-none">
                    <img src="<?= base_url('assets/user/') ?>img/carousel-3.jpg" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4" style="letter-spacing: 3px;">WE'll Save Our Planet</h4>
                            <h1 class="display-1 text-capitalize text-white mb-4">Protect Environment</h1>
                            <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                            </p>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-hover-bg btn btn-primary text-white py-3 px-5" href="#">Join With Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>           
</section>
<!-- Banner End -->

<!-- Tentang Start -->
<section id="tentang">
    <div class="container-fluid about  py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-xl-5">
                    <div class="h-100">
                        <img src="<?= base_url('assets/user/') ?>img/produk/pedesaan.jpg" class="img-fluid w-100 h-100" alt="Image">
                    </div>
                </div>
                <div class="col-xl-7">
                    <h5 class="text-uppercase text-primary">Tentang Desaku</h5>
                    <h1 class="mb-4">Informasi seputar DESAKU</h1>
                    <p class="fs-5 mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has
                    </p>
                    <div class="tab-class bg-secondary p-4">
                        <ul class="nav d-flex justify-content-center align-items-center mb-2">
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white active" data-bs-toggle="pill" href="#tab-1">
                                    <span class="text-dark" style="width: 150px;">Lokasi Desa</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 mx-3 text-center bg-white" data-bs-toggle="pill" href="#tab-2">
                                    <span class="text-dark" style="width: 150px;">Jumlah Penduduk</span>
                                </a>
                            </li>
                            <li class="nav-item mb-3">
                                <a class="d-flex py-2 text-center bg-white" data-bs-toggle="pill" href="#tab-3">
                                    <span class="text-dark" style="width: 150px;">Lokasi Penting</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane fade show p-0 active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <h5 class="text-uppercase mb-3">DESAKU terletak di...</h5>
                                                <ol class="list-group list-group-numbered" style="overflow-y: scroll; height: 200px;">
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                        <div class="fw-bold">Alamat Lengkap</div>
                                                        <p class="mb-0">Blok BE No.12A, Jalan Raya Jl. Pd. Jati No.37, 61252, Pondokjati, Pagerwojo, Kec. Buduran, Kabupaten Sidoarjo, Jawa Timur 61252</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                        <div class="fw-bold">Kecamatan</div>
                                                        <p class="mb-0">Buduran</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">Kota/Kabupaten</div>
                                                            <p class="mb-0">Kabupaten Sidoarjo</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">Kode Pos</div>
                                                            <p class="mb-0">61252</p>
                                                        </div>
                                                    </li>
                                                </ol>
                                                <div class="d-flex align-items-center justify-content-start d-none">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane fade show p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="text-start my-auto">
                                                <h5 class="text-uppercase mb-3">DESAKU memiliki penduduk sebanyak...</h5>
                                                <div class="container d-flex justify-content-start align-items-start">
                                                    <div class="chart" style="position: relative; height:215px; width:215px;">
                                                        <canvas id="myChart"></canvas>
                                                    </div>          
                                                    <div class="detail-data mt-4">
                                                        <ol class="list-group list-group-numbered">
                                                            <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                                <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Jumlah Total Penduduk</div>
                                                                    <p class="mb-0">2.600 Penduduk</p>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                                <div class="ms-2 me-auto">
                                                                <div class="fw-bold">Jumlah Laki-laki</div>
                                                                    <p class="mb-0">1.250 Penduduk</p>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                                <div class="ms-2 me-auto">
                                                                    <div class="fw-bold">Jumlah Perempuan</div>
                                                                    <p class="mb-0">1.350 Penduduk</p>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </div>                                               
                                                </div>
                                                <div class="d-flex align-items-center justify-content-start d-none">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane fade show p-0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="text-start my-auto">
                                                <h5 class="text-uppercase mb-3">DESAKU memiliki banyak lokasi penting seperti...</h5>
                                                <ol class="list-group list-group-numbered">
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                        <div class="fw-bold">Puskesmas DESAKU</div>
                                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur.</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                        <div class="fw-bold">Sekolah Dasar Negeri 1 DESAKU</div>
                                                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur.</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">Sekolah Menengah Pertama 1 DESAKU</div>
                                                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur.</p>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-start bg-transparent border-0 py-1">
                                                        <div class="ms-2 me-auto">
                                                            <div class="fw-bold">Kantor Kepala DESAKU</div>
                                                            <p class="mb-0">Lorem ipsum dolor sit amet consectetur.</p>
                                                        </div>
                                                    </li>
                                                </ol>
                                                <div class="d-flex align-items-center justify-content-start d-none">
                                                    <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
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

    <div class="container-fluid service py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Struktur DESAKU</h5>
                <h1 class="mb-0">Struktur Pemerintahan DESAKU</h1>
            </div>
            <div class="row d-flex g-4 d-none">
                <h6 class="level-1 text-center rectangle">Kepala Desa</h6>
                <ol class="level-2-wrapper">
                    <li>
                        <h6 class="level-2 text-center rectangle">Kepala Desa</h6>
                        <ol class="level-3-wrapper">
                            <li>
                                <h6 class="level-3 text-center rectangle">Kepala Dusun I</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kepala Dusun II</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kepala Dusun III</h6>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <h6 class="level-2 text-center rectangle">Sekretaris Desa</h6>
                        <ol class="level-3-wrapper">
                            <li>
                                <h6 class="level-3 text-center rectangle">Kaur TU & Umum</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kaur Keuangan</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kaur Perencanaan</h6>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <h6 class="level-2 text-center rectangle">Kepala Desa</h6>
                        <ol class="level-3-wrapper">
                            <li>
                                <h6 class="level-3 text-center rectangle">Kasi Pemerintahan</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kasi Kesejahteraan</h6>
                            </li>
                            <li>
                                <h6 class="level-3 text-center rectangle">Kasi Pelayanan</h6>
                            </li>
                        </ol>
                    </li>
                </ol>
            </div>

            <div id="myCarousel" class="carousel slide container d-none" data-bs-ride="carousel">
                <div class="carousel-inner w-100">
                    <div class="carousel-item active">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="col-md-3">
                            <div class="card" style="width: 20rem;">
                                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                                    <div class="circle-profile my-3" style="background-image: url('<?= base_url('assets/user/')?>img/produk/camping.jpg')">
                                        <!-- <img src="<?= base_url('assets/user/')?>img/produk/camping.jpg" class="card-img-top" alt="..."> -->
                                    </div>
                                    <h4 class="card-title">Ir. Jhon Doe S.E</h4>
                                    <p class="card-text text-center fs-5 mb-3">Kepala Desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <ul class="carousel">
                    <li class="card">
                        <div class="img"><img src="images/img-1.jpg" alt="img" draggable="false"></div>
                        <h2>Blanche Pearson</h2>
                        <span>Sales Manager</span>
                    </li>
                    <li class="card">
                        <div class="img"><img src="images/img-2.jpg" alt="img" draggable="false"></div>
                        <h2>Joenas Brauers</h2>
                        <span>Web Developer</span>
                    </li>
                        <li class="card">
                        <div class="img"><img src="images/img-3.jpg" alt="img" draggable="false"></div>
                        <h2>Lariach French</h2>
                        <span>Online Teacher</span>
                    </li>
                    <li class="card">
                        <div class="img"><img src="images/img-4.jpg" alt="img" draggable="false"></div>
                        <h2>James Khosravi</h2>
                        <span>Freelancer</span>
                    </li>
                    <li class="card">
                        <div class="img"><img src="images/img-5.jpg" alt="img" draggable="false"></div>
                        <h2>Kristina Zasiadko</h2>
                        <span>Bank Manager</span>
                    </li>
                    <li class="card">
                        <div class="img"><img src="images/img-6.jpg" alt="img" draggable="false"></div>
                        <h2>Donald Horton</h2>
                        <span>App Designer</span>
                    </li>
                </ul>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </div>
    </div>
</section>
<!-- Tentang End -->

<!-- Agenda Start -->
<section id="agenda">
    <div class="container-fluid donation py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Agenda DESAKU</h5>
                <h1 class="mb-0">Agenda Rutinitas Warga DESAKU</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="donation-item">
                        <img src="<?= base_url('assets/user/') ?>img/donation-1.jpg" class="img-fluid w-100" alt="Image">
                        <div class="donation-content d-flex flex-column">
                            <h5 class="text-uppercase text-primary mb-3">01 - 01 - 2024</h5>
                            <a href="#" class="btn-hover-color display-6 text-white mb-3">Penanaman Hutan Kembali</a> 
                            <p class="text-white mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            <div class="donation-btn d-flex align-items-center justify-content-start">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="donation-item">
                        <img src="<?= base_url('assets/user/') ?>img/service-2.jpg" class="img-fluid w-100" alt="Image">
                        <div class="donation-content d-flex flex-column">
                            <h5 class="text-uppercase text-primary mb-3">01 - 08 - 2024</h5>
                            <a href="#" class="btn-hover-color display-6 text-white mb-3">Pembersihan Sungai DESAKU</a>
                            <p class="text-white mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            <div class="donation-btn d-flex align-items-center justify-content-start">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="donation-item">
                        <img src="<?= base_url('assets/user/') ?>img/donation-3.jpg" class="img-fluid w-100" alt="Image">
                        <div class="donation-content d-flex flex-column">
                            <h5 class="text-uppercase text-primary mb-3">01 - 10 - 2024</h5>
                            <a href="#" class="btn-hover-color display-6 text-white mb-3">Pembersihan Sampah DESAKU</a>
                            <p class="text-white mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                            <div class="donation-btn d-flex align-items-center justify-content-start">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-none">
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" href="#">All Donation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Agenda End -->

<!-- Berita Start -->
<section id="berita">
    <div class="container-fluid blog py-5 mb-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Berita Terbaru</h5>
                <h1 class="mb-0">Berita Terbaru dan Terupdate Seputar DESAKU</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= base_url('assets/user/') ?>img/blog-1.jpg" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Des, 01.2024</span>
                                <div class="d-flex">
                                    <a href="#" class="text-white">1 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="img/blog-1.jpg" data-lightbox="Blog-1" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 card blog-card">
                            <ul class="list-group list-group-flush border-0">
                                <li class="border-0" style="list-style: none;">
                                    <h4 class="mb-4">Kebakaran Hutan di kota X</h4>
                                </li>
                                <li class="border-0" style="list-style: none;">
                                    <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor....</p>
                                </li>
                            </ul>
                            <div class="card-footer bg-transparent ps-0 border-0">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal" href="#modalDetailBerita" role="button">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= base_url('assets/user/') ?>img/blog-2.jpg" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Des 01.2024</span>
                                <div class="d-flex">
                                    <a href="#" class="text-white">3 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="img/blog-2.jpg" data-lightbox="Blog-2" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 card blog-card">
                            <ul class="list-group list-group-flush border-0">
                                <li class="border-0" style="list-style: none;">
                                    <h4 class="mb-4">Kincir Angin di Negara X</h4>
                                </li>
                                <li class="border-0" style="list-style: none;">
                                    <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor....</p>
                                </li>
                            </ul>
                            <div class="card-footer bg-transparent ps-0">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal" href="#modalDetailBerita" role="button">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= base_url('assets/user/') ?>img/blog-3.jpg" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Des 01.2024</span>
                                <div class="d-flex">
                                    <a href="#" class="text-white">7 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="img/blog-3.jpg" data-lightbox="Blog-3" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 card blog-card">
                            <ul class="list-group list-group-flush border-0">
                                <li class="border-0" style="list-style: none;">
                                    <h4 class="mb-4">Indah Sungai dan Air Terjun di Kota X</h4>
                                </li>
                                <li class="border-0" style="list-style: none;">
                                    <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor....</p>
                                </li>
                            </ul>
                            <div class="card-footer bg-transparent ps-0">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal" href="#modalDetailBerita" role="button">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= base_url('assets/user/') ?>img/blog-4.jpg" class="img-fluid w-100" alt="">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> Des 01.2024</span>
                                <div class="d-flex">
                                    <a href="#" class="text-white">5 <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="img/blog-4.jpg" data-lightbox="Blog-4" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 card blog-card">
                            <ul class="list-group list-group-flush border-0">
                                <li class="border-0" style="list-style: none;">
                                    <h4 class="mb-4">Hutan Tropis di Negara X</h4>
                                </li>
                                <li class="border-0" style="list-style: none;">
                                    <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor....</p>
                                </li>
                            </ul>
                            <div class="card-footer bg-transparent ps-0">
                                <a class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal" href="#modalDetailBerita" role="button">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Berita End -->

<!-- Wisata Start -->
<section id="wisata">
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Wisata Desaku</h5>
                <h1 class="mb-0">DESAKU memiliki banyak tempat wisata yang indah dan seru</h1>
            </div>
            <div class="event-carousel owl-carousel">
                <div class="event-item">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/waterfall.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Pagerwojo, Desaku</span>
                            <!-- <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>01 Des, 2024</span> -->
                            <div class="hello"> 
                                <button class="like" id="like" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavorit" aria-controls="offcanvasFavorit"> 
                                    <i class="bx bx-heart fs-3" style="color: #757575;"></i>
                                </button> 
                            </div>
                        </div>
                        <h4 class="mb-4">Air Terjun DESAKU</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalDetailTiket" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Detail Tiket    </button>
                    </div>
                </div>
                <div class="event-item">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/garden.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Pagerwojo, Desaku</span>
                            <!-- <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>01 Des, 2024</span> -->
                            <div class="hello"> 
                                <button class="like" id="like" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavorit" aria-controls="offcanvasFavorit"> 
                                    <i class="bx bx-heart fs-3" style="color: #757575;"></i>
                                </button> 
                            </div>
                        </div>
                        <h4 class="mb-4">Taman Indah DESAKU</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Pesan Tiket</button>
                    </div>
                </div>
                <div class="event-item">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/relax.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Pagerwojo, Desaku</span>
                            <!-- <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>01 Des, 2024</span> -->
                            <div class="hello"> 
                                <button class="like" id="like" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavorit" aria-controls="offcanvasFavorit"> 
                                    <i class="bx bx-heart fs-3" style="color: #757575;"></i>
                                </button> 
                            </div>
                        </div>
                        <h4 class="mb-4">Wisata "Relax" DESAKU</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Pesan Tiket</button>
                    </div>
                </div>
                <div class="event-item">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/camping.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i>Pagerwojo, Desaku</span>
                            <!-- <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>01 Des, 2024</span> -->
                            <div class="hello"> 
                                <button class="like" id="like" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavorit" aria-controls="offcanvasFavorit"> 
                                    <i class="bx bx-heart fs-3" style="color: #757575;"></i>
                                </button> 
                            </div>
                        </div>
                        <h4 class="mb-4">Wisata "The Camping" DESAKU</h4>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Pesan Tiket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Wisata End -->


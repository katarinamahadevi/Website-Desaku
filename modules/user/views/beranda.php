<!-- Beranda Start -->
<?php if($banner) : ?>
<section id="beranda">
    <div class="container-fluid carousel-header vh-100 px-0">
        <div id="carouselId" class="carousel" data-bs-ride="">
            <ol class="carousel-indicators">
                <?php $no = 0; foreach($banner AS $row) : $num = $no++?>
                <li data-bs-target="#carouselId" data-bs-slide-to="<?= $num; ?>" class="<?= ($num == 0) ? 'active' : ''; ?>"></li>
                <?php endforeach;?>
            </ol>
            <div class="carousel-inner" role="listbox">
                <?php $no = 0; foreach($banner AS $row) : $num = $no++?>
                <div class="carousel-item <?= ($num == 0) ? 'active' : ''; ?>">
                    <img src="<?= image_check($row->gambar,'banner'); ?>" class="img-fluid" alt="Image">
                    <div class="carousel-caption">
                        <div class="p-3" style="max-width: 900px;">
                            <h1 class="display-1 text-capitalize text-white mb-4"><?= $row->title; ?></h1>
                            <p class="mb-5 fs-5"> <?= $row->deskripsi; ?>; 
                            </p>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>           
</section>
<?php endif;?>
<!-- Beranda End -->

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

    <?php if($pengurus) : ?>
    <div class="container-fluid service py-5 bg-light">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Struktur DESAKU</h5>
                <h1 class="mb-0">Struktur Pemerintahan DESAKU</h1>
            </div>

            <div id="struktural" class="row">
                <div class="col-xl-12 d-flex justify-content-center align-items-center">
                    <div class="wrapper">
                        <i id="left" class="prevnextcar fa-solid fa-angle-left"></i>
                        <ul class="carousel">
                            <?php foreach($pengurus AS $row) : ?>
                            <li class="card">
                                <div class="img"><img src="<?= image_check($row->gambar,'pengurus') ?>" alt="img" draggable="false"></div>
                                <h2><?= $row->nama; ?></h2>
                                <span><?= $row->jabatan; ?></span>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <i id="right" class="prevnextcar fa-solid fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
</section>
<!-- Tentang End -->

<?php if($agenda) : ?>
<!-- Agenda Start -->
<section id="agenda">
    <div class="container-fluid donation py-5">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">AGENDA DESAKU</h5>
                <h1 class="mb-0">Agenda Rutinitas Warga DESAKU</h1>
            </div>
            <div class="row g-4">
                <?php foreach($agenda AS $row) : ?>
                <div class="col-lg-4">
                    <div class="donation-item">
                        <img src="<?= image_check($row->gambar,'agenda') ?>" class="img-fluid w-100" alt="Image" style="height : 400px;">
                        <div class="donation-content d-flex flex-column">
                            <h5 class="text-uppercase text-primary mb-3"><?= date('d-m-Y',strtotime($row->create_date)); ?></h5>
                            <a href="#" class="btn-hover-color display-6 text-white mb-3"><?= $row->title; ?></a> 
                            <p class="text-white mb-4">
                                <?= $row->deskripsi;?>
                            </p>
                            
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<!-- Agenda End -->
<?php endif;?>


<?php if($berita) : ?>
<!-- Berita Start -->
<section id="berita">
    <div class="container-fluid blog py-5 mb-5" id="reload_berita">
        <div class="container py-5">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Berita Terbaru</h5>
                <h1 class="mb-0">Berita Terbaru dan Terupdate Seputar DESAKU</h1>
            </div>
            <div class="row g-4 d-flex justify-content-center align-items-center">
                <?php foreach($berita AS $row) : ?>
                <div class="col-lg-6 col-xl-3">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= image_check($row->gambar,'berita'); ?>" class="img-fluid w-100" alt="" style="height : 200px;">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> <?= date('M, d Y',strtotime($row->create_date)) ?></span>
                                <div class="d-flex">
                                    <a href="#" class="text-white"><?= ifnull($row->komentar,0) ?> <i class="fa fa-comment"></i></a>
                                </div>
                            </div>
                            <div class="search-icon">
                                <a href="<?= image_check($row->gambar,'berita'); ?>" data-lightbox="Blog-1" class="my-auto"><i class="fas fa-search-plus btn-primary text-white p-3"></i></a>
                            </div>
                        </div>
                        <div class="text-dark border p-4 card blog-card">
                            <ul class="list-group list-group-flush border-0">
                                <li class="border-0" style="list-style: none;">
                                    <h4 class="mb-4"><?= $row->title;?></h4>
                                </li>
                                <li class="border-0" style="list-style: none;">
                                    <p class="mb-4"><?= nice_text($row->deskripsi,15); ?></p>
                                </li>
                            </ul>
                            <div class="card-footer bg-transparent ps-0 border-0">
                                <a onclick="modal_berita(<?= $row->id_berita; ?>)" class="btn-hover-bg btn btn-primary text-white py-2 px-4" data-bs-toggle="modal" href="#modalDetailBerita" role="button">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<!-- Berita End -->
<?php endif;?>

<!-- Wisata Start -->
<?php if($wisata) : ?>
<section id="wisata">
    <div class="container-fluid event py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 800px;">
                <h5 class="text-uppercase text-primary">Wisata Desaku</h5>
                <h1 class="mb-0">DESAKU memiliki banyak tempat wisata yang indah dan seru</h1>
            </div>
            <div class="event-carousel owl-carousel">
                <?php foreach($wisata AS $row) : ?>
                <div class="event-item">
                    <div style="width: 100%; height: 325px; background-image: url('<?= image_check($row->gambar,'wisata') ?>'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="text-body"><i class="fas fa-map-marker-alt me-2"></i><?= $row->alamat; ?></span>
                            <!-- <span class="text-body"><i class="fas fa-calendar-alt me-2"></i>01 Des, 2024</span> -->
                            <?php if($this->session->userdata(PREFIX_SESSION.'_id_user')) : ?>
                            <div class="hello"> 
                                
                                <div class="like">
                                    <input type="checkbox" value="<?= $row->id_wisata; ?>" onchange="set_fav(this)" <?= (in_array($row->id_wisata,$id_favorit)) ? 'checked="true"' : '' ?> style="position : absolute;width : 30px;height : 30px;opacity : 0;">
                                    <div class="home-like-<?= $row->id_wisata; ?>">
                                        <?php if(in_array($row->id_wisata,$id_favorit)) :?>
                                            <i class="bx bxs-heart fs-3" style="color: #f52e4b;"></i>
                                        <?php else : ?>
                                            <i class="bx bx-heart fs-3" style="color: #757575;"></i>
                                        <?php endif;?>
                                    </div>
                                    
                                    
                                </div> 
                            </div>
                            <?php endif;?>
                        </div>
                        <h4 class="mb-1"><?= $row->nama; ?></h4>
                        <p class="mb-4"><?= 'Tiket tersedia : '.$row->tiket; ?></p>
                        
                        <?php if($this->session->userdata(PREFIX_SESSION.'_id_user')) : ?>
                            <button type="button" onclick="modal_tiket(<?= $row->id_wisata; ?>)" data-bs-toggle="modal" data-bs-target="#modalDetailTiket" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Detail Tiket</button>
                        <?php else : ?>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAuth" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Masuk Terlibih Dahulu</button>
                        <?php endif;?>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>
<!-- Wisata End -->


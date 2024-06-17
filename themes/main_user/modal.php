<!-- Modal Daftar -->
<div class="modal fade" id="modalAuth" tabindex="-1" aria-labelledby="modalAuthLabel" aria-hidden="true">
    <div id="modal_size" class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2 " style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0" style="width: 350px;">
                <h1 class="modal-title fs-4 mb-0" id="modalAuthLabel">Masuk Sekarang</h1>
                <p class="text-center mb-0">Lengkapi data diri anda untuk bisa masuk ke dalam akun</p>
                <a role="button" class="absolute-modal-btn btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <form id="auth_path" method="POST">
                <div id="login" class="form-responsiv-sign showin">
                    <div class="modal-body section">
                        <div class="mb-3" id="req_login_email">
                            <label for="login_email" class="form-label required">Email</label>
                            <input type="email" name="email_login" class="form-control form-control-solid py-2" id="login_email" placeholder="Masukkkan email" autocomplete="off">
                        </div>
                        <div class="mb-3" id="req_login_password">
                            <label for="login_password" class="form-label required">Kata Sandi</label>
                            <input type="password" name="password_login" class="form-control form-control-solid py-2" id="login_password" placeholder="Masukkkan kata sandi" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                        <button type="button" id="button_regis" onclick="submit_form(this,'#auth_path',0,'',false,false,'','<?= base_url('auth_function/login'); ?>')" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Masuk</button>
                        <p class="mb-0">Apakah anda belum memiliki akun?</p><a role="button" onclick="auth_path('regis')" class="fw-medium">Daftar Sekarang</a>
                    </div>
                </div>
                <div id="regis" class="hidin">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-3" id="req_regis_nama">
                                <label for="regis_nama" class="form-label required">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control form-control-solid py-2" id="regis_nama" placeholder="Masukkkan nama lengkap" autocomplete="off" style="width : 100%;">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-xl-6" id="req_regis_notelp">
                                <label for="regis_notelp" class="form-label required">Nomor Telepon</label>
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text">+62</span>
                                    <input type="number" name="notelp" id="regis_notelp" class="form-control form-control-solid no-hp py-2" placeholder="Masukkan nomor telepon" autocomplete="">
                                </div>
                            </div>

                            <div class="mb-3 col-xl-6" id="req_regis_email">
                                <label for="regis_email" class="form-label required">Email</label>
                                <input type="email" name="email" class="form-control form-control-solid py-2" id="regis_email" placeholder="Masukkkan email" autocomplete="off">
                            </div>

                        </div>
                        
                        <div class="mb-3" id="req_regis_alamat">
                            <label for="regis_alamat" class="form-label">Alamat</label>
                            <textarea cols="30" name="alamat" rows="10" class="form-control form-control-solid py-2" id="regis_alamat" autocomplete="off"></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="mb-3 col-xl-6" id="req_regis_password">
                                <label for="regis_password" class="form-label required">Kata Sandi</label>
                                <input type="password" name="password" class="form-control form-control-solid py-2" id="regis_password" placeholder="Masukkkan kata sandi" autocomplete="off">
                            </div>
                            <div class="mb-3 col-xl-6" id="req_regis_repassword">
                                <label for="regis_repassword" class="form-label required">Konfirmasi Kata Sandi</label>
                                <input type="password" name="repassword" class="form-control form-control-solid py-2" id="regis_repassword" placeholder="Konfirmasi kata sandi" autocomplete="off">
                            </div>
                        </div>
                        
                        <!-- <div class="mb-3">
                            <label for="" class="form-label required">Pilih Hak Akses</label>
                            <select class="form-select form-select py-2">
                                <option selected>Pilih hak akses</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                                <option value="3">Pengelola Wisata</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                        <button type="button" id="button_regis" onclick="submit_form(this,'#auth_path',0,'',false,false,'','<?= base_url('auth_function/register'); ?>')" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Daftar Sekarang</button>
                        <p class="mb-0">Apakah anda sudah memiliki akun?</p><a onclick="auth_path('login')" role="button" class="fw-medium">Masuk Sekarang</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<!-- Modal Pesan Tiket -->
<div class="modal fade" id="modalOrder" tabindex="-1" aria-labelledby="modalOrderLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2" style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0">
                <h1 class="modal-title fs-4 mb-0" id="modalOrderLabel">Pemesanan Tiket</h1>
                <p class="text-center mb-0">Lengkapi formulir dibawah ini untuk bisa memesan tiket masuk wisata DESAKU</p>
            </div>
            <div class="modal-body section" style="width: 100%;">
                <div class="row">
                    <div class="col-xl-7 d-flex justify-content-center align-items-center flex-column">
                        <form action="">
                            <div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Nama Pengunjung</label>
                                    <input type="email" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan nama pengunjung" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Pilih kategori tiket</label>
                                    <select class="form-select form-select py-2">
                                        <option selected>Pilih kategori tiket</option>
                                        <option value="1">Anak - anak</option>
                                        <option value="2">Dewasa</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Harga Tiket</label>
                                    <input type="email" class="form-control form-control-solid py-2" id="" value="25.000" autocomplete="off" readonly>
                                </div>
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-dark fw-normal text-white py-2" style="width: 225px;">Tambah Pengunjung</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-5 d-flex justify-content-center align-items-center flex-column card-pengunjung">
                        <div class="card mb-3 me-2 border-0" style="width: 18rem; border-radius: 10px;">
                            <div class="card-header bg-transparent d-flex justify-content-end align-items-end border-0 border-0 py-0 my-0 px-2">
                                <h6 class="mb-0 font-monospace text-danger">Total Harga : Rp 75.000</h6>
                            </div>
                        </div>
                        <div style="overflow-y: scroll; max-height: 325px;">
                            <div class="card mb-3 me-2" style="width: 18rem; border-radius: 10px;">
                                <div class="card-header bg-transparent d-flex justify-content-between align-items-center border-0 my-0 mx-0">
                                    <p class="mb-0 fst-italic">Pengunjung 1</p>
                                    <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                </div>
                                <div class="card-body p-2">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nama Lengkap</div>
                                                Jhon Doe
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Kategori tiket</div>
                                                Dewasa
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Harga Tiket</div>
                                                Rp. 25.000
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="card mb-3 me-2" style="width: 18rem; border-radius: 10px;">
                                <div class="card-header bg-transparent d-flex justify-content-between align-items-center border-0 my-0 mx-0">
                                    <p class="mb-0 fst-italic">Pengunjung 2</p>
                                    <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                </div>
                                <div class="card-body p-2">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nama Lengkap</div>
                                                Jhon Doe
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Kategori tiket</div>
                                                Dewasa
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Harga Tiket</div>
                                                Rp. 25.000
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                            <div class="card mb-3 me-" style="width: 18rem; border-radius: 10px;">
                                <div class="card-header bg-transparent d-flex justify-content-between align-items-center border-0 my-0 mx-0">
                                    <p class="mb-0 fst-italic">Pengunjung 3</p>
                                    <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                </div>
                                <div class="card-body p-2">
                                    <ol class="list-group list-group-numbered">
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Nama Lengkap</div>
                                                Jhon Doe
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Kategori tiket</div>
                                                Dewasa
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-start border-0">
                                            <div class="ms-2 me-auto">
                                            <div class="fw-bold">Harga Tiket</div>
                                                Rp. 25.000
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                <button type="button" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Pesan Tiket Sekarang</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Berita -->
<div class="modal fade" id="modalDetailBerita" tabindex="-1" aria-labelledby="modalDetailBeritaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h1 class="modal-title fs-4 mb-0" id="modalDetailBeritaLabel">Detail Berita</h1>
            </div>
            <div class="modal-body px-4 py-3" style="width: 100%;" id="display_detail_berita">
                <?php if($this->input->get('id_berita')): ?>
                    <?= $this->load->view('modal/berita',$data); ?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Tiket -->
<div class="modal fade" id="modalDetailTiket" tabindex="-1" aria-labelledby="modalDetailTicketLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h1 class="modal-title fs-4 mb-0" id="modalDetailTicketLabel">Detail Tiket</h1>
            </div>
            <div id="display_detail_ticket">

            </div>
            
        </div>
    </div>
</div>

<!-- Offcanvas Favorit -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFavorit" aria-labelledby="offcanvasFavoritLabel" style="width: 500px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasFavoritLabel">Favorit Wisata Anda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row mx-2">
            <div class="col-xl-12">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/user/')?>img/produk/waterfall.jpg" class="img-fluid h-100 rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Air Terjun DESAKU</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn-sm btn btn-primary text-white mb-2 py-2 px-4">Pesan Tiket</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/user/')?>img/produk/waterfall.jpg" class="img-fluid h-100 rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Air Terjun DESAKU</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectur adip sed eiusmod amet consectur adip sed eiusmod tempor.</p>
                                <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                            </div>
                            <div class="card-footer bg-transparent border-0">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn-sm btn btn-primary text-white mb-2 py-2 px-4">Pesan Tiket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Profil -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasProfil" aria-labelledby="offcanvasProfilLabel" style="width: 400px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasProfilLabel">Profil Anda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row mx-2">
            <div class="col-xl-12">
                <div class="container mb-3">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('<?= image_check($this->session->userdata(PREFIX_SESSION.'_foto'),'user') ?>');">
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Ubah Profile</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
                <a href="#" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Ubah Kata Sandi</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
                <a href="#" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Laporan Pemesanan</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
                <a href="<?= base_url('logout') ?>" onclick="confirm_alert(this,event,'Apakah anda yakin akan meninggalkan sistem?')" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Keluar</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

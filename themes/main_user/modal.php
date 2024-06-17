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
            <div id="display_order">
                <form></form>
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

<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div id="modal_size" class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2 " style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0" style="width: 350px;">
                <h1 class="modal-title fs-4 mb-0" id="modalProfilLabel">Ubah Profil</h1>
                <a role="button" class="absolute-modal-btn btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <form id="form_profil" action="<?= base_url('user_function/profil') ?>" method="POST">
                <div class="">
                    <div class="modal-body section">
                        <div class="mb-3" id="req_profil_nama">
                            <label for="profil_nama" class="form-label required">Nama</label>
                            <input type="text" name="nama" class="form-control form-control-solid py-2" id="profil_nama" placeholder="Masukkkan nama" value="<?= $this->session->userdata(PREFIX_SESSION.'_nama') ?>" autocomplete="off">
                        </div>
                        <div class="mb-3" id="req_profil_notelp">
                            <label for="profil_notelp" class="form-label required">Nomor Telepon</label>
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text">+62</span>
                                <input type="number" name="notelp" id="profil_notelp" class="form-control form-control-solid no-hp py-2" placeholder="Masukkan nomor telepon" value="<?= $this->session->userdata(PREFIX_SESSION.'_notelp') ?>" autocomplete="off">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                        <button type="button" id="button_ubah_profil" onclick="submit_form(this,'#form_profil',2)" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Ubah Profil</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
    <div id="modal_size" class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2 " style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0" style="width: 350px;">
                <h1 class="modal-title fs-4 mb-0" id="modalPasswordLabel">Ubah Password</h1>
                <a role="button" class="absolute-modal-btn btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <form id="form_ubah_sandi" action="<?= base_url('user_function/ubah_sandi') ?>" method="POST">
                <div class="">
                    <div class="modal-body section">
                        <div class="mb-3" id="req_profil_password">
                            <label for="profil_password" class="form-label required">Kata sandi</label>
                            <input type="password" name="password" class="form-control form-control-solid py-2" id="profil_password" placeholder="Masukkkan kata sandi" value="" autocomplete="off">
                        </div>

                        <div class="mb-3" id="req_profil_repassword">
                            <label for="profil_repassword" class="form-label required">Kata sandi baru</label>
                            <input type="password" name="repassword" class="form-control form-control-solid py-2" id="profil_repassword" placeholder="Masukkkan kata sandi" value="" autocomplete="off">
                        </div>

                        <div class="mb-3" id="req_profil_new_password">
                            <label for="profil_new_password" class="form-label required">Konfirmasi kata sandi baru</label>
                            <input type="password" name="new_password" class="form-control form-control-solid py-2" id="profil_new_password" placeholder="Masukkkan kata sandi" value="" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                        <button type="button" id="button_ubah_sandi" onclick="submit_form(this,'#form_ubah_sandi',3)" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Ubah Sandi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Modal Pesan Tiket -->
<div class="modal fade" id="modalHistory" tabindex="-1" aria-labelledby="modalHistoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2" style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0">
                <h1 class="modal-title fs-4 mb-0" id="modalHistoryLabel">History Tiket</h1>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center flex-wrap">
                <?php if($history) : ?>
                    <?php foreach($history AS $row) : ?>
                    <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->wisata ?></h5>
                        <p class="card-text">Tanggal &nbsp; : <?= date('d M Y',strtotime($row->create_date)); ?></p>
                        <p class="card-text">Total bayar : <?= price_format($row->total,1); ?></p>
                        <a role="button" class="btn btn-primary"><?= status_payment($row->status); ?></a>
                    </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
                
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
                <a role="button" onclick="off_canvas('offcanvasProfil','hide')" data-bs-toggle="modal" data-bs-target="#modalProfil" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Ubah Profile</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
                <a role="button" onclick="off_canvas('offcanvasProfil','hide')" data-bs-toggle="modal" data-bs-target="#modalPassword" class="card mb-3" style="border-radius: 10px;">
                    <div class="card-body d-flex justify-content-between align-items-center text-dark">
                        <h6 class="mb-0">Ubah Kata Sandi</h6>
                        <i class="bi bi-chevron-right"></i>
                    </div>
                </a>
                <a role="button" onclick="off_canvas('offcanvasProfil','hide')" data-bs-toggle="modal" data-bs-target="#modalHistory" class="card mb-3" style="border-radius: 10px;">
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

<!-- Modal Daftar -->
<div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2" style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0" style="width: 350px;">
                <h1 class="modal-title fs-4 mb-0" id="modalDaftarLabel">Daftar Sekarang</h1>
                <p class="text-center mb-0">Lengkapi data diri anda untuk bisa mendaftarkan akun</p>
            </div>
            <form action="">
                <div class="modal-body section">
                    <div class="mb-3">
                        <label for="" class="form-label required">Nama Lengkap</label>
                        <input type="text" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan nama lengkap" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Alamat Lengkap</label>
                        <input type="text" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan alamat lengkap" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Nomor Telepon</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="">+62</span>
                            <input type="number" class="form-control form-control-solid no-hp py-2" placeholder="Masukkan nomor telepon" autocomplete="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Email</label>
                        <input type="email" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan email" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Kata Sandi</label>
                        <input type="password" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan kata sandi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control form-control-solid py-2" id="" placeholder="Konfirmasi kata sandi" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Pilih Hak Akses</label>
                        <select class="form-select form-select py-2">
                            <option selected>Pilih hak akses</option>
                            <option value="1">Admin</option>
                            <option value="2">User</option>
                            <option value="3">Pengelola Wisata</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                    <button type="button" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Daftar Sekarang</button>
                    <p class="mb-0">Apakah anda sudah memiliki akun?</p><a href="#" class="fw-medium">Login Sekarang</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Daftar -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content d-flex justify-content-center align-items-center py-2" style="border-radius: 15px;">
            <div class="modal-header d-flex flex-column border-0" style="width: 350px;">
                <h1 class="modal-title fs-4 mb-0" id="modalLoginLabel">Masuk Sekarang</h1>
                <p class="text-center mb-0">Lengkapi data diri anda untuk bisa masuk ke dalam akun</p>
            </div>
            <form action="">
                <div class="modal-body section">
                    <div class="mb-3">
                        <label for="" class="form-label required">Email</label>
                        <input type="email" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan email" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label required">Kata Sandi</label>
                        <input type="password" class="form-control form-control-solid py-2" id="" placeholder="Masukkkan kata sandi" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center align-items-center flex-column border-0">
                    <button type="button" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 350px;">Masuk Sekarang</button>
                    <p class="mb-0">Apakah anda belum memiliki akun?</p><a href="#" class="fw-medium">Daftar Sekarang</a>
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
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h1 class="modal-title fs-4 mb-0" id="modalDetailBeritaLabel">Detail Berita</h1>
            </div>
            <div class="modal-body px-4 py-3" style="width: 100%;">
                <div class="row">
                    <div class="col-xl-7">
                        <div style="overflow-y: scroll; height: 500px;">
                            <div class=" me-2">
                                <img src="<?= base_url('assets/user/') ?>img/blog-1.jpg" alt="Image" style="width: 100%; height: 250px;">
                            </div>
                            <div class="content me-2">
                                <h4 class="my-3">Informasi seputar DESAKU</h4>
                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>

                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>

                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>

                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>

                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>

                                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil adipisci cum neque harum et similique fugiat sed    temporibus reiciendis, ipsum vitae ut nisi rerum beatae. Explicabo sunt officia expedita ipsum.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-5">
                        <div>
                            <h5 class="mb-2">Kesan & Pesan untuk DESAKU</h5>
                            <form action="">
                                <div class="mb-3">
                                    <label for="" class="form-label required">Nama Lengkap</label>
                                    <input type="text" class="form-control py-2" id="" placeholder="Masukkkan nama depan" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Email</label>
                                    <input type="email" class="form-control py-2" id="" placeholder="Masukkkan Email" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Nomot Telephone</label>
                                    <input type="number" class="form-control py-2" id="" placeholder="Masukkkan nomor telephone" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label required">Komentar anda</label>
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Masukkan komentar anda" id="floatingTextarea"></textarea>
                                        <label for="floatingTextarea">Komentar</label>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 225px;">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
                <div class="event-item mb-5">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/waterfall.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4" style="background-color: #f3e0c6 !important;">
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
                        <button type="button" data-bs-toggle="modal" data-bs-target="#modalOrder" class="btn-hover-bg btn btn-primary text-white py-2 px-4">Pesan Tiket</button>
                    </div>
                </div>
                <div class="event-item mb-5">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/garden.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4" style="background-color: #f3e0c6 !important;">
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
                <div class="event-item mb-5">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/relax.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4" style="background-color: #f3e0c6 !important;">
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
                <div class="event-item mb-5">
                    <div style="width: 100%; height: 325px; background-image: url('<?= base_url('assets/user/') ?>img/produk/camping.jpg'); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                    <div class="event-content p-4" style="background-color: #f3e0c6 !important;">
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
</div>

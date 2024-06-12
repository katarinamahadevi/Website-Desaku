
<div class="row g-5 g-xl-8 pulsa_mobile">
    <div class="col-xl-12 px-0">
        <div class="card card-xl-stretch mb-xl-8 w-lg-600px profile_mobile" style="background-color: transparent; backdrop-filter: none; border: none; height: auto;">
            <div class="card-body pulsa_mobile p-9">
                <form action="<?= base_url('auth_function/register') ?>" method="POST" id="form_register" class="d-flex justify-content-center align-items-center flex-column">
                    <div class="w-100 mb-4" id="req_regis_nama">
                        <label for="regis_nama" class="required form-label">Nama</label>
                        <input type="text" name="nama" class="form-control form-control-solid" placeholder="Masukkan Nama" autocomplete="off" required/>
                    </div>
                    <div class="w-100 mb-4" id="req_regis_notelp">
                        <label for="regis_notelp" class="required form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="number" name="notelp" id="regis_notelp" class="form-control form-control solid mb-lg-0"  placeholder="Masukkan nomor telepon" autocomplete="off" required >
                        </div>
                    </div>
                    <div class="w-100 mb-4" id="req_regis_password">
                        <label for="regis_password" class="required form-label">Kata Sandi</label>
                        <input type="password" id="regis_password" name="password" class="form-control form-control-solid" placeholder="Masukkan Kata Sandi" autocomplete="off" required/>
                    </div>
                    <div class="w-100 mb-4" id="req_regis_repassword">
                        <label for="regis_repassword" class="required form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" id="regis_repassword" name="repassword" class="form-control form-control-solid" placeholder="Konfirmasi Kata Sandi" autocomplete="off"/>
                    </div>
                    <?php if($setting->kode_pendaftaran) : ?>
                    <div class="w-100 mb-4" id="req_regis_kode_pendaftaran">
                        <label for="regis_kode_pendaftaran" class="required form-label">Kode Pendaftaran</label>
                        <input type="number" id="regis_kode_pendaftaran" name="kode_pendaftaran" class="form-control form-control-solid" placeholder="Masukan Kode Pendaftaran" autocomplete="off"/>
                    </div>
                    <?php endif;?>
                </form>
            </div>	
        </div>
    </div>
</div>

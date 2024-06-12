<div class="row g-5 g-xl-8 pulsa_mobile">
    <div class="col-xl-12 px-0">
        <div class="card card-xl-stretch mb-xl-8 w-lg-600px profile_mobile" style="background-color: transparent; backdrop-filter: none; border: none; height: auto;">
            <div class="card-body pulsa_mobile p-9">
                <form action="<?= base_url('auth_function/login'); ?>" method="POST" id="form_login" class="d-flex justify-content-center align-items-center flex-column">
                    <div class="w-100 mb-4" id="req_login_notelp">
                        <label for="login_notelp" class="required form-label">Nomor Telepon</label>
                        <div class="input-group">
                            <span class="input-group-text">+62</span>
                            <input type="number" name="notelp" id="login_notelp" class="form-control form-control solid mb-lg-0"  placeholder="Masukkan nomor telepon" autocomplete="off" required >
                        </div>
                    </div>
                    <div class="w-100 mb-4" id="req_login_password">
                        <label for="login_password" class="required form-label">Kata Sandi</label>
                        <input type="password" id="password" name="password" class="form-control form-control-solid" placeholder="Masukkan Kata Sandi" autocomplete="off"/>
                    </div>
                </form>
            </div>	
        </div>
    </div>
</div>

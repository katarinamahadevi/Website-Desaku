<form method="post" id="form_ubah_profil" enctype="multipart/form-data">
    <div class="row g-5 g-xl-8 pulsa_mobile" id="parent_ubah_profil">
        <!--begin::Col-->
        <div class="col-xl-12 px-0" id="reload_ubah_profil">
            <div class="d-flex justify-content-center align-items-center mb-7">

                <!--begin::Image input-->
                <div class="image-input bgi-no-repeat bgi-position-center bgi-size-cover image-input-circle border" data-kt-image-input="true" style="background-image: url('<?= image_check('user.jpg','default')?>')">
                    <!--begin::Image preview wrapper-->
                    <div id="profil_display_foto" class="image-input-wrapper bgi-no-repeat bgi-position-center bgi-size-cover border w-125px h-125px" style="background-image: url('<?= image_check($profil->foto,'user')?>')"></div>
                    <!--end::Image preview wrapper-->

                    <!--begin::Edit button-->
                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="change"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Ubah foto profil">
                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                        <!--begin::Inputs-->
                        <input type="file" onchange="upload_foto('#form_ubah_profil',<?= $form[1] ?>)" name="foto" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="foto_remove" />
                        <!--end::Inputs-->
                    </label>
                    <!--end::Edit button-->

                    <!--begin::Cancel button-->
                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="cancel"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Batalkan foto profil">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </span>
                    <!--end::Cancel button-->

                    <!--begin::Remove button-->
                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                    data-kt-image-input-action="remove"
                    data-bs-toggle="tooltip"
                    data-bs-dismiss="click"
                    title="Hapus foto profil">
                        <i class="ki-outline ki-cross fs-3"></i>
                    </span>
                    <!--end::Remove button-->
                </div>
                <!--end::Image input-->
            </div>
            <div class="card card-xl-stretch shadow-sm mb-xl-8 w-lg-600px profile_mobile" style="border: none; height: auto;">
                <div class="card-body pulsa_mobile p-9">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle gs-0 gy-5">
                            <!--begin::Table body-->
                            <tbody>
                                <tr>
                                    <td class="text-center w-100px">
                                        <div class="d-flex justify-content-between align-items-center p-0">
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-mobile-alt fs-2tx'></i>
                                            </div>
                                            <div class="col-5 text-start">
                                                <span class="fw-semibold fs-3 d-block ms-3">No Telepon</span>
                                            </div>
                                            <div class="col-6 text-end">
                                                <span class="fs-5 d-block ms-3"><?= phone_format('0'.$profil->notelp) ?></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center w-100px">
                                        <a data-bs-toggle="offcanvas" href="#offcanvasNama" onclick="setup_value('#profil_nama','<?= $profil->nama ?>')" role="button" aria-controls="offcanvasNama" class="btn d-flex justify-content-between align-items-center p-0">
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-user-check fs-2tx'></i>
                                            </div>
                                            <div class="col-10 text-start">
                                                <span class="fw-semibold fs-3 d-block ms-3">Biodata</span>	
                                            </div>
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class="ki-duotone ki-right fs-2 pe-0"></i>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center w-100px mb-3">
                                        <a data-bs-toggle="offcanvas" onclick="sandi_page('masuk')" href="#offcanvasSandi" role="button" aria-controls="offcanvasSandi" class="btn d-flex justify-content-between align-items-center p-0">
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-lock-alt fs-2tx'></i>
                                            </div>
                                            <div class="col-10 text-start">
                                                <span class="fw-semibold fs-3 d-block ms-3">Ubah Sandi Log In</span>	
                                            </div>
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class="ki-duotone ki-right fs-2 pe-0"></i>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center w-100px mb-3">
                                        <a data-bs-toggle="offcanvas" onclick="sandi_page('pembayaran')" href="#offcanvasSandi" role="button" aria-controls="offcanvasSandiPembayaran" class="btn d-flex justify-content-between align-items-center p-0">
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class='bx bx-key fs-2tx'></i>
                                            </div>
                                            <div class="col-10 text-start">
                                                <span class="fw-semibold fs-3 d-block ms-3">Ubah Sandi Pembayaran</span>		
                                            </div>
                                            <div class="col-1 d-flex justify-content-center align-items-center">
                                                <i class="ki-duotone ki-right fs-2 pe-0"></i>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>	
            </div>
        </div>
        <!--end::Col-->
    </div>
                

    <div class="offcanvas offcanvas-bottom border-0" tabindex="-1" id="offcanvasNama" aria-labelledby="offcanvasNamaLabel" style="height: 50%; border-radius: 20px 20px 0px 0px;">
        <div class="offcanvas-header border">
            <h3 class="offcanvas-title" id="offcanvasNamaLabel">Ubah Nama</h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="mb-5" id="req_profil_nik">
                    <label for="profil_nik" class="required form-label">NIK</label>
                    <input type="text" id="profil_nik" name="nik" class="form-control form-control-solid" value="<?= $profil->nik; ?>" placeholder="Masukan NIK Anda" required autocomplete="off"/>
                </div>
                <div class="mb-5" id="req_profil_nama">
                    <label for="profil_nama" class="required form-label">Nama</label>
                    <input type="text" id="profil_nama" name="nama" class="form-control form-control-solid" value="<?= $profil->nama; ?>" placeholder="Masukan Nama Anda" required autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer d-flex justify-content-around align-items-center py-5">
            <button type="button" id="btn_profil_rubah_nama" onclick="submit_form(this,'#form_ubah_profil',<?= $form[1] ?>,'',false,false,'','<?= base_url('user_function/profil') ?>')" class="btn btn-success w-250px">Perubahan Selesai</button>
        </div>
    </div>

    <div class="offcanvas offcanvas-bottom border-0" tabindex="-1" id="offcanvasSandi" aria-labelledby="offcanvasSandiLabel" style="height: 75%; border-radius: 20px 20px 0px 0px;">
        <div class="offcanvas-header border">
            <h3 class="offcanvas-title" id="offcanvasSandiLabel">Ubah Sandi <span id="title_sandi"></span></h3>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <input type="hidden" name="type_form" value="login">
                <div class="mb-5" id="req_profil_password">
                    <label for="profil_password" class="required form-label">Kata Sandi Asli</label>
                    <input type="password" id="profil_password" name="password" class="form-control form-control-solid" placeholder="Masukkan Sandi Anda" autocomplete="off"/>
                </div>
                <div class="mb-5" id="req_profil_new_password">
                    <label for="profil_new_password" class="required form-label">Kata Sandi Baru</label>
                    <input type="password" id="profil_new_password" name="new_password" class="form-control form-control-solid" placeholder="Masukkan Sandi Baru" autocomplete="off"/>
                </div>
                <div class="mb-5" id="req_profil_repassword">
                    <label for="profil_repassword" class="required form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" id="profil_repassword" name="repassword" class="form-control form-control-solid" placeholder="Masukkan Konfirmasi Sandi" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="offcanvas-footer d-flex justify-content-around align-items-center py-5">
            <button type="button" id="button_profil_ubah_sandi" onclick="submit_form(this,'#form_ubah_profil',<?= $form[1] ?>,'',false,false,'','<?= base_url('user_function/ubah_sandi') ?>')" class="btn btn-success w-250px">Perubahan Selesai</button>
        </div>
    </div>
    
</form>

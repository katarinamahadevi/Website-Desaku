<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <form action="<?= base_url('setting_function/setup') ?>" method="POST" enctype="multipart/form-data" id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <ul class="nav nav-tabs nav-line-tabs d-flex justify-content-center align-items-center border-0 mb-5 fs-6">
                    <div class="d-flex justify-content-center align-items-center" style="border-bottom: 1px solid #D9D9D9;">
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3 active" data-bs-toggle="tab" href="#kt_tab_pane_1">Pengaturan Logo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3" data-bs-toggle="tab" href="#kt_tab_pane_2">Pengaturan Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3" data-bs-toggle="tab" href="#kt_tab_pane_3">Pengaturan Umum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-5 pb-3" data-bs-toggle="tab" href="#kt_tab_pane_4">Pengaturan Banner</a>
                        </li>
                    </div>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                        <div class="card mb-5 mb-xl-8">
                            <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column align-items-start">
                                    <!--begin::Title-->
                                    <h1 class="d-flex text-dark fw-bold m-0 fs-3">Pengaturan Logo</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">
                                            <a class="text-gray-600 text-hover-primary">Pengaturan</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">Logo & Icon</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                            </div>
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <div class="d-flex mt-5">
                                    <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(<?= image_check('default.jpg','default') ?>)">
                                            <!--begin::Image preview wrapper-->
                                            <div class="image-input-wrapper w-250px h-250px" style="background-image: url(<?= image_check($result->icon,'icon') ?>);"></div>
                                            <!--end::Image preview wrapper-->

                                            <!--begin::Edit button-->
                                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Change Icon">
                                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                                <!--begin::Inputs-->
                                                <input type="file" name="icon" accept=".png, .ico" />
                                                <input type="hidden" name="nama_icon" value="<?= $result->icon; ?>" />
                                                <input type="hidden" name="icon_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Edit button-->

                                            <!--begin::Cancel button-->
                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancel Icon">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Cancel button-->

                                            <!--begin::Remove button-->
                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remove Icon">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Remove button-->
                                        </div>
                                        <!--end::Image input-->
                                        <h5 class="mt-5 required">Icon Website</h5>
                                    </div>
                                    <div class="col-6 d-flex justify-content-center align-items-center flex-column">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline mb-5 pb-5" data-kt-image-input="true" style="background-image: url(<?= image_check('default.jpg','default') ?>)">
                                            <!--begin::Image preview wrapper-->
                                            <div class="image-input-wrapper w-400px h-200px" style="background-image: url(<?= image_check($result->logo,'logo') ?>)"></div>
                                            <!--end::Image preview wrapper-->

                                            <!--begin::Edit button-->
                                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Change Logo">
                                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                                <!--begin::Inputs-->
                                                <input type="file" name="logo" accept=".png, .ico" />
                                                <input type="hidden" name="nama_logo" value="<?= $result->logo; ?>" />
                                                <input type="hidden" name="logo_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Edit button-->

                                            <!--begin::Cancel button-->
                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Cancel Logo">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Cancel button-->

                                            <!--begin::Remove button-->
                                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove"
                                            data-bs-toggle="tooltip"
                                            data-bs-dismiss="click"
                                            title="Remove Logo">
                                                <i class="ki-outline ki-cross fs-3"></i>
                                            </span>
                                            <!--end::Remove button-->
                                        </div>
                                        <!--end::Image input-->
                                        <h5 class="mt-5 pt-2 required">Logo Website</h5>
                                    </div>
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                        <div class="card mb-5 mb-xl-8">
                            <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column align-items-start">
                                    <!--begin::Title-->
                                    <h1 class="d-flex text-dark fw-bold m-0 fs-3">Pengaturan Tentang Kami</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">
                                            <a class="text-gray-600 text-hover-primary">Pengaturan</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">Penjelasan tentang prapulsa convert</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                
                            </div>
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <div class="d-flex mt-5">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 w-100" id="req_tentang_kami">
                                        <!--begin::Input-->
                                        <textarea name="tentang_kami" id="tentang_kami" cols="30" rows="10"  class="form-control form-control-solid mb-3 mb-lg-0" style="width : 100%;" placeholder="Masukkan Tentang Pra Pulsa Convert" autocomplete="off"><?= $result->tentang_kami; ?></textarea>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                        <div class="card mb-5 mb-xl-8">
                            <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column align-items-start">
                                    <!--begin::Title-->
                                    <h1 class="d-flex text-dark fw-bold m-0 fs-3">Pengaturan Umum</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">
                                            <a class="text-gray-600 text-hover-primary">Pengaturan</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-gray-600">Pengaturan umum tentang website</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                
                            </div>
                            <!--begin::Body-->
                            <!--begin::Card body-->
                            <div class="card-body p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nomor Admin</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_phone_admin">
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="text" name="phone_admin" id="phone_admin" class="form-control  mb-3 mb-lg-0"  placeholder="Masukkan nomor admin" value="<?= $result->phone_admin; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nomor Customer Service</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_phone_cs">
                                        <div class="input-group">
                                            <span class="input-group-text">+62</span>
                                            <input type="text" name="phone_cs" id="phone_cs" class="form-control  mb-3 mb-lg-0"  placeholder="Masukkan nomor customer service" value="<?= $result->phone_cs; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Kode Pendaftaran</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_kode_pendaftaran">
                                        <div class="input-group">
                                            <input type="number" name="kode_pendaftaran" id="kode_pendaftaran" class="form-control  mb-3 mb-lg-0"  placeholder="Masukkan kode pendaftaran" value="<?= $result->kode_pendaftaran; ?>" autocomplete="off" >
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Jaminan Keamanan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_jaminan_keamanan">
                                        <div class="input-group">
                                            <textarea name="jaminan_keamanan" id="jaminan_keamanan" class="form-control  mb-3 mb-lg-0"  placeholder="Masukkan jaminan keamanan" autocomplete="off" ><?= $result->jaminan_keamanan; ?></textarea>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Gambar Landing Page</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_landing_image">
                                        <div id="embed_landing_image" class="d-flex justify-content-start align-items-center my-4 <?= ($result->landing_image) ? 'showin' : 'hidin'; ?>">
                                            <img id="display_image_setting" src="<?= image_check($result->landing_image,'setting') ?>" alt="" width="250px" style="border-radius: 15px;">
                                        </div>
                                        <input type="hidden" name="nama_landing_image" value="<?= $result->landing_image; ?>">
                                        <input type="file" onchange="display_image(this,'#display_image_setting','#embed_landing_image')" id="landing_image" accept="image/png, image/jpeg, image/svg+xml" name="landing_image" class="form-control form-control-lg form-control-solid" placeholder="Masukan gambar cs" autocomplete="off" />
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Text Landing Page</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <!--begin::solid autosize textarea-->
                                        <textarea name="landing_text" id="landing_text" class="form-control form-control-solid" data-kt-autosize="true" autocomplete="off" placeholder="Masukkan Text Landing Page" autocomplete="off"><?= $result->landing_text ?></textarea>
                                        <!--end::solid autosize textarea-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Pesan Customer</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <!--begin::solid autosize textarea-->
                                        <textarea name="text_wa" class="form-control form-control-solid" data-kt-autosize="true" autocomplete="off" placeholder="Masukkan Pesan Customer" autocomplete="off"><?= $result->text_wa ?></textarea>
                                        <!--end::solid autosize textarea-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tampilkan logo OJK</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row" id="req_logo_ojk">
                                        <div class="input-group PT-5">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input cursor-pointer focus-green" name="logo_ojk" value="Y" type="checkbox" role="switch" id="switch-logo" <?= ($result->logo_ojk == 'Y') ? 'checked' : '' ?>>
                                                <label class="cursor-pointer text-bold" for="switch-logo">Tampilkan logo OJK jika proyek INVESTASI di awasi OJK</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                        <div class="card mb-5 mb-xl-8">
                            <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                                <!--begin::Page title-->
                                <div class="page-title d-flex justify-content-between w-100">
                                    <div class="d-flex flex-column align-items-start">
                                        <!--begin::Title-->
                                        <h1 class="d-flex text-dark fw-bold m-0 fs-3">Pengaturan Banner</h1>
                                        <!--end::Title-->
                                        <!--begin::Breadcrumb-->
                                        <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-600">
                                                <a class="text-gray-600 text-hover-primary">Pengaturan</a>
                                            </li>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <li class="breadcrumb-item text-gray-600">Penambahan banner beranda</li>
                                            <!--end::Item-->
                                        </ul>
                                        <!--end::Breadcrumb-->
                                    </div>
                                    <div class="d-flex">
                                        <input type="file" name="gambar" id="gambar_banner" class="d-none" accept="image/png, image/jpeg, image/svg+xml">
                                        <button type="button" id="button_upload_banner" class="btn btn-primary" onclick="insert_banner(this,'#gambar_banner','#kt_app_content_container',0)">
                                            <i class="fa-solid fa-upload"></i>
                                            Upload Banner
                                        </button>
                                    </div>
                                    
                                </div>
                                <!--end::Page title-->
                                
                            </div>
                            <!--begin::Body-->
                            <!--begin::Card body-->
                            <div class="card-body py-3" id="base_table">
                                <!--begin::Table container-->
                                <div class="table-responsive" id="reload_table">
                                    <!--begin::Table-->
                                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                        <!--begin::Table head-->
                                        <thead>
                                            <tr class="fw-bold text-muted">
                                                <th class="min-w-150px text-center">Banner</th>
                                                <th class="min-w-100px text-center">Status</th>
                                                <th class="min-w-100px text-end">Aksi</th>
                                            </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody>

                                            <?php if ($banner) : ?>
                                                <?php foreach ($banner as $row) : ?>
                                                    <tr> 
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <div class="symbol symbol-100px me-5">
                                                                    <img src="<?= image_check($row->gambar, 'banner') ?>" alt="">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input cursor-pointer focus-green" type="checkbox" role="switch" onchange="switch_block(this,event,<?= $row->id_banner ?>)" id="switch-<?= $row->id_banner ?>" <?php if ($row->status == 'Y') {
                                                                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                                                                            } ?>>
                                                                </div>
                                                            </div>  
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-end flex-shrink-0">
                                                                <button type="button" onclick="hapus_data(event,<?= $row->id_banner; ?>,'setting_function/hapus_banner','banner')" title="Hapus data banner" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                                    <i class="ki-outline ki-trash fs-2"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3">
                                                        <center>Data banner tidak ditemukan</center>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                </div>
                                <!--end::Table container-->
                            </div>
                            <!--end::Card body-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </form>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

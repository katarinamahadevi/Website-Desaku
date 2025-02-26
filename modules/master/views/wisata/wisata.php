<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-start">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Unit Wisata</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Wisata</li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Unit</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                         <!--begin::Add wisata-->
                            <button type="button" class="btn btn-sm btn-light" onclick="tambah_wisata()" data-bs-toggle="modal" data-bs-target="#kt_modal_wisata">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Wisata</button>
                            <!--end::Add wisata-->
                    </div>
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('wisata_function/drag_wisata') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-150px text-center">Gambar</th>
                                        <th class="min-w-150px">Wisata</th>
                                        <th class="min-w-100px text-center">Tiket</th>
                                        <th class="min-w-100px text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>

                                    <?php if ($result) : ?>
                                        <?php foreach ($result as $row) : ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="symbol symbol-100px me-5">
                                                            <?php if($row->gambar) : ?>
                                                            <img src="<?= image_check($row->gambar, 'wisata') ?>" alt="">
                                                            <?php else : ?>
                                                                -
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start flex-column">
                                                        <a class="text-dark fw-bold text-hover-primary fs-6"><?= ifnull($row->nama, 'Dalam proses...') ?></a>
                                                         <p class="text-dark"><?= ifnull($row->alamat, 'Dalam proses...') ?></p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start flex-column align-items-center">
                                                        <p class="text-dark fw-bold text-hover-primary fs-6"><?= $row->tiket; ?></p>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Ubah data wisata" onclick="edit_wisata(this,<?= $row->id_wisata; ?>)" data-image="<?= image_check($row->gambar, 'wisata') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_wisata">
                                                            <i class="ki-outline ki-pencil fs-2"></i>
                                                        </button>
                                                        <button type="button" onclick="hapus_data(event,<?= $row->id_wisata; ?>,'wisata_function/hapus_wisata','wisata')" title="Hapus data wisata" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <i class="ki-outline ki-trash fs-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4">
                                                <center>Data wisata tidak ditemukan</center>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            <?= $this->pagination->create_links(); ?>
                        </form>
                        <!--end::Table container-->
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<!-- Modal Tambah wisata -->
<div class="modal fade" id="kt_modal_wisata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Wisata</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_wisata" class="form" action="<?= base_url('wisata_function/tambah_wisata') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_wisata_header" data-kt-scroll-wrappers="#kt_modal_wisata_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 d-flex justify-content-center align-items-center flex-column">
                            <!--begin::Label-->
                            <label class="required d-block fw-semibold fs-6 mb-5">Gambar Wisata</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input" data-kt-image-input="true" style="background-image: url('<?= base_url(); ?>/data/default/notfound.jpg')">
                                <!--begin::Image preview wrapper-->
                                <div id="display_gambar" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= base_url(); ?>/data/default/notfound.jpg')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow edt_gambar" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah gambar">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="gambar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_gambar" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan gambar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_gambar" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus gambar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Remove button-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Tipe: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                        <div id="lead"></div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Wisata</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama wisata" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="nama_gambar">
                        <input type="hidden" name="id_wisata">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_tiket">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kategori Tiket</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--end::Input-->
                            <!--end::Input group-->
                            <select class="form-control form-control-solid mb-3 mb-lg-0" name="tiket[]" id="select_tiket" data-control="select2" data-close-on-select="false" data-placeholder="Pilih tiket" data-allow-clear="true" multiple="multiple">
                                <?php if($tiket) : ?>
                                    <?php foreach($tiket AS $row) : ?>
                                    <option value="<?= $row->id_tiket ?>"><?= $row->nama; ?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                            <!--begin::Input group-->
                        </div>

                        <div class="fv-row mb-7" id="req_fasilitas">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Fasilitas</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--end::Input-->
                            <!--end::Input group-->
                            <select class="form-control form-control-solid mb-3 mb-lg-0" name="fasilitas[]" id="select_fasilitas" data-control="select2" data-close-on-select="false" data-placeholder="Pilih fasilitas" data-allow-clear="true" multiple="multiple">
                                <?php if($fasilitas) : ?>
                                    <?php foreach($fasilitas AS $row) : ?>
                                    <option value="<?= $row->id_fasilitas ?>"><?= $row->nama; ?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                            <!--begin::Input group-->
                        </div>
                        
                         <div class="fv-row mb-7" id="req_alamat">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="alamat" id="alamat" cols="30" rows="10"  class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan alamat" autocomplete="off"></textarea>
                            <!--end::Input-->
                        </div>
                        <div class="fv-row mb-7" id="req_deskripsi">
                            <!--begin::Label-->
                            <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"  class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan deskripsi" autocomplete="off"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_wisata" data-editor="deskripsi" onclick="submit_form(this,'#form_wisata',1)" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
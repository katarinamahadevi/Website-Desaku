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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Anggota Pengurus</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Master</a>
                                </li>
                                <!--end::Item-->
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Pengurus</li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Anggota</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="d-flex align-items-center position-relative me-3 search_mekanik w-300px">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" name="search" value="<?= $search; ?>" class="form-control form-control-solid w-250px ps-13" aria-label="Cari Pengurus" aria-describedby="button-cari-pengurus" placeholder="Cari Pengurus" autocomplete="off">
                            <button type="button" onclick="search(false)" class="btn btn-primary d-none" type="button" id="button-cari-pengurus">
                                <i class="ki-duotone ki-magnifier fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </button>
                        </div>
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-none justify-content-end" id="sistem_drag">
                                <button type="button" id="btn_hapus" onclick="submit_form(this,'#reload_table',0,'/deleted',true,true)" data-message="Apakah anda yakin akan menghapus data pengurus? data yang di hapus tidak akan bisa di kembalikan" class="btn btn-sm btn-light-danger me-3">Hapus</button>
                                <button type="button" id="btn_block" onclick="submit_form(this,'#reload_table',0,'/block',true)" class="btn btn-sm btn-light-warning me-3">Block</button>
                                <button type="button" id="btn_unblock" onclick="submit_form(this,'#reload_table',0,'/unblock',true)" class="btn btn-sm btn-light-primary me-3">Buka Blockir</button>
                            </div>
                            <div class="d-flex justify-content-end" id="sistem_filter">

                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-light me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-filter fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Penyaringan
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px filter_mekanik" data-kt-menu="true">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Pilihan Penyaringan</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Separator-->
                                    <!--begin::Content-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Jabatan</label>
                                            <select name="id_jabatan" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih jabatan">
                                                <option value="all">Semua</option>
                                                <?php if($jabatan) : ?>
                                                    <?php foreach($jabatan AS $row): ?>
                                                        <option value="<?= $row->id_jabatan; ?>" <?= ($row->id_jabatan == $this->input->get('id_jabatan')) ? 'selected': ''; ?>><?= $row->nama; ?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <label class="form-label fs-6 fw-semibold">Status</label>
                                            <select name="status" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih status">
                                                <option value="all">Semua</option>
                                                <option value="Y" <?= ($this->input->get('status') == 'Y') ? 'selected': ''; ?>>Aktif</option>
                                                <option value="N" <?= ($this->input->get('status') == 'N') ? 'selected': ''; ?>>Nonaktif</option>
                                            </select>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" onclick="filter(['id_jabatan','status'],false)" class="btn btn-primary fw-semibold px-6">Terapkan</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Filter-->
                                <!--begin::Export-->

                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Add pengurus-->
                            <button type="button" class="btn btn-sm btn-light" onclick="tambah_pengurus()" data-bs-toggle="modal" data-bs-target="#kt_modal_pengurus">
                                <i class="ki-duotone ki-plus fs-2"></i>Tambah Pengurus</button>
                            <!--end::Add pengurus-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <form action="<?= base_url('pengurus_function/drag_pengurus') ?>" method="POST" class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="w-25px">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input cursor-pointer" type="checkbox" onchange="checked_action(this)" <?php if (!$result) {
                                                                                                                                                    echo 'disabled';
                                                                                                                                                } ?>>
                                            </div>
                                        </th>
                                        <th class="min-w-200px">Pengurus</th>
                                        <th class="min-w-50px">Block</th>
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
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input widget-9-check cursor-pointer child_checkbox" name="id_batch[]" onchange="child_checked()" type="checkbox" value="<?= $row->id_pengurus ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-45px me-5">
                                                            <img src="<?= image_check($row->gambar, 'pengurus') ?>" alt="">
                                                        </div>
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a class="text-dark fw-bold text-hover-primary fs-6"><?= ifnull($row->nama, 'Dalam proses...') ?></a>
                                                            <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row->jabatan;?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input cursor-pointer focus-green" type="checkbox" role="switch" onchange="switch_block(this,event,<?= $row->id_pengurus ?>)" id="switch-<?= $row->id_pengurus ?>" <?php if ($row->status == 'Y') {
                                                                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                                                                } ?>>
                                                    </div>
                                                </td>
                                                <td>

                                                    <div class="d-flex justify-content-end flex-shrink-0">
                                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="Ubah data pengurus" onclick="edit_pengurus(this,<?= $row->id_pengurus; ?>)" data-image="<?= image_check($row->gambar, 'pengurus') ?>" data-bs-toggle="modal" data-bs-target="#kt_modal_pengurus">
                                                            <i class="ki-outline ki-pencil fs-2"></i>
                                                        </button>
                                                        <button type="button" onclick="hapus_data(event,<?= $row->id_pengurus; ?>,'pengurus_function/hapus_pengurus','pengurus')" title="Hapus data pengurus" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                                            <i class="ki-outline ki-trash fs-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6">
                                                <center>Data pengurus tidak ditemukan</center>
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

<!-- Modal Tambah pengurus -->
<div class="modal fade" id="kt_modal_pengurus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="title_modal">Tambah Pengurus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="form_pengurus" class="form" action="<?= base_url('pengurus_function/tambah_pengurus') ?>" method="POST" enctype="multipart/form-data">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="#" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_pengurus_header" data-kt-scroll-wrappers="#kt_modal_pengurus_scroll" data-kt-scroll-offset="300px">
                        
                        <div id="lead"></div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7 d-flex justify-content-center align-items-center flex-column">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5">Gambar Pengurus</label>
                            <!--end::Label-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: url('<?= image_check('user.jpg','default') ?>')">
                                <!--begin::Image preview wrapper-->
                                <div id="display_gambar" class="image-input-wrapper w-125px h-125px" style="background-image: url('<?= image_check('user.jpg','default') ?>')"></div>
                                <!--end::Image preview wrapper-->

                                <!--begin::Edit button-->
                                <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Ubah Gambar">
                                    <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                    <!--begin::Inputs-->
                                    <input type="file" name="gambar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Edit button-->

                                <!--begin::Cancel button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_gambar" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Batalkan Gambar">
                                    <i class="ki-outline ki-cross fs-3"></i>
                                </span>
                                <!--end::Cancel button-->

                                <!--begin::Remove button-->
                                <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow hps_gambar" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Hapus Gambar">
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
                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="req_nama">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Nama Lengkap</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Masukkan nama lengkap" autocomplete="off" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <input type="hidden" name="nama_gambar">
                        <input type="hidden" name="id_pengurus">
                        <!--begin::Input group-->
                        <div class="mb-10" id="req_id_jabatan">
                            <label class="form-label fs-6 fw-semibold">Jabatan</label>
                            <select name="id_jabatan" class="form-select form-select-solid filter-input" data-control="select2" data-placeholder="Pilih jabatan">
                                <option value=""></option>
                                <?php if($jabatan) : ?>
                                    <?php foreach($jabatan AS $row): ?>
                                        <option value="<?= $row->id_jabatan; ?>"><?= $row->nama; ?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="button" id="submit_pengurus" onclick="submit_form(this,'#form_pengurus',1)" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
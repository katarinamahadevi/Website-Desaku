<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <div class="col-xl-8">
                    <div class="card mb-5 mb-xl-8">
                        <div class="d-flex flex-stack flex-wrap ms-10 mt-10">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column align-items-start">
                                <!--begin::Title-->
                                <h1 class="d-flex text-dark fw-bold m-0 fs-3">
                                    Top Up Saldo Member
                                </h1>
                                
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-gray-600">
                                        <a class="text-gray-600 text-hover-primary">Dashboard</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-gray-600">Top Up Saldo untuk member</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                            <button type="button" class="btn bg-transparant" title="Video Tutorial" onclick="preview_embed(this,`https://www.youtube.com/embed/bjjC1-G6Fxo?list=RDbjjC1-G6Fxo`)">
                                <i class="fa-solid fa-circle-info text-success fs-1"></i>
                            </button>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body py-3" id="base_table">
                            <!--begin::Table container-->
                            <div class="table-responsive" id="reload_table">
                                <!--begin::Table-->
                                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted">
                                            <th class="min-w-150px">Waktu</th>
                                            <th class="min-w-150px">User</th>
                                            <th class="min-w-150px">Nominal</th>
                                            <th class="min-w-100px text-center">Bukti TopUp</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <tbody>
                                        <?php if($topup) : ?>
                                            <?php foreach($topup AS $row) : ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            <span class="text-dark fw-bold mb-1 fs-6"><?= date('H:i',strtotime($row->create_date)); ?></span>
                                                        </div> 
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            <span class="text-dark fw-bold mb-1 fs-6"><?= $row->user; ?></span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            <span class="text-dark fw-bold mb-1 fs-6"><?= price_format($row->nominal,2) ?></span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                            <div class="d-flex justify-content-center flex-shrink-0">
                                                            <button class="btn btn-icon <?= ($row->bukti_tf == '') ? 'btn-danger text-white' : 'btn-secondary' ?> btn-sm me-1" onclick="preview_image(this,'<?= image_check($row->bukti_tf,'bukti_tf'); ?>')" <?= ($row->bukti_tf == '') ? 'disabled' : '' ?>>
                                                                <i class="fa-solid fa-file fs-2"></i>
                                                            </button>
                                                            </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4"><center>Tidak ada data top up hari ini</center></td>
                                            </tr>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card mb-5 mb-xl-8 position-fixed">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Table container-->
                            <form id="form_topup" action="<?= base_url('dashboard_function/topup'); ?>" method="POST" enctype="multipart/form-data">
                                <div class="mb-8" id="req_id_user">
                                    <label for="id_user" class="required form-label">User</label>
                                    <select id="id_user" name="id_user" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih user">
                                        <option></option>
                                        <?php if($user) : ?>
                                            <?php foreach($user AS $row) : ?>
                                                <option value="<?= $row->id_user; ?>"><?= $row->nama; ?></option>
                                            <?php endforeach;?>
                                        <?php else : ?>
                                            <option value="">Tidak ada user tersedia</option>
                                        <?php endif;?>
                                        
                                    </select>
                                </div>
                                <div class="mb-8" id="req_nominal">
                                    <label for="display_nominal" class="required form-label">Nominal</label>
                                    <input id="display_nominal" onkeyup="matauang(this,'#nominal')" type="text" class="form-control form-control-solid" placeholder="Masukkan minimal investasi"/>
                                    <input type="hidden" id="nominal" name="nominal" placeholder="Isikan nominal" class="not_important form-control form-control-solid" autocomplete="off" />
                                </div>
                                <div class="mb-8">
                                    <label for="bukti_tf" class="form-label">Input bukti transfer</label>
                                    <input type="file" id="bukti_tf" name="bukti_tf" class="form-control form-control-solid" placeholder="Masukan bukti transfer"/>
                                </div>
                                <div class="mb-8">
                                    <button type="button" id="submit_topup" onclick="submit_form(this,'#form_topup',0)"  class="btn btn-sm btn-primary w-100 me-3">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                            <!--end::Table container-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
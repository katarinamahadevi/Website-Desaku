<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                
                <div class="card mb-5 mb-xl-8 py-5">
                    <div class="d-flex justify-content-center flex-wrap ms-10 mt-10 mb-8">
                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column align-items-center justify-content-center">
                            <!--begin::Title-->
                            <h1 class="d-flex text-dark fw-bold m-0 fs-2">Laporan</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Laporan</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Penarikan</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
                    <form method="GET" class="form-inline">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-3 col-xl-3" style="padding:5px;">
                                <label class="filter-title mb-2">Tahun</label>
                                <select id="tahun" name="tahun" data-control="select2" class="form-select form-select-sm form-select-solid" data-placeholder="Pilih" required>
                                    <?php for($year = 2024;$year <= date('Y'); $year++) { ?>
                                        <option value="<?= $year ?>" <?= ($year == $tahun) ? "selected" : "" ?>><?= $year ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-xl-3" style="padding:5px;">
                                <label class="filter-title mb-2">Bulan</label>
                                <select id="bulan" name="bulan" data-control="select2" class="form-select form-select-sm form-select-solid">
                                    <?php if (month_from_number()) : ?>
                                        <?php foreach (month_from_number() as $id => $val) : ?>
                                            <option value="<?= $id; ?>" <?= ($id == $bulan) ? "selected" : "" ?>><?= $val ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>

                            </div>
                            
                        </div>
                        <div class="col-md-12 col-xl-12 d-flex justify-content-center align-items-center mt-5">
                                <button type="submit" class="btn btn-primary btn-sm mx-4"><i class="bi bi-arrow-repeat"></i> Tampil</button>
                            </div>
                    </form>
                </div>

                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            
                            <div class="d-flex justify-content-end">
                                <?php
                                    $params = '';
                                    if ($this->input->get()){
                                        $no=0; 
                                        foreach ($this->input->get() as $field => $val){ 
                                            $num = $no++;
                                            if($num == 0){
                                                $params .= '?'.$field.'='.$val;
                                            }else{
                                                $params .= '&'.$field.'='.$val;
                                            }
                                        }
                                    } 
                                ?>
                                <a id="cetak_excel" target="_blank" href="<?= base_url('cetak/excel/penarikan').$params ?>" onclick="confirm_alert(this,event,'Anda akan mencetak data dengan format excel sesuai dengan data filter')" class="btn btn-sm btn-primary me-3">
                                    <i class="ki-duotone ki-exit-up fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Cetak Excel
                                </a>

                            </div>
                            <!--end::Toolbar-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3" id="base_table">
                        <!--begin::Table container-->
                        <div class="table-responsive" id="reload_table">
                            <!--begin::Table-->
                            <table class="table table-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-100px"><center>Tanggal</center></th>
                                        <th class="min-w-100px"><center>Status</center></th>
                                        <th class="min-w-100px"><center>Customer</center></th>
                                        <th class="min-w-100px"><center>Nominal Penarikan</center></th>
                                        <th class="min-w-100px"><center>Nominal Diterima</center></th>
                                        <th class="min-w-150px"><center>Tujuan Penarikan</center></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = 1; foreach($result AS $row) : ?>
                                            <tr>
                                                <td class="text-muted fw-semibold"><center><?= date('d F Y H:i',strtotime($row->tanggal)); ?></center></td>
                                                <td class="text-muted fw-semibold"><center> <span class="badge <?= wd_badge_color($row->status); ?>"><?= status_wd($row->status); ?></span></center></td>
                                                <td class="text-muted fw-semibold"><?= $row->user; ?></br></br>Kode : <?= $row->kode_penarikan ?></td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->nominal_penarikan,1); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->penarikan_diterima,1); ?></center></td>
                                                    <td>
                                                    <div class="d-flex align-items-center justify-content-center flex-column">
                                                            <div class="me-5" style="background-position: center; background-size: contain; background-repeat: no-repeat; width: 80px; height: 80px; background-image: url('<?= image_check($row->gambar_rekening, 'rekening') ?>')"></div>
                                                        <span class="text-muted">Fee : <?= ifnull(price_format($row->fee,1),' - '); ?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="6"><center>Tidak ada data penarikan bulan ini</center></td>
                                        </tr>
                                    <?php endif;?>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                            <?= $this->pagination->create_links(); ?>
                        </div>
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

<!-- Modal -->
<div class="modal fade" id="bukti_bayar_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bukti_bayar_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <img src="<?= image_check('logo.png','logo') ?>" alt="" width="100px">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center align-items-center">
           <img id="display_bukti_bayar" src="<?= image_check('notfound.jpg','default') ?>" alt="" width="600px">
        </div>
    </div>
  </div>
</div>
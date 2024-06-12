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
                                <li class="breadcrumb-item text-gray-600">Investasi</li>
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
                            <div class="col-md-3 col-xl-3" style="padding:5px;">
                                <label class="filter-title mb-2">Proyek</label>
                                <select name="id_investasi" id="id_investasi" data-control="select2" class="form-select form-select-sm form-select-solid" required>
                                    <option value="all" <?= ($id_investasi == 'all' || !$id_investasi) ? 'selected' : ''; ?>>Semua</option>
                                    <?php if ($investasi) : ?>
                                        <?php foreach ($investasi as $row) : ?>
                                            <option value="<?= $row->id_investasi; ?>" <?= ($row->id_investasi == $id_investasi) ? "selected" : "" ?>><?= $row->nama; ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="col-md-3 col-xl-3" style="padding:5px;">
                                <label class="filter-title mb-2">Member</label>
                                <select name="id_user" id="id_user" data-control="select2" class="form-select form-select-sm form-select-solid" required>
                                    <option value="all" <?= ($id_user == 'all' || !$id_user) ? 'selected' : ''; ?>>Semua</option>
                                    <?php if ($user) : ?>
                                        <?php foreach ($user as $row) : ?>
                                            <option value="<?= $row->id_user; ?>" <?= ($row->id_user == $id_user) ? "selected" : "" ?>><?= $row->nama; ?></option>
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
                                <a id="cetak_excel" target="_blank" href="<?= base_url('cetak/excel/investasi').$params ?>" onclick="confirm_alert(this,event,'Anda akan mencetak data dengan format excel sesuai dengan data filter')" class="btn btn-sm btn-primary me-3">
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
                                    <tr class="fw-bold">
                                        <th colspan="2" class="min-w-200px"><center>Tanggal</center></th>
                                        <th rowspan="2" class="min-w-100px"><center>Customer</center></th>
                                        <th rowspan="2" class="min-w-100px"><center>Proyek</center></th>
                                        <th rowspan="2" class="min-w-80px"><center>Nominal Investasi</center></th>
                                        <th rowspan="2" class="min-w-80px"><center>Provit</center></th>
                                        <th rowspan="2" class="min-w-80px"><center>Keuntungan</center></th>
                                    </tr>
                                    <tr>
                                        <th><center>Mulai</center></th>
                                        <th><center>Selesai</center></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = 1; foreach($result AS $row) : ?>
                                            <tr>
                                                <td class="text-muted fw-semibold"><center><?= date('d F Y H:i',strtotime($row->create_date)); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= date('d F Y H:i',strtotime($row->end_date)); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= $row->user; ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= $row->proyek; ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->modal_investasi,2); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= $row->profit.'%'; ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->keuntungan,2); ?></center></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7"><center>Tidak ada data investasi bulan ini</center></td>
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

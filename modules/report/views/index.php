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
                            <h1 class="d-flex text-dark fw-bold m-0 fs-3">Laporan</h1>
                            <!--end::Title-->
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-dot fw-semibold text-gray-600 fs-7">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">
                                    <a class="text-gray-600 text-hover-primary">Laporan</a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-600">Transaksi</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Page title-->
                    </div>
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
                                <a id="cetak_excel" target="_blank" href="<?= base_url('cetak/excel/transaksi').$params ?>" onclick="confirm_alert(this,event,'Anda akan mencetak data dengan format excel sesuai dengan data filter')" class="btn btn-sm btn-primary me-3">
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
                                        <th rowspan="2" class="min-w-50px text-center">No</th>
                                        <th colspan="2" class="min-w-300px"><center>Tanggal</center></th>
                                        <th rowspan="2" class="min-w-200px"><center>Pemesaan</center></th>
                                        <th rowspan="2" class="min-w-80px"><center>Wisata</center></th>
                                        <th rowspan="2" class="min-w-150px"><center>Total Bayar</center></th>
                                        <th rowspan="2" class="min-w-100px"><center>Bukti Bayar</center></th>
                                    </tr>
                                    <tr  class="fw-bold text-muted">
                                        <th class="min-w-150px text_center"><center>Transaksi</center></th>
                                        <th class="min-w-150px text_center"><center>Pembayaran</center></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = $offset; foreach($result AS $row) : $num = $no++;?>
                                            <tr>
                                                <td class="text-muted fw-semibold text-center"><?= $num; ?></td>
                                                <td class="text-muted fw-semibold"><center><?= date('d F Y H:i',strtotime($row->create_date)); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= ($row->payment_date) ? date('d F Y H:i',strtotime($row->payment_date)) : ' - '; ?></center></td>
                                                <td class="text-muted fw-semibold"><?= $row->user; ?></br></td>
                                                <td class="text-muted fw-semibold"><?= $row->wisata; ?></br></td>
                                                <td class="text-muted fw-semibold"><?= price_format($row->total,1); ?></br></td>
                                                <td>
                                                    <div class="d-flex justify-content-center flex-shrink-0">
                                                        <button type="button" <?= (!$row->bukti_bayar) ? 'disabled="true"' : ''; ?> class="btn btn-icon btn-secondary btn-sm me-1" title="Bukti bayar" onclick="preview_image(this,'<?= image_check($row->bukti_bayar,'bukti'); ?>')">
                                                            <i class="fa-solid fa-image fs-2 text-white"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8"><center>Tidak ada data transaksi bulan ini</center></td>
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
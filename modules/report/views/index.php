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
                                        <th colspan="3" class="min-w-450px"><center>Tanggal</center></th>
                                        <th rowspan="2" class="min-w-200px"><center>Customer</center></th>
                                        <th rowspan="2" class="min-w-80px"><center>Produk</center></th>
                                        <th rowspan="2" class="min-w-150px"><center>Tujuan Convert</center></th>
                                        <th rowspan="2" class="min-w-100px"><center>Jumlah Convert</center></th>
                                        <th rowspan="2" class="min-w-100px"><center>Jumlah Diterima</center></th>
                                        <th rowspan="2" class="min-w-100px text-center">Aksi</th>
                                    </tr>
                                    <tr  class="fw-bold text-muted">
                                        <th class="min-w-150px text_center"><center>Transaksi</center></th>
                                        <th class="min-w-150px text_center"><center>Pembayaran</center></th>
                                        <th class="min-w-150px text_center"><center>Approve Admin</center></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    <?php if($result) : ?>
                                        <?php $no = 1; foreach($result AS $row) : ?>
                                            <tr>
                                                <td class="text-muted fw-semibold"><center><?= date('d F Y H:i',strtotime($row->tanggal)); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= ($row->tanggal_bayar) ? date('d F Y H:i',strtotime($row->tanggal_bayar)) : ' - '; ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= ($row->admin_approval) ? date('d F Y H:i',strtotime($row->admin_approval)) : ' - '; ?></center></td>
                                                <td class="text-muted fw-semibold">
                                                    <?= $row->user; ?></br>
                                                    Kode : <?= $row->kode_transaksi; ?></br>
                                                    <span class="badge <?= payment_badge_color($row->status); ?>"><?= status_payment($row->status); ?></span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center flex-column">
                                                        <?php if($row->gambar_produk != '') : ?>
                                                            <div class="me-5" style="background-position: center; background-size: contain; background-repeat: no-repeat; width: 80px; height: 80px; background-image: url('<?= image_check($row->gambar_produk, 'produk') ?>')"></div>
                                                        <?php else : ?>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <span class="text-muted fw-semibold text-muted d-block fs-7"><?= $row->produk; ?></span>
                                                            </div>
                                                        <?php endif;?>
                                                        <span class="text-muted">Rate : <?= ifnull($row->rate,''); ?></span>
                                                    </div>
                                                </td>
                                                    <td>
                                                    <div class="d-flex align-items-center justify-content-center flex-column">
                                                        <?php if(isset($row->id_user_rekening) && $row->id_user_rekening != '') : ?>
                                                            <div class="me-5" style="background-position: center; background-size: contain; background-repeat: no-repeat; width: 80px; height: 80px; background-image: url('<?= image_check($row->gambar_rekening, 'rekening') ?>')"></div>
                                                        <?php else : ?>
                                                            <div class="d-flex justify-content-start flex-column">
                                                                <span class="text-muted fw-semibold text-muted d-block fs-7">
                                                                    <i class="fa-solid fa-money-bill-transfer"></i>
                                                                    Saldo Pra Pulsa
                                                                </span>
                                                            </div>
                                                        <?php endif;?>
                                                        <span class="text-muted">Fee : <?= ifnull(price_format($row->nominal_fee,1),' - '); ?></span>
                                                    </div>
                                                </td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->nominal_convert,1); ?></center></td>
                                                <td class="text-muted fw-semibold"><center><?= price_format($row->nominal_diterima,1); ?></center></td>
                                                <td>
                                                    <div class="d-flex justify-content-center flex-shrink-0">
                                                        <button type="button" <?= ($row->status == 1) ? 'disabled="true"' : ''; ?> class="btn btn-icon btn-secondary btn-sm me-1" title="Bukti bayar" data-bs-toggle="modal" data-bs-target="#bukti_bayar_modal" onclick="get_bukti_bayar('<?= image_check($row->bukti_bayar,'bukti_bayar'); ?>')">
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
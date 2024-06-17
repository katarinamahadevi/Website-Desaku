<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-10" id="reload_all">
                <!--begin::Toolbar-->
                <div id="kt_app_toolbar" class="app-toolbar">
                    <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                        <!--begin::Toolbar wrapper-->
                        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                            <!--begin::Page title-->
                            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                                <!--begin::Title-->
                                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Pantau Antrian</h1>
                                <!--end::Title-->
                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">
                                        <a href="<?= base_url('dashboard') ?>" class="text-muted text-hover-primary">Dashboard</a>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                    </li>
                                    <!--end::Item-->
                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-muted">Pemantauan antrian transaksi</li>
                                    <!--end::Item-->
                                </ul>
                                <!--end::Breadcrumb-->
                            </div>
                            <!--end::Page title-->
                        </div>
                        <!--end::Toolbar wrapper-->
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar-->
                <?php if(status_payment()) : ?>
                    <?php foreach(status_payment(99, [1,2,3,0]) AS $num => $title) : ?>
                    <div class="card mb-2 mb-xl-2">
                        <div class="card-header justify-content-center <?= payment_color($num) ?> border-0 mt-5">
                            <div class="d-flex align-items-center justify-content-center text-center">
                                <h5 class="mb-0"><?= ucwords($title); ?></h5>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-3" id="">
                            <!--begin::Table container-->
                            <div class="table-responsive" id="">
                                <!--begin::Table-->
                                <table class="table table-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="fw-bold text-muted">
                                            <th colspan="2" class="min-w-100px"><center>Tanggal</center></th>
                                            <th rowspan="2" class="min-w-200px"><center>Pemesan</center></th>
                                            <th rowspan="2" class="min-w-80px"><center>Wisata</center></th>
                                            <th rowspan="2" class="min-w-150px"><center>Total Bayar</center></th>
                                            <?php if(in_array($num,[0,1])) : ?>
                                            <th rowspan="2" class="min-w-100px text-center">Aksi</th>
                                            <?php endif;?>
                                        </tr>
                                        <tr  class="fw-bold text-muted">
                                            <th class="min-w-50px text_center"><center>Transaksi</center></th>
                                            <th class="min-w-50px text_center"><center>Pembayaran</center></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                        <?php if($result[$num]) : ?>
                                            <?php $no = 1; foreach($result[$num] AS $row) : ?>
                                                <tr>
                                                    <td class="text-muted fw-semibold"><center><?= date('d-m-Y H:i',strtotime($row['create_date'])); ?></center></td>
                                                    <td class="text-muted fw-semibold"><center><?= ($row['payment_date']) ? date('d-m-Y H:i',strtotime($row['payment_date'])) : ' - '; ?></center></td>
                                                    <td class="text-muted fw-semibold"><?= $row['user']; ?></td>
                                                    <td class="text-muted fw-semibold"><?= $row['wisata']; ?></td>
                                                    <td class="text-muted fw-semibold"><?= price_format($row['total'],1); ?></td>
                                                    <?php if(in_array($num,[0,1])) : ?>
                                                    <td>
                                                        <div class="d-flex justify-content-center flex-shrink-0">
                                                            <?php if(in_array($num,[1])) : ?>
                                                                <button type="button" class="btn btn-icon btn-info btn-sm me-1" title="Bukti Bayar" onclick="preview_image(this,<?= image_check($row['bukti_bayar'],'bukti'); ?>)">
                                                                    <i class="fa-solid fa-microchip fs-2"></i>
                                                                </button>
                                                            <?php endif;?>
                                                            <?php if(in_array($num,[0,1])) : ?>
                                                                <button type="button" class="btn btn-icon btn-primary btn-sm me-1" title="Proses" onclick="status_transaksi(<?= $row['id_transaksi'] ?>,<?=$num;?>,<?=($num+1)?>)">
                                                                    <i class="ki-outline ki-check fs-2"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-icon btn-danger btn-sm me-1" title="Batalkan" onclick="status_transaksi(<?= $row['id_transaksi'] ?>,<?= $num; ?>,3)">
                                                                    <i class="ki-outline ki-cross fs-2"></i>
                                                                </button>
                                                            <?php endif;?>
                                                        </div>
                                                    </td>
                                                    <?php endif;?>
                                                </tr>
                                            <?php endforeach;?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="<?= (in_array($num,[0,1])) ? 6 : 5; ?>"><center>Tidak ada data dengan status <?= status_payment($num) ?></center></td>
                                            </tr>
                                        <?php endif;?>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php else: ?>
                <?php endif;?>
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
        <div class="modal-body d-flex justify-content-center align-items-center flex-column">
            <img id="display_bukti_bayar" src="<?= image_check('notfound.jpg','default') ?>">
            <p width="100px" id="texting" class="text-center"></p>
        </div>
    </div>
  </div>
</div>
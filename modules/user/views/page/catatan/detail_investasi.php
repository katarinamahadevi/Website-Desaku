<?php if(!isset($noshell)) : ?>
<div class="row g-5 g-xl-8 pulsa_mobile" id="detail_transaksi_base_screen">
<?php endif;?>
    <!--begin::Col-->
    <?php if(isset($single_proyek->nama)) : ?>
    <div class="col-xl-12 px-0">
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body text-white py-3 px-5">
                <div class="card shadow-sm mb-3">
                    <div class="card-body d-flex flex-column py-3 px-5">
                        <div class="row mb-3 mt-5">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column text-dark">
                                <p class="fw-bold mb-1">Nama Proyek</p>
                                <p class="mb-0 text-success"><?= $single_proyek->nama; ?></p>
                            </div>
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column text-dark">
                                <p class="fw-bold mb-1">Total Modal</p>
                                <p class="mb-0 text-success"><?= price_format($single_proyek->modal,2); ?></p>
                            </div>
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column text-dark">
                                <p class="fw-bold mb-1">Total Keuntungan</p>
                                <p class="mb-0 text-success"><?= price_format($single_proyek->keuntungan,2); ?></p>
                            </div>
                        </div>
                        <div class="row mb-3 mt-5">
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column text-dark">
                                <p class="fw-bold mb-1">Minimal Investasi</p>
                                <p class="mb-0 text-success"><?= price_format($single_proyek->min_investasi,2); ?></p>
                            </div>
                            <div class="col-6 d-flex justify-content-center align-items-center flex-column text-dark">
                                <p class="fw-bold mb-1">Waktu Investasis</p>
                                <?php $j = hour_format($single_proyek->durasi,'itoH'); ?>
                                <p class="mb-0 text-success"><?=  $j['H']  ; ?> Jam</p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card shadow-sm mb-3 mt-5">
                    <div class="card-body d-flex flex-column py-3 px-5">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered text-dark mb-0">
                                <thead>
                                    <tr>
                                        <th>Urutan</th>
                                        <th>Tanggal</th>
                                        <th>Modal</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($id_inves) : ?>
                                        <?php $no = count($id_inves); foreach($id_inves AS $row) : ?>
                                            <tr class="<?= ($row->live == 'N') ? 'text-warning' : ''; ?>">
                                                <td>Ke - <?= $no--; ?></td>
                                                <td><?= date('d/m/Y',strtotime($row->create_date)); ?></br><?= date('H:i',strtotime($row->create_date)) ?></td>
                                                <td><?= price_format($row->modal_investasi,2);?></td>
                                                <td><?= price_format($row->keuntungan,2);?></td>
                                            </tr>
                                        <?php endforeach;?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4"><center>Belum ada investasi</center></td>
                                        </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <?php else : ?>
        <div id="display_vector_detail_investasi" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
            <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
            <h3 class="text-success">Halaman tidak tersedia</h3>
            <p width="100px" class="text-center text-dark">
                Belum ada halaman tersedia, silahkan buka ulang atau hubungi admin
            </p>
        </div>
    <?php endif;?>
    <!--end::Col-->
<?php if(!isset($noshell)) : ?>
</div>
<?php endif;?>

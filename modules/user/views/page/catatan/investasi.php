
<div class="row g-5 g-xl-8 pulsa_mobile" id="parent_catatan_investasi">
    <!--begin::Col-->
    <div class="col-xl-12 px-0" id="reload_catatan_investasi">
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body text-white py-3 px-5">
                <?php if($join_proyek) : ?>
                    <?php foreach($join_proyek AS $row) : ?>
                        <div class="card shadow-sm mb-3">
                            <div class="card-body d-flex flex-column ribbon py-3 px-5">
                                <?php if($row->live == 'Y') : ?>
                                <span class="ribbon-label ribbon-investasi bg-primary cursor-pointer mt-5">Investasi Berlangsung</span>
                                <?php endif;?>
                                <div class="d-flex flex-column text-dark mb-3 mt-4">
                                    <p class="fw-bold mb-1">Nama Proyek</p>
                                    <p class="mb-0 text-success"><?= $row->nama; ?></p>
                                </div>

                                <div class="d-flex flex-column text-dark mb-3">
                                    <p class="fw-bold mb-1">Total Modal</p>
                                    <p class="mb-0 text-success"><?= price_format($row->modal,2); ?></p>
                                </div>

                                <div class="d-flex flex-column text-dark mb-3">
                                    <p class="fw-bold mb-1">Total Keuntungan</p>
                                    <p class="mb-0 text-success"><?= price_format($row->keuntungan,2); ?></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a data-title_page="true" onclick="page_to(this, 'catatan/detail_investasi/<?= $row->id_investasi; ?>','','<?= base_url('user/get_display_page/catatan-detail_investasi') ?>', '#detail_transaksi_base_screen')" role="button" class="btn btn-success w-100">Periksa</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php else : ?>
                    <div id="display_vector_investasi" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                        <h3 class="text-success">Tidak ada proyek berlangsung</h3>
                        <p width="100px" class="text-center text-dark">
                            Belum ada proyek yang dimulai. Buka halaman investasi untuk melihat lihat proyek atau hubungi admin untuk mengetahui jadwal investasi
                        </p>
                    </div>
                <?php endif;?>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Col-->
</div>

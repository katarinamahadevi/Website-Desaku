
<div class="row g-5 g-xl-8 pulsa_mobile" id="parent_penarikan">
    <!--begin::Col-->
    <div class="col-xl-12 px-0" id="reload_penarikan">
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body text-white p-3">
                <?php if($penarikan) : ?>
                    <?php foreach($penarikan AS $row) : ?>
                    <div class="card shadow-sm mb-3">
                        <div class="card-body d-flex flex-column ribbon py-3 px-5">
                            
                            <span class="ribbon-label ribbon-investasi bg-<?= wd_color($row->status); ?> cursor-pointer mt-5"><?= status_wd($row->status); ?></span>
                            <div class="d-flex flex-column text-dark mb-3">
                                <img src="<?= image_check($row->gambar,'bank'); ?>" width="50px">
                                <p class="fw-bold mb-1 text-muted"><?= date('d',strtotime($row->tanggal)).' '.month_from_number(date('m',strtotime($row->tanggal))).' '.date('Y',strtotime($row->tanggal)).' '.date('H:i',strtotime($row->tanggal)); ?></p>
                                <p class="mb-0 text-success"><?=price_format($row->nominal_penarikan,2); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php else : ?>
                    <div id="display_vector_penarikan" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                        <h3 class="text-success">Tidak ada penarikan di ajukan</h3>
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

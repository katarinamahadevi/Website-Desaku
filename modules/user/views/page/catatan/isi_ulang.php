<div class="row g-5 g-xl-8 pulsa_mobile">
    <!--begin::Col-->
    <div class="col-xl-12 px-0">
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body p-3">
                <?php if($topup) : ?>
                    <?php foreach($topup AS $top) : ?>
                        
                    <div class="card shadow-sm mb-3">
                        <div class="card-body ribbon d-flex flex-column py-3 px-5">
                            <span class="ribbon-label ribbon-investasi bg-success cursor-pointer mt-5">Berhasil</span>
                            <div class="d-flex flex-column text-dark mb-3">
                                <p class="fw-bold mb-1"><?= date('d M Y H:i',strtotime($top->create_date)); ?></p>
                                <p class="mb-0 text-success fs-3"><?= price_format($top->nominal,2); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php else :?>
                    <div id="display_vector_isi_ulang" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                        <h3 class="text-success">Tidak ada riwayat isi ulang</h3>
                        <p width="100px" class="text-center text-dark">
                            Belum ada riwayat isi ulang. Hubungi admin untuk melakukan isi ulang saldo.
                        </p>
                    </div>
                <?php endif;?>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Col-->
</div>

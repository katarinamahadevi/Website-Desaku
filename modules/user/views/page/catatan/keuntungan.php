
<div class="row g-5 g-xl-8 pulsa_mobile">
    <!--begin::Col-->
    <div class="col-xl-12 px-0">
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body text-white p-3">
                <?php if($keuntungan) : ?>
                    <?php foreach($keuntungan AS $row) : ?>
                    <div class="card shadow-sm mb-3 ribbon">
                        <span class="ribbon-label ribbon-investasi bg-success cursor-pointer mt-5"><?= price_format($row['keuntungan'],2) ?></span>
                        <div class="card-body d-flex flex-column py-3 px-5">
                            <div class="d-flex flex-column text-muted fs-6 mb-3">
                                <p class="mb-0"><?= date('d M Y h:i',strtotime($row['create_date'])); ?></p>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex flex-column text-success fs-4">
                                    <p class="mb-0"><?= $row['nama']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php else :?>
                    <div id="display_vector_penghasilan" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                        <h3 class="text-success">Tidak ada keuntungan didapat</h3>
                        <p width="100px" class="text-center text-dark">
                            Belum ada keuntungan didapat. Buka halaman investasi dan mulai berinvestasi untuk mendapat keuntungan
                        </p>
                    </div>
                <?php endif;?>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <!--end::Col-->
</div>

<div class="row g-5 g-xl-8 pulsa_mobile" id="parent_home">
    <!--begin::Col-->
    <div class="col-xl-12 px-0" id="reload_home">

        <?php if($banner) : ?>
        <div class="tns w-lg-600px" style="direction: ltr;width : 320px;">
            <div data-tns="true" data-tns-nav-position="bottom" data-tns-mouse-drag="true" data-tns-controls="false">
                <?php foreach($banner AS $row) : ?>
                <div class="card card-rounded card-xl-stretch shadow-sm bgi-no-repeat bgi-position-center bgi-size-cover shadow-sm w-lg-600px" style="border: none; height: 175px; width: 100%; background-image:url('<?= image_check($row->gambar,'banner')?>')"></div>
                <?php endforeach;?>
            </div>
        </div>
        <?php endif;?>
        
        <?php if($setting->phone_cs) : ?>
            <a target="_BLANK" href="https://api.whatsapp.com/send?phone=<?= '62'.$setting->phone_cs ?><?= ($setting->text_wa) ? '&text='.$setting->text_wa : '' ?>" role="button" class="btn btn-success my-5" style="border-radius: 15px; width: 100%">
                <i class="ki-duotone ki-whatsapp text-white fs-2hx">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                Tanya Langsung
            </a>
        <?php endif;?>
        <div id="parent_proyek_home">
            <div id="reload_proyek_home">
                <?php if($proyek['rekomendasi']) : ?>
                    <?php foreach($proyek['rekomendasi'] AS $row) :?>
                        <div class="card card-xl-stretch shadow-sm mb-8 w-lg-600px profile_mobile" style="border: none; height: auto;">
                            <div class="card-body pulsa_mobile ribbon p-9">
                                <span class="ribbon-label ribbon-investasi bg-<?= cek_ds_color($row['waktu'],$row['durasi']) ?> cursor-pointer"><?= cek_date_skale($row['waktu'],$row['durasi'], true) ?></span>
                                <div class="card bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-3" style="height: 180px; width: 100%; background-image:url('<?= $row['gambar'];?>')"></div>
                                <!--begin::Table container-->
                                <div>
                                    <!--begin::Title-->
                                    <div class="text-start mb-4">
                                        <span class="fw-semibold text-gray-800 fs-3 mb-2 d-block"><?= $row['nama']; ?></span>
                                        <p class="fw-normal text-gray-800 fs-7 d-block">Minimal Investasi : <span class="text-success fs-6"><?= price_format($row['min_investasi'],2); ?></span></p>   
                                    </div>
                                    <!--end::Title-->
                                    <div class="d-flex text-center text-dark">
                                        <div class="col-4 flex-column">
                                            <p class="fw-medium mb-0"><span class="text-success fs-1"><?= $row['profit'];?></span>%</p>
                                            <p>Profit Harian</p>
                                        </div>
                                        
                                        <div class="col-4 flex-column">
                                            <p class="fw-medium mb-0"><span class="text-success fs-1"><?= date('H:i',strtotime($row['waktu'])); ?></span></p>
                                            <p>Jam Investasi</p>
                                        </div>

                                        <div class="col-4 flex-column">
                                            <?php $j = hour_format($row['durasi'],'itoH'); ?>
                                            <p class="fw-medium mb-0"><span class="text-success fs-1"><?= $j['H'] ?></span> Jam</p>
                                            <p>Durasi Proyek</p>
                                        </div>
                                    </div>

                                    <div class="text-start mt-3">
                                        <span class="fw-normal text-gray-800 fs-5 d-block">Skala Proyek : <span class="text-success"><?= price_format($row['skala_proyek'],2); ?></span></span>
                                    </div>
                                    <?php if(cek_date_skale($row['waktu'],$row['durasi']) != 'soon') : ?>
                                    <div class="text-start mt-3">
                                        <span class="fw-normal text-gray-800 fs-5 d-block">Kuota Proyek : <span class="text-success"><?= number_format($row['persentase'],2); ?>%</span>
                                            <div class="progress mt-2" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 20px;">
                                                <div class="progress-bar bg-success" style="width: <?= $row['persentase']; ?>%; border-radius: 25px;"></div>
                                            </div>
                                        </span>
                                    </div>
                                    <?php endif;?>
                                </div>
                                <!--end::Table container-->
                            
                            </div>	
                            <?php if(cek_date_skale($row['waktu'],$row['durasi']) != 'soon') : ?>
                            <div class="card-footer">
                                <a data-title_page="true" onclick="page_to(this, 'transaksi/<?= $row['id_investasi'] ?>','','<?= base_url('user/get_display_page/transaksi') ?>', '#transaksi_base_screen')" role="button" class="btn btn-success w-100">Investasi</a>
                            </div>
                            <?php endif;?>
                        </div>
                    <?php endforeach;?>
                <?php else : ?>
                    <div id="display_vector" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                        <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                        <h3 class="text-success">Tidak ada proyek berlangsung</h3>
                        <p width="100px" class="text-center">
                            Belum ada proyek yang dimulai. Buka halaman investasi untuk melihat lihat proyek atau hubungi admin untuk mengetahui jadwal investasi
                        </p>
                    </div>
                <?php endif;?>
            </div>
        </div>
        
    </div>
    <!--end::Col-->
</div>

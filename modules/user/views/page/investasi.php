<div class="row g-5 g-xl-8 pulsa_mobile" id="parent_proyek_investasi">
    <!--begin::Col-->
    <div class="col-xl-12 px-0" id="reload_proyek_investasi">
        <?php if($proyek['all']) : ?>
            <?php foreach($proyek['all'] AS $row) :?>
                <div class="card card-xl-stretch shadow-sm mb-8 w-lg-600px profile_mobile" style="border: none; height: auto;">
                    <div class="card-body pulsa_mobile ribbon p-9">
                        <span class="ribbon-label ribbon-investasi bg-<?= cek_ds_color($row->waktu,$row->durasi) ?> cursor-pointer"><?= cek_date_skale($row->waktu,$row->durasi, true) ?></span>
                        <div class="card bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-3" style="height: 180px; width: 100%; background-image:url('<?= image_check($row->gambar,'proyek');?>')"></div>
                        <!--begin::Table container-->
                        <div>
                            <!--begin::Title-->
                            <div class="text-start mb-4">
                                <span class="fw-semibold text-gray-800 fs-3 mb-2 d-block"><?= $row->nama; ?></span>
                                <p class="fw-normal text-gray-800 fs-7 d-block">Minimal Investasi : <span class="text-success fs-6"><?= price_format($row->min_investasi,2); ?></span></p>   
                            </div>
                            <!--end::Title-->
                            <div class="d-flex text-center text-dark">
                                <div class="col-4 flex-column">
                                    <p class="fw-medium mb-0"><span class="text-success fs-1"><?= $row->profit;?></span>%</p>
                                    <p>Profit Harian</p>
                                </div>
                                
                                <div class="col-4 flex-column">
                                    <p class="fw-medium mb-0"><span class="text-success fs-1"><?= date('H:i',strtotime($row->waktu)); ?></span></p>
                                    <p>Jam Investasi</p>
                                </div>

                                <div class="col-4 flex-column">
                                    <?php $j = hour_format($row->durasi,'itoH'); ?>
                                    <p class="fw-medium mb-0"><span class="text-success fs-1"><?= $j['H'] ?></span> Jam</p>
                                    <p>Durasi Proyek</p>
                                </div>
                            </div>

                            <div class="text-start mt-3">
                                <span class="fw-normal text-gray-800 fs-5 d-block">Skala Proyek : <span class="text-success"><?= price_format($row->skala_proyek,2); ?></span></span>
                            </div>
                            <?php if(!in_array(cek_date_skale($row->waktu,$row->durasi),['soon','past'])) : ?>
                                 <?php 
                                    if ($row->jumlah_dana >= $row->skala_proyek) {
                                        $kuota = 100;
                                    }else{
                                        $kuota = ($row->jumlah_dana / $row->skala_proyek) * 100;
                                    }    
                                ?>
                            <div class="text-start mt-3">
                                <span class="fw-normal text-gray-800 fs-5 d-block">Kuota Proyek : <?= number_format($kuota,2); ?>%
                                    <div class="progress mt-2" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 20px;">
                                        <div class="progress-bar bg-success" style="width: <?= ifnull($kuota,'0'); ?>%; border-radius: 25px;"></div>
                                    </div>
                                </span>
                            </div>
                            <?php endif;?>
                        </div>
                        <!--end::Table container-->
                       
                    </div>	
                    <?php if(cek_date_skale($row->waktu,$row->durasi) == 'now') : ?>
                    <div class="card-footer">
                         <a data-title_page="true" onclick="page_to(this, 'transaksi/<?= $row->id_investasi ?>','','<?= base_url('user/get_display_page/transaksi') ?>', '#transaksi_base_screen')" role="button" role="button" class="btn btn-success w-100">Investasi</a>
                    </div>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        <?php else : ?>
            <div id="display_vector_home" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
                <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
                <h3 class="text-success">Tidak ada proyek berlangsung</h3>
                <p width="100px" class="text-center text-dark">
                    Belum ada proyek yang dimulai. Buka halaman investasi untuk melihat lihat proyek atau hubungi admin untuk mengetahui jadwal investasi
                </p>
            </div>
        <?php endif;?>
    </div>
    <!--end::Col-->
</div>

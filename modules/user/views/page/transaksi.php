<?php if(!isset($noshell)) : ?>
<div class="row g-5 g-xl-8 pulsa_mobile" id="transaksi_base_screen">
<?php endif;?>
<form id="form_transaksi_investasi" method="POST" class="col-xl-12 px-0">
<?php if(isset($single_proyek->id_investasi)) : ?>
    <!--begin::Col-->
    
        <input type="hidden" name="id_investasi" value="<?= (isset($single_proyek->id_investasi)) ? $single_proyek->id_investasi : 0; ?>">
        <div class="card bgi-no-repeat bgi-position-center bgi-size-cover card-rounded mb-3" style="height: 180px; width: 100%; background-image:url('<?= image_check((isset($single_proyek->gambar)) ? $single_proyek->gambar : '','proyek');?>')"></div>
        <!--begin::Tables Widget 1-->
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td class="text-center pt-5 pb-0">
                                    <div class="flex-column">
                                        <p class="fw-medium mb-0"><span class="text-success fs-1"><?= (isset($single_proyek->profit)) ? $single_proyek->profit : '';?></span>%</p>
                                        <p>Profit Harian</p>
                                    </div>
                                </td>
                                <td class="text-center w-25px pt-5 pb-0">
                                    <div class="lines"></div>
                                </td>
                                <td class="text-center pt-5 pb-0">
                                    <div class="flex-column">
                                        <?php $j = hour_format((isset($single_proyek->durasi)) ? $single_proyek->durasi : 0,'itoH'); ?>
                                        <p class="fw-medium mb-0"><span class="text-success fs-1"><?= $j['H'] ?></span> Jam</p>
                                        <p>Durasi Proyek</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->

                    <table class="table align-middle gs-0 gy-5">
                        <tbody>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Nama Proyek</span>	
                                        <span class="text-success fw-normal"><?= (isset($single_proyek->nama)) ? $single_proyek->nama : '';?></span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Harga Proyek</span>	
                                        <span class="text-success fw-normal"><?= (isset($single_proyek->skala_proyek)) ? price_format($single_proyek->skala_proyek,2) : '0 IDR';?></span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Minimal Investasi</span>	
                                        <span class="text-secondary fw-normal text-success"><?= (isset($single_proyek->min_investasi)) ? price_format($single_proyek->min_investasi,2) : '0 IDR';?></span>	
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Body-->
        </div>

        <div class="card card-xl-stretch shadow-sm mb-xl-8 w-lg-600px profile_mobile" style="border: none; height: auto;">
            <div class="card-body pulsa_mobile p-9">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Penghasilan</span>	
                                        <span class="text-secondary fw-normal text-muted">Pemasukan <span class="text-success"><?= (isset($single_proyek->profit)) ? $single_proyek->profit : '0';?>%</span> dari jumlah investasi otomatis saldo akun (modal serta profit)</span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Harga Investasi</span>	
                                        <span class="text-secondary fw-normal text-muted">Minimal Investasi <span class="text-success"><?= (isset($single_proyek->min_investasi)) ? price_format($single_proyek->min_investasi,2) : '0 IDR';?></span></span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Durasi Proyek</span>	
                                        <span class="text-secondary fw-normal text-muted"><span class="text-success"><?= $j['H'] ?></span> Jam <span class="text-success"><?= ($j['i']) ? $j['i'] : '' ?></span> Menit</span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Hasil Pemasukan</span>	
                                        <span class="text-secondary fw-normal text-muted"><span class="text-success"><?= $j['H'] ?> Jam</span> Keuntungan Profit Proyek <span class="text-success"><?= (isset($single_proyek->profit)) ? $single_proyek->profit : '0';?>%</span></span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Metode Pembayaran</span>	
                                        <span class="text-secondary fw-normal text-muted">Tiba masa pengembalian pokok serta profit proyek</span>	
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Keamanan Terjamin</span>	
                                        <span class="text-secondary fw-normal text-muted"><?= ifnull($setting->jaminan_keamanan,'-'); ?></span>	
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td class="text-start py-2">
                                    <div class="flex-column">
                                        <span class="text-dark fw-bold d-block">Deskripsi</span>	
                                        <?= (isset($single_proyek->deskripsi)) ? $single_proyek->deskripsi : '';?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>	
        </div>

        <div class="offcanvas offcanvas-bottom border-0" tabindex="-1" id="canvasTransaksiSandi" aria-labelledby="canvasTransaksiSandiLabel" style="min-height: 35%; height : auto; border-radius: 20px 20px 0px 0px;">
            <div class="offcanvas-header border d-flex justify-content-center align-items-center">
                <h3 class="offcanvas-title" id="canvasTransaksiSandiLabel">Konfirmasi Sandi Transaksi</h3>
            </div>
            <?php if(isset($single_proyek->min_investasi)) : ?>
            <div class="offcanvas-body" id="form_transaksi_sandi">
                <?php if($profil->saldo < $single_proyek->min_investasi) : ?>
                <div class="alert alert-warning d-flex flex-column">
                    <p>Saldo tidak mencukupi untuk melakukan transaksi</p>
                    <span><b>Saldo : </b><?= price_format($profil->saldo,2) ?></span>
                </div>
                <?php endif;?>
                <div id="req_transaksi_password_payment">
                    <input type="password" id="transaksi_password_payment" name="password_payment" class="form-control form-control-solid" value="" placeholder="Masukan Kata Sandi Transaksi" required autocomplete="off" <?= ($profil->saldo < $single_proyek->min_investasi) ? 'disabled' : '';?>/>
                </div>
            </div>

            <div class="offcanvas-footer d-flex justify-content-around align-items-center py-5">
                <button type="button" data-bs-dismiss="offcanvas" class="btn btn-secondary" style="width : 40%;">Batal</button>
                <button type="button" id="btn_cek_password" onclick="submit_form(this,'#form_transaksi_investasi',<?= $form ?>,'',false,false,'Tunggu...','<?= base_url('user_function/auth_transaksi') ?>')" class="btn btn-success" style="width : 40%;" <?= ($profil->saldo < $single_proyek->min_investasi) ? 'disabled' : '';?>>Lanjutkan</button>
            </div>
            <?php endif;?>
            
        </div>

        <div class="offcanvas offcanvas-bottom border-0" tabindex="-1" id="canvasTransaksi" aria-labelledby="canvasTransaksiLabel" style="min-height: 35%;height : auto; border-radius: 20px 20px 0px 0px;">
            <div class="offcanvas-header border d-flex justify-content-center align-items-center">
                <h3 class="offcanvas-title text-center" id="canvasTransaksiLabel">Investasi</h3>
            </div>
            <div class="offcanvas-body">
                <div>
                    <div class="d-flex justify-content-center align-items-center flex-column mb-3" id="req_investasi_modal_investasi">
                        <h4 class="text-muted fw-normal">Masukan jumlah investasi</h4>
                        <input type="text" name="display_modal_investasi" onkeyup="nominal_investasi(this,'#modal_investasi',<?= (isset($single_proyek->profit)) ? $single_proyek->profit : 0  ?>,<?= (isset($single_proyek->min_investasi)) ? $single_proyek->min_investasi : 0  ?>,<?= $profil->saldo; ?>)" class="form-control form-control-flush text-center pt-0"  placeholder="<?= (isset($single_proyek->min_investasi)) ? price_format($single_proyek->min_investasi) : '0'; ?>" style="font-size: 25px;" autocomplete="off"/>
                        <input type="hidden" id="modal_investasi" name="modal_investasi" value="<?= (isset($single_proyek->min_investasi)) ? $single_proyek->min_investasi : 0; ?>" autocomplete="off" />
                        <div style="border-top : 3px solid #a1a5b7;width : 90%;"></div>
                    </div>

                    <div class="d-flex flex-column justify-content-center align-items-center w-100 mt-5 pt-5">
                        <div class="col-12 d-flex justify-content-center mb-1">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <span class="text-muted fw-bold fs-4">Saldo saat ini</span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <span class="text-success fw-normal fs-4"><?= price_format($profil->saldo,2) ?></span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-1">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <span class="text-muted fw-bold fs-4">Nominal investasi</span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <span class="text-success fw-normal fs-4"><span id="jumlah_investasi"><?= price_format((isset($single_proyek->min_investasi)) ? $single_proyek->min_investasi : 0); ?></span> IDR</span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-1">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <span class="text-muted fw-bold fs-4">Profit keuntungan</span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <span class="text-success fw-normal fs-4"><?= (isset($single_proyek->profit)) ? $single_proyek->profit.'%' : '0%'  ?></span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-1">
                            <div class="col-6 d-flex align-items-center justify-content-start">
                                <span class="text-muted fw-bold fs-4">Jumlah Keuntungan</span>
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-end">
                                <span class="text-success fw-normal fs-4"><span id="jumlah_keuntungan"><?= price_format((isset($single_proyek->min_investasi)) ? (($single_proyek->min_investasi * $single_proyek->profit) / 100) : 0)?></span> IDR</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer d-flex justify-content-around align-items-center py-5">
                <button type="button" data-bs-dismiss="offcanvas" class="btn btn-secondary" style="width : 40%;">Batal</button>
                <button type="button" id="btn_proses_transaksi" onclick="submit_form(this,'#form_transaksi_investasi',<?= $form ?>,'',false,false,'Tunggu...','<?= base_url('user_function/proses_investasi') ?>')" class="btn btn-success" style="width : 40%;">Investasi</button>
            </div>
        </div>
    <!--end::Col-->
<?php else : ?>
    <div id="display_vector_detail_investasi" class="card card-xl-stretch shadow-sm d-flex justify-content-center align-items-center flex-column">
            <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
            <h3 class="text-success">Halaman tidak tersedia</h3>
            <p width="100px" class="text-center text-dark">
                Belum ada halaman tersedia, silahkan buka ulang atau hubungi admin
            </p>
        </div>
<?php endif;?>
</form>
<?php if(!isset($noshell)) : ?>
</div>
<?php endif;?>
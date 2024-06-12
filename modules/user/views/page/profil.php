<div class="row g-5 g-xl-8 pulsa_mobile" id="parent_profile">
    <!--begin::Col-->
    <div class="col-xl-12 px-0" id="reload_profile">
        <!--begin::Tables Widget 1-->
        <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
            <!--begin::Header-->
            <div class="card-header d-flex justify-content-center align-items-center border-0 pt-5">
                <h3 class="card-title align-items-center flex-column">
                    <span class="card-label fw-normal fs-2hx mb-2 text-success"><?= price_format($profil->saldo,2); ?></span>
                    <span class="text-dark fw-bold fs-5">Saldo Akun (IDR)</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td class="text-center py-0">
                                    <div class="d-flex align-items-center flex-column">
                                        <span class="text-success fw-semibold d-block"><?= price_format($live_invest['untung']);?></span>	
                                        <span class="text-dark fw-semibold d-block">Keuntungan (IDR)</span>	
                                    </div>
                                </td>
                                <td class="text-center w-25px py-0">
                                    <div class="lines"></div>
                                </td>
                                <td class="text-center py-0">
                                    <div class="d-flex align-items-center flex-column">
                                        <span class="text-success fw-semibold d-block"><?= price_format($live_invest['modal']);?></span>	
                                        <span class="text-dark fw-semibold d-block">Modal Invest (IDR)</span>	
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                    <div class="col-12 w-100 d-flex justify-content-around align-items-center">
                        <div class="col-6 d-flex justify-content-center">
                            <a data-bs-toggle="offcanvas" href="#offcanvasTarik" role="button" aria-controls="offcanvasTarik" class="btn btn-success">Penarikan</a>
                        </div>
                        <?php if($setting->phone_cs) : ?>
                        <div class="col-6 d-flex justify-content-center">
                            <a target="_BLANK" href="https://api.whatsapp.com/send?phone=<?= '62'.$setting->phone_cs ?>&text=Saya ingin melakukan TOP UP" class="btn btn-success">Isi Ulang</a>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Body-->
        </div>

        <div class="card card-xl-stretch shadow-sm mb-xl-8 w-lg-600px bgi-no-repeat bgi-position-center bgi-size-cover profile_mobile" style="border: none; height: auto;">
            <div class="card-body pulsa_mobile p-9">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-5">
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td class="text-center w-100px">
                                    <a onclick="page_to(this,'profil/ubah')" data-title_page="true" role="button" class="btn d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-user fs-2tx text-dark'></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Ubah Profil</span>
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center w-100px mb-3">
                                    <a onclick="page_to(this,'catatan/investasi')" data-title_page="true" role="button" class="btn d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-notepad fs-2tx text-dark'></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Catatan Investasi</span>	
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center w-100px mb-3">
                                    <a onclick="page_to(this,'catatan/keuntungan')" data-title_page="true" role="button" class="d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-notepad fs-2tx text-dark'></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Catatan Keuntungan</span>		
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center w-100px mb-3">
                                    <a onclick="page_to(this,'catatan/isi_ulang')" data-title_page="true" role="button" class="d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-notepad fs-2tx text-dark'></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Catatan Isi Ulang</span>		
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center w-100px mb-3">
                                    <a onclick="page_to(this,'catatan/penarikan')" data-title_page="true" role="button" class="d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-money-withdraw fs-2tx text-dark' ></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Catatan Penarikan</span>		
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            <!-- <tr>
                                <td class="text-center w-100px mb-3">
                                    <a onclick="page_to(this,'rekening')" data-title_page="true" role="button" class="d-flex justify-content-between align-items-center p-0">
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class='bx bxs-bank fs-2tx text-dark'></i>
                                        </div>
                                        <div class="col-10 text-start">
                                            <span class="text-dark fw-semibold fs-3 d-block ms-3">Rekening Pribadi</span>		
                                        </div>
                                        <div class="col-1 d-flex justify-content-center align-items-center">
                                            <i class="ki-duotone ki-right text-dark fs-2 pe-0"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr> -->
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
                <a onclick="confirm_alert(this,event,'Apakah anda yakin akan meninggalkan sistem?')" href="<?= base_url('logout'); ?>" role="button" class="btn btn-success" style="border-radius: 15px; width: 100%">
                    Keluar
                </a>
            </div>	
        </div>

        <div class="offcanvas offcanvas-bottom border-0" tabindex="-1" id="offcanvasTarik" aria-labelledby="offcanvasTarikLabel" style="height: 80%; border-radius: 20px 20px 0px 0px;">
            <div class="offcanvas-header border">
                <h3 class="offcanvas-title" id="offcanvasTarikLabel">Penarikan Saldo</h3>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <form method="POST" id="form_withdraw" class="offcanvas-body">
                <div id="reload_wd">
                    <div class="d-flex justify-content-center align-items-center mb-5">
                        <img src="<?= image_check($setting->logo,'logo'); ?>" width="175" alt="">
                    </div>

                    <div class="d-flex justify-content-center align-items-center flex-column mb-3">
                        <h4 class="text-muted fw-normal">Masukan jumlah penarikan</h4>
                        <input type="text" name="display_nominal_penarikan" onkeyup="matauang(this,'#nominal_penarikan')" class="form-control form-control-flush text-center pt-0" placeholder="Rp0" style="font-size: 25px;" autocomplete="off"/>
                        <input type="hidden" id="nominal_penarikan" name="nominal_penarikan" autocomplete="off" />
                        <div style="border-top : 3px solid #a1a5b7;width : 70%;"></div>
                    </div>
                    <input type="hidden" class="withdraw" name="id_rekening" >
                    <input type="hidden" class="withdraw" name="fee" >
                    <div class="flex-start" id="wd_tujuan">
                        <h4 class="mb-3">Metode Penarikan</h4>
                        
                        <?php if($rekening) : ?>
                            <?php foreach($rekening AS $row) : ?>
                            <a onclick="set_tujuan_wd(this,<?= $row->id_rekening ?>,<?= $row->fee ?>)" role="button" class="card hover-elevate-up shadow-sm parent-hover mb-5">
                                <div class="card-body d-flex align-items-center">
                                    <span class="svg-icon fs-1">
                                        <img src="<?= image_check($row->gambar,'bank') ?>" width="60px">
                                    </span>

                                    <span class="ms-6 text-gray-700 fs-6 fw-bold">
                                        <h6>
                                            Nama &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <?= $row->nama; ?>
                                        </h6>
                                        <h6>
                                            Nomor&nbsp;&nbsp;&nbsp;:&nbsp; <?= $row->nomor; ?>
                                        </h6>
                                        <h6>
                                            Fee&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <?= $row->fee; ?>
                                        </h6>
                                    </span>
                                </div>
                            </a>
                            <?php endforeach;?>
                        <?php endif;?>
                        
                        <div style="overflow-y: scroll; overflow-x: hidden; height: 400px;">
                            <!--begin::Repeater-->
                            <div id="form_tambah_rekening_wd" class="hidin">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class="form-group row">
                                        <div class="col-6 mb-2" id="req_rekening_profil_id_bank">
                                            <label class="form-label text-dark">Bank</label>
                                            <select class="form-select operator_select2_custom" name="id_bank" data-placeholder="Pilih bank">
                                                <option></option>
                                                <option></option>
                                                <?php if($bank) : ?>
                                                    <?php foreach($bank AS $row) :?>
                                                        <option value="<?= $row->id_bank; ?>" data-kt-rich-content-subcontent="Fee <?= price_format($row->fee,1) ?>" data-kt-rich-content-icon="<?= image_check($row->gambar,'bank') ?>"><?= $row->nama; ?></option>
                                                    <?php endforeach;?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <div class="col-6 mb-2" id="req_rekening_profil_nama">
                                            <label class="form-label text-dark">Nama Pemilik</label>
                                            <input type="text" name="nama" class="form-control mb-2 mb-md-0" placeholder="Masukkan nama" autocomplete="off" />
                                        </div>
                                        <div class="col-md-12 mb-2" id="req_rekening_profil_nomor">
                                            <label class="form-label text-dark">Nomor Bank</label>
                                            <input type="number" name="nomor" class="form-control mb-2 mb-md-0" placeholder="Masukkan nomor bank" autocomplete="off" />
                                        </div>
                                        
                                    </div>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--begin::Form group-->
                            <div class="form-group mt-5">
                                <button type="button" id="btn_tambah_form_bank_wd" onclick="tambah_form_rekening(this,'wd')" class="showin btn btn-light-primary w-100">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Tambah Tujuan Pembayaran
                                </button>

                                <button type="button" onclick="submit_form(this,'#form_withdraw',<?= $form[0]; ?>,'',false,false,'','<?= base_url('user_function/tambah_user_rekening/profil') ?>')" id="btn_simpan_form_rekening_wd" class="hidin btn btn-light-primary w-100 mb-3">
                                    <i class="ki-duotone ki-plus fs-3"></i>
                                    Simpan Tujuan Pembayaran
                                </button>

                                <button type="button" id="btn_hapus_form_rekening_wd" onclick="hapus_form_rekening(this,'wd')" class="hidin btn btn-light-danger w-100">
                                    <i class="ki-solid ki-trash fs-3"></i>
                                    Hapus Tujuan Pembayaran
                                </button>
                            </div>
                            <!--end::Form group-->
                        </div>

                    </div>
                </div>
                
            </form>

            <div class="offcanvas-footer d-flex justify-content-around align-items-center py-5">
                <button type="button" id="btn_withdraw" onclick="submit_form(this,'#form_withdraw',<?= $form[0]; ?>,'',false,false,'','<?= base_url('user_function/withdraw') ?>')" class="btn btn-dark w-100">Tarik Saldo</button>
            </div>
        </div>
    </div>
</div>


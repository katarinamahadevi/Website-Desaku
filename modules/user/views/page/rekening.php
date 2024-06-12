<div class="row g-5 g-xl-8 pulsa_mobile">
    <!--begin::Col-->
    <div class="col-xl-12 px-0">
        <?php if($rekening) : ?>
            <?php foreach($rekening AS $row) : ?>
            <div class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1" style="border: none;">
                <!--begin::Body-->
                <div class="card-body ribbon p-5">
                    <a href="#" class="ribbon-label bg-danger cursor-pointer">Hapus</a>
                    <div class="d-flex flex-column text-dark mb-3">
                        <p class="fw-bold mb-1">Nama Bank</p>
                        <p class="mb-0">Bank BNI</p>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex flex-column text-dark">
                                <p class="fw-bold mb-1">Atas Nama</p>
                                <p class="mb-0"><?= $row->nama; ?></p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex flex-column text-dark">
                                <p class="fw-bold mb-1">Nomor Kartu</p>
                                <p class="mb-0"><?= $row->nomor; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Body-->
            </div>
            <?php endforeach;?>
        <?php endif;?>

        <div style="height : auto;" class="card card-xl-stretch shadow-sm mb-xl-8 mb-10 w-lg-600px pulsa_mobile_1">
            <div class="card-body p-5">
                <!--begin::Repeater-->
                <div id="kt_docs_repeater_basic">
                    <!--begin::Form group-->
                    <div class="form-group">
                        <div data-repeater-list="kt_docs_repeater_basic">
                            <div data-repeater-item>
                                <form class="form-group row">
                                    <div style="overflow-y: scroll; overflow-x: hidden; height: auto;">
                                        <!--begin::Repeater-->
                                        <div id="form_tambah_rekening_prf" class="hidin">
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
                                            <button type="button" id="btn_tambah_form_bank_prf" onclick="tambah_form_rekening(this,'prf')" class="showin btn btn-light-primary w-100">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Tambah Tujuan Pembayaran
                                            </button>

                                            <button type="button" onclick="submit_form(this,'#form_withdraw',<?= $form[0]; ?>,'',false,false,'','<?= base_url('user_function/tambah_user_rekening/profil') ?>')" id="btn_simpan_form_rekening_prf" class="hidin btn btn-light-primary w-100 mb-3">
                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                Simpan Tujuan Pembayaran
                                            </button>

                                            <button type="button" id="btn_hapus_form_rekening_prf" onclick="hapus_form_rekening(this,'prf')" class="hidin btn btn-light-danger w-100">
                                                <i class="ki-solid ki-trash fs-3"></i>
                                                Hapus Tujuan Pembayaran
                                            </button>
                                        </div>
                                        <!--end::Form group-->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Repeater-->
            </div>
        </div>
    </div>
    <!--end::Col-->
</div>

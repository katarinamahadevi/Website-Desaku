<!--end::Theme mode setup on page load-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root bg-primary" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex justify-content-center  flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12 showin">
            <!--begin::Wrapper-->
            <div id="form_wrapper" class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <!--begin::Content Login-->
                <div class="d-flex justify-content-center align-items-center h-lg-100 w-md-400px showin">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-center flex-column flex-column-fluid pb-5">
                        <!--begin::Form-->
                        <form class="form w-100" id="form_upload_bukti_bayar" method="POST" action="<?= base_url('user_function/upload_bukti_bayar') ?>">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Upload Bukti Bayar</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Upload bukti bayar anda</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <table class="table table-bordered table-row-gray-300 align-middle gs-0 gy-4">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Tiket</th>
                                        <th class="text-center">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($detail) : ?>
                                        <?php foreach($detail AS $row) : ?>
                                        <tr>
                                            <td class="text-center"><?= $row->nama; ?></td>
                                            <td class="text-center"><?= $row->tiket ?></td>
                                            <td class="text-center"><?= price_format($row->harga,1) ?></td>
                                        </tr>
                                        <?php endforeach;?>
                                        <tr>
                                            <td colspan="2" class="text-end">Total Bayar : </td>
                                            <td class="text-center"><?= price_format($result->total,1); ?></td>
                                        </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="hidden" name="id_transaksi" value="<?= $result->id_transaksi; ?>">
                                <input type="file" placeholder="Masukan bukti bayar" name="bukti_bayar" autocomplete="off" class="form-control bg-transparent" style="text-transform:lowercase;" />
                                <!--end::Email-->
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" id="btn_upload" onclick="submit_form(this,'#form_upload_bukti_bayar',0)" class="btn btn-warning mt-3">Simpan Bukti Bayar</button>
                                </div>
                                
                            </div>
                            <!--end::Input group=-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Content Login-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Authentication - Sign-in-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
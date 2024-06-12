<div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
   <!--begin::Heading-->
    <input type="hidden" name="id_investasi" value="<?= $id_investasi; ?>">
    <div class="text-center mb-13">
        <!--begin::Title-->
        <h1 class="mb-3">INVESTOR PROYEK</h1>
        <!--end::Title-->
    </div>
    <!--end::Heading-->
    <!--begin::Users-->
    <?php if($result) : ?>
    <div class="table-responsive">
        <table class="table table-row-dashed table-row-gray-300 border-bottom gy-5">
            <tbody>
                <?php foreach($result AS $row) : ?>
                <tr class="mb-5">
                    <td class="text-start">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-45px symbol-circle">
                            <img src="<?= image_check($row->foto, 'user') ?>" alt="">
                        </div>
                        <!--end::Avatar-->
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                        <!--begin::Name-->
                            <a class="d-flex align-items-center fs-5 fw-bold text-dark text-hover-primary"><?= $row->nama; ?> </a>
                            <!--end::Name-->
                            <!--begin::Email-->
                            <div class="fw-semibold text-muted"><?= '+62'.$row->notelp; ?></div>
                            <!--end::Email-->
                        </div>
                    </td>
                    <td class="text-end">
                        <div class="d-flex flex-column">
                            <div class="fw-semibold text-muted">Modal : <?= price_format($row->modal_investasi,1); ?></div>
                            <div class="fw-semibold text-muted">Keuntungan : <?= price_format($row->keuntungan,1); ?></div>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php else : ?>
        <div id="display_vector" class="d-flex justify-content-center align-items-center flex-column">
            <img width="300px" src="<?= image_check('not_found.svg', 'vector') ?>" alt="">
            <p width="100px" class="text-center">
                Data investor tidak di temukan! Hubungi admin jika terjadi kesalahan
            </p>
        </div>
    <?php endif;?>
    <!--end::Users-->             
</div>
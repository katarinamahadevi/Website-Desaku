<div class="row">
    <div class="col-xl-12">
        <div>
            <div class=" me-2">
                <img src="<?= image_check($result->gambar,'berita'); ?>" alt="Image" style="width: 100%; height: 250px;">
            </div>
            <div class="content me-2">
                <h4 class="my-3"><?= $result->title; ?></h4>
                

                <p class="mb-3"><?= $result->deskripsi;?></p>
            </div>
        </div>
    </div>

    <?php if($this->session->userdata(PREFIX_SESSION.'_id_user')) : ?>
    <div class="col-xl-12">
        <div>
            <h5 class="my-2">Kesan & Pesan untuk DESAKU</h5>
            <form action="<?= base_url('user_function/insert_komentar') ?>" method="POST" id="form_komentar">
                <input type="hidden" name="id_berita" value="<?= $result->id_berita; ?>">
                <div class="mb-3" id="req_komentar">
                    <label for="komentar" class="form-label required">Komentar anda</label>
                    <div class="form-floating">
                        <textarea name="komentar" class="form-control" placeholder="Masukkan komentar anda" id="komentar"></textarea>
                        <label for="floatingTextarea">Komentar</label>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-center align-items-center">
                    <button type="button" id="submit_agenda" onclick="submit_form(this,'#form_komentar',2)"  class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 225px;">Kirim</button>
                </div>
            </form>
        </div>
        <div id="parent_komentar">
            <div id="reload_komentar">
                <?php if($komentar) : ?>
                    <?php foreach($komentar AS $row) : ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-between">
                                <h5 class="mb-3"><?= $row->user; ?></h5>
                                <p class="fst-italic fw-light"><?= nice_time($row->create_date); ?></p>
                            </div>
                            <p class="fs-6 mb-0"><?= $row->komentar;?></p>
                        </div>
                    </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
    <?php else : ?>
        <div class="alert alert-warning">
            Login terlebih dahulu untuk dapat meninggalkan komentar
        </div>
    <?php endif;?>
</div>
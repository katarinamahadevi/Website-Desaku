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
            <form action="">
                <div class="mb-3">
                    <label for="" class="form-label required">Nama Lengkap</label>
                    <input type="text" class="form-control py-2" id="" placeholder="Masukkkan nama depan" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label required">Email</label>
                    <input type="email" class="form-control py-2" id="" placeholder="Masukkkan Email" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label required">Komentar anda</label>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Masukkan komentar anda" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Komentar</label>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-center align-items-center">
                    <button type="submit" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" style="width: 225px;">Kirim</button>
                </div>
            </form>
        </div>
        <div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-between">
                        <h5 class="mb-3">Pengguna 1</h5>
                        <p class="fst-italic fw-light">2 hari lalu</p>
                    </div>
                    <p class="fs-6 mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, praesentium ea nulla iste optio eaque odit ut aspernatur repellat eligendi deleniti quis adipisci sit sint obcaecati cumque magni quam ducimus.</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-between">
                        <h5 class="mb-3">Pengguna 2</h5>
                        <p class="fst-italic fw-light">2 hari lalu</p>
                    </div>
                    <p class="fs-6 mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi, praesentium ea nulla iste optio eaque odit ut aspernatur repellat eligendi deleniti quis adipisci sit sint obcaecati cumque magni quam ducimus.</p>
                </div>
            </div>
        </div>
    </div>
    <?php else : ?>
        <div class="alert alert-warning">
            Login terlebih dahulu untuk dapat meninggalkan komentar
        </div>
    <?php endif;?>
</div>
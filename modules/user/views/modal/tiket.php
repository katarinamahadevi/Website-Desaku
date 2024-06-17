<div class="modal-body px-4 py-3" style="width: 100%;" id="">
    <div class="row">
        <div class="col-xl-12">
            <div>
                <div class=" me-2">
                    <img src="<?= image_check($result->gambar,'wisata'); ?>" alt="Image" style="width: 100%; height: 250px;">
                </div>
                <div class="content me-2">
                    <?php if($fasilitas) : ?>
                        <p class="mt-3">
                            Fasilitas : 
                            <?php $no = 0; foreach($fasilitas AS $row) : $num = $no++; ?>
                                <?php if($num == 0) : ?>
                                    <?= $row->fasilitas;?>
                                <?php else : ?>
                                    <?= ','.$row->fasilitas;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        </p>
                    <?php endif;?>
                    <h4 class="my-3"><?= $result->nama; ?></h4>
                    <p class="mb-3"><?= $result->deskripsi;?></p>
                </div>
            </div>
        </div>
    </div>      
</div>
<div class="modal-footer d-flex justify-content-center align-items-center">
    <button onclick="modal_pesan(<?= $result->id_wisata;?>)" data-bs-toggle="modal" href="#modalOrder" type="button" class="btn btn-warning">Pesan Tiket</button>
</div>

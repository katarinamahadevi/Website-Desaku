<div class="modal-body section" style="width: 100%;">
    <form action="<?= base_url('user_function/transaksi') ?>" method="POST" id="form_indi" class="row">
        <div id="display_form_pengunjung" class="col-xl-12 d-flex justify-content-center align-items-center flex-column showin">
            <div>
                <div class="mb-3">
                    <label for="nama_pengunjung" class="form-label required">Nama Pengunjung</label>
                    <input onkeyup="cek_button(this)" type="text" id="nama_pengunjung" class="form-control form-control-solid py-2 hapus" id="" placeholder="Masukkkan nama pengunjung" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label required">Pilih kategori tiket</label>
                    <select onchange="get_harga(this)" id="select_id_tiket" class="form-select form-select py-2 hapus">
                        <option selected>Pilih kategori tiket</option>
                        <?php if($tiket) : ?>
                            <?php foreach($tiket AS $row) : ?>
                            <option value="<?= $row->id_tiket ?>" data-harga="<?= $row->harga; ?>" data-tiket="<?= $row->tiket; ?>"><?= $row->tiket; ?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Harga Tiket</label>
                    <input type="text" class="form-control form-control-solid py-2 hapus" id="display_price" value="" autocomplete="off" readonly>
                    <input type="hidden" id="display_tiket">
                    <input type="hidden" name="total_harga" id="total_harga">
                    <input type="hidden" name="id_wisata" value="<?= $result->id_wisata; ?>">
                </div>
            </div>
        </div>
        <div id="display_pengunjung" class="col-xl-5 d-flex align-items-center flex-column card-pengunjung hidin">
            <div class="card mb-3 me-2 border-0" style="width: 18rem; border-radius: 10px;">
                <div class="card-header bg-transparent d-flex justify-content-end align-items-end border-0 border-0 py-0 my-0 px-2">
                    <h6 class="mb-0 font-monospace text-danger">Total Harga : <span id="display_total"></span></h6>
                </div>
            </div>
            <div id="parent_pengunjung">
                
            </div>
        </div>
    </form>
</div>
<div class="modal-footer d-flex justify-content-center align-items-center border-0">
     <button type="button" id="btn_tambah_pengunjung" onclick="tambah_pengunjung(this)" class="btn btn-dark fw-normal text-white py-2" style="width: 200px;" disabled>Tambah Pengunjung</button>
    <button type="button" class="btn-hover-bg btn btn-primary fw-normal text-white py-2" onclick="submit_form(this,'#form_indi',1)" id="button_pesan" style="width: 200px;">Pesan Tiket Sekarang</button>
</div>
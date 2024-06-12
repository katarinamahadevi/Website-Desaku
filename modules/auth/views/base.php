BASE ATAS
<?php $no = 0; foreach($allpage AS $pg) : $num = $no++; $data['sort'] = $form_number[$num];?>
    <div id="<?= $pg ?>" class="manipulate_page <?= ($pg == $page) ? 'showin' : 'hidin' ?>">
        <?= $this->load->view('page/'.$pg,$data); ?>
    </div>
<?php endforeach;?>
BASE BAWAH
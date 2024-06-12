<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Admin
{
    var $id_role = '';
    var $id_user = '';
    var $nama = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
        $this->nama = $this->session->userdata('hpalnickel_nama');
    }



    // MASTER USER

    public function tambah_user()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama user';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['role']           = 'Peran';
        $arrVar['password']         = 'Kata sandi';
        $arrVar['repassword']       = 'Konfirmasi kata sandi ';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var, ['password', 'repassword'])) {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
                $tujuan = './data/user/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_produk = [];

                if (!$this->upload->do_upload('foto')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_produk = array('upload_data' => $this->upload->data());
                    $post['foto'] = $data_produk['upload_data']['file_name'];
                }
            }
             $user_telp = $this->action_m->get_single('user', ['notelp' => $notelp]);
            if ($user_telp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                echo json_encode($data);
                exit;
            }

            if ($password != $repassword) {
                $data['status'] = false;
                $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                echo json_encode($data);
                exit;
            } else {
                $post['password'] = hash_my_password($notelp . $password);
                $post['password_payment'] = hash_my_password($notelp . $password);
            }
            $post['user.created_by'] = $this->id_user;
            $insert = $this->action_m->insert('user', $post);
            if ($insert) {
               

                $data['status'] = true;
                $data['alert']['message'] = 'Data user berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table');
                $data['modal']['id'] = '#kt_modal_user';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_user()
    {
        // VARIABEL
        $arrVar['id_user']          = 'Id user';
        $arrVar['nama']             = 'Nama user';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['role']           = 'Peran';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $result = $this->action_m->get_single('user', ['id_user' => $id_user]);
        $password = $this->input->post('password');
        $repassword = $this->input->post('repassword');
        $nama_foto = $this->input->post('nama_foto');

        if ($result->notelp != $notelp) {
            $cek_notelp = $this->action_m->get_single('user', ['notelp' => $notelp]);
            if ($cek_notelp) {
                $data['status'] = false;
                $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                echo json_encode($data);
                exit;
            }   
            if (!$password) {
                $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena nomor telepon berubah'];
                $arrAccess[] = false;
            } 
            if (!$repassword) {
                $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena nomor telpon berubah'];
                $arrAccess[] = false;
            }     
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
                $tujuan = './data/user/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_produk = [];

                if (!$this->upload->do_upload('foto')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_produk = array('upload_data' => $this->upload->data());
                    $post['foto'] = $data_produk['upload_data']['file_name'];
                    if ($nama_foto) {
                        unlink($tujuan.$nama_foto);
                    }
                    
                }
            }
            if ($password) {
                if ($password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($notelp . $password);
                }
            }
            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            if ($update) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data user berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table');
                $data['modal']['id'] = '#kt_modal_user';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_user()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('user',['id_user' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('user',['id_user' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data user berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data user gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data user tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function block_user($ent = 'user')
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');
         $res = $this->action_m->get_single('user',['id_user' => $id]);
        if (!$res) {
             $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data '.$ent.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['blocked'] = $action;
        if ($action == 'Y') {
            $set['block_reason'] = $reason;
            $set['block_date'] = date('Y-m-d H:i:s');
            $set['block_by'] = $this->id_user;
            $t = 'block';
        } else {
            $set['block_reason'] = NULL;
            $set['block_date'] = NULL;
            $set['block_by'] = NULL;
            $t = 'unblock';
        }

        $update = $this->action_m->update('user', $set, ['id_user' => $id]);
        $alasan = '';
        if ($update) {


            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'Y') {
                $data['alert']['message'] = $ent.' berhasil di blockir! '.$ent.' tidak akan bisa melakukan akses pada sistem';
            } else {
                $data['alert']['message'] = 'Status blockir '.$ent.' telah dibuka! '.$ent.' bisa melakukan akses pada sistem';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = $ent.' gagal di blockir! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function drag_user($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('user',['id_user' => $id]);
        $dt = [];
        if ($cek) {
            $no = 0;
            foreach ($cek as $key) {
                $num = $no++;
                $dt['value'][$num] = $key->nama; 
            }        
        }else{
            $dt['value'] = 'Tidak ada data ditemukan';
        }
         if (!$cek) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Data user tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data user belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_user'] = $value;
                $set[$num]['blocked'] = 'Y';
                $set[$num]['block_by'] = $this->id_user;
                $set[$num]['block_date'] = date('Y-m-d H:i:s');
            }
            $block = $this->action_m->update_batch('user', $set, 'id_user');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah user';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah user';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_user'] = $value;
                $set[$num]['blocked'] = 'N';
                $set[$num]['block_by'] = NULL;
                $set[$num]['block_date'] = NULL;
            }
            $block = $this->action_m->update_batch('user', $set, 'id_user');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah user';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah user';;
            }
        } elseif ($action == 'deleted') {
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }

            $set['id_user'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('user', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah user';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/user #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah user';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }



    // MASTER PRODUK
    public function tambah_proyek()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama proyek';
        $arrVar['skala_proyek']     = 'Skala kebutuhan proyek';
        $arrVar['min_investasi']    = 'Minimal Investasi';
        $arrVar['profit']           = 'Besar profit';
        $arrVar['waktu']       = 'Tanggal dimulai';
        $arrVar['durasi']           = 'Durasi proyek';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $deskripsi = $this->input->post('deskripsi');
        $post['deskripsi'] = $deskripsi;
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/proyek/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_produk = [];

                if (!$this->upload->do_upload('gambar')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_produk = array('upload_data' => $this->upload->data());
                    $post['gambar'] = $data_produk['upload_data']['file_name'];
                }
            }else{
                 $data['status'] = false;
                $data['alert']['message'] = 'Gambar proyek tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }

            $post['create_by'] = $this->id_user;
            $insert = $this->action_m->insert('investasi', $post);
            if ($insert) {

                $data['status'] = true;
                $data['alert']['message'] = 'Data proyek berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/proyek #reload_table');
                $data['modal']['id'] = '#kt_modal_proyek';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_proyek()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama proyek';
        $arrVar['skala_proyek']     = 'Skala kebutuhan proyek';
        $arrVar['min_investasi']    = 'Minimal Investasi';
        $arrVar['profit']           = 'Besar profit';
        $arrVar['waktu']       = 'Tanggal dimulai';
        $arrVar['durasi']           = 'Durasi proyek';
        $arrVar['id_investasi']     = 'ID Investasi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $deskripsi = $this->input->post('deskripsi');
        $post['deskripsi'] = $deskripsi;
        if (!in_array(false, $arrAccess)) {
            $result = $this->action_m->get_single('investasi',['id_investasi' => $id_investasi]);
            $nama_gambar = $this->input->post('nama_gambar');
            if (!empty($_FILES['gambar']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/proyek/')) {
                    mkdir('/data/proyek/');
                }
                $gambar = $_FILES['gambar'];
                $tujuan = './data/proyek/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_proyek = [];

                if (!$this->upload->do_upload('gambar')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_proyek = array('upload_data' => $this->upload->data());
                    $post['gambar'] = $data_proyek['upload_data']['file_name'];
                    unlink($tujuan . $nama_gambar);
                }
            }else{
                if ($nama_gambar == '') {
                     $data['status'] = false;
                    $data['alert']['message'] = 'Gambar tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }
            
            $update = $this->action_m->update('investasi', $post, ['id_investasi' => $id_investasi]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data proyek berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/proyek #reload_table');
                $data['modal']['id'] = '#kt_modal_proyek';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_proyek()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('investasi',['id_investasi' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('investasi', ['id_investasi' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data investasi berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data investasi gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data investasi tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function switch_proyek()
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');
        $res = $this->action_m->get_single('investasi',['id_investasi' => $id]);
        if (!$res) {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data proyek tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'N') {
            $set['block_reason'] = $reason;
            $t = 'menyembunyikan';
        } else {
            $set['block_reason'] = NULL;
            $t = 'menampilkan';
        }

        $update = $this->action_m->update('investasi', $set, ['id_investasi' => $id]);
        $alasan = '';
        if ($update) {

            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'N') {
                $data['alert']['message'] = 'Berhasil di sembunyikan! investasi tidak akan bisa diakses oleh user';
            } else {
                $data['alert']['message'] = 'investasi telah dibuka! investasi bisa DIakses oleh user';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'investasi gagal disembunyikan! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function drag_proyek($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('investasi',['id_investasi' => $id]);
        $dt = [];
        if ($cek) {
            $no = 0;
            foreach ($cek as $key) {
                $num = $no++;
                $dt['value'][$num] = $key->nama; 
            }        
        }else{
            $dt['value'] = 'Tidak ada data ditemukan';
        }
         if (!$cek) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Data proyek tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data proyek belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_investasi'] = $value;
                $set[$num]['status'] = 'N';
                $set[$num]['block_by'] = $this->id_user;
            }
            $block = $this->action_m->update_batch('investasi', $set, 'id_investasi');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menyembunyikan sejumlah proyek';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/proyek #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah proyek';
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_investasi'] = $value;
                $set[$num]['status'] = 'Y';
                $set[$num]['block_by'] = NULL;
            }
            $block = $this->action_m->update_batch('investasi', $set, 'id_investasi');
            if ($block) {

                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menampilkan kembali sejumlah proyek';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/proyek #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menampilkan kembali sejumlah proyek';
            }
        } elseif ($action == 'deleted') {
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }
            
            $set['id_investasi'] = $ed;
            $delete = $this->action_m->delete_batch('investasi', $set);
            if ($delete) {

                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah proyek';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/proyek #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah proyek';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }

    public function tambah_bank()
    {
        // VARIABEL
        $arrVar['nama']                          = 'Nama bank';
        $arrVar['fee']                           = 'Fee';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/bank/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_bank = [];

                if (!$this->upload->do_upload('gambar')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_bank = array('upload_data' => $this->upload->data());
                    $post['gambar'] = $data_bank['upload_data']['file_name'];
                }
            }else{
                 $data['status'] = false;
                $data['alert']['message'] = 'Gambar bank tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
            $insert = $this->action_m->insert('bank', $post);
            if ($insert) {

                $data['status'] = true;
                $data['alert']['message'] = 'Data bank berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/bank #reload_table');
                $data['modal']['id'] = '#kt_modal_bank';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function ubah_bank()
    {
        // VARIABEL
        $arrVar['nama']                          = 'Nama bank';
        $arrVar['fee']                           = 'Fee';
        $arrVar['id_bank']                   = 'ID bank';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        if (!in_array(false, $arrAccess)) {
            $result = $this->action_m->get_single('bank',['id_bank' => $id_bank]);
            $nama_foto = $this->input->post('nama_foto');
            if (!empty($_FILES['gambar']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/bank/')) {
                    mkdir('/data/bank/');
                }
                $gambar = $_FILES['gambar'];
                $tujuan = './data/bank/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'jpg|png|JPG|PNG|jpeg|JPEG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_bank = [];

                if (!$this->upload->do_upload('gambar')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_bank = array('upload_data' => $this->upload->data());
                    $post['gambar'] = $data_bank['upload_data']['file_name'];
                    unlink($tujuan . $nama_foto);
                }
            }else{
                if ($nama_foto == '') {
                     $data['status'] = false;
                    $data['alert']['message'] = 'Gambar tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }
            
            $update = $this->action_m->update('bank', $post, ['id_bank' => $id_bank]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data bank berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/bank #reload_table');
                $data['modal']['id'] = '#kt_modal_bank';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        } else {
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function hapus_bank()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('bank',['id_bank' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('bank', ['id_bank' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data bank berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data bank gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data bank tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function switch_bank()
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');
        $res = $this->action_m->get_single('bank',['id_bank' => $id]);
        if (!$res) {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data bank tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'N') {
            $set['block_reason'] = $reason;
            $t = 'menyembunyikan';
        } else {
            $set['block_reason'] = NULL;
            $t = 'menampilkan';
        }

        $update = $this->action_m->update('bank', $set, ['id_bank' => $id]);
        $alasan = '';
        if ($update) {

            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'N') {
                $data['alert']['message'] = 'Berhasil di sembunyikan! bank tidak akan bisa diakses oleh user';
            } else {
                $data['alert']['message'] = 'bank telah dibuka! bank bisa DIakses oleh user';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'bank gagal disembunyikan! Coba lagi setelah beberapa saat atau laporkan';
        }
        echo json_encode($data);
        exit;
    }

    public function drag_bank($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('bank',['id_bank' => $id]);
        $reason = $this->input->post('reason');
        $dt = [];
        if ($cek) {
            $no = 0;
            foreach ($cek as $key) {
                $num = $no++;
                $dt['value'][$num] = $key->nama; 
            }        
        }else{
            $dt['value'] = 'Tidak ada data ditemukan';
        }
         if (!$cek) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Data bank tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data bank belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_bank'] = $value;
                $set[$num]['status'] = 'N';
                $set[$num]['block_reason'] = $reason;
            }
            $block = $this->action_m->update_batch('bank', $set, 'id_bank');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menyembunyikan pada sejumlah bank';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/bank #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menyembunyikan pada sejumlah bank';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_bank'] = $value;
                $set[$num]['status'] = 'Y';
                $set[$num]['block_reason'] = '';
            }
            $block = $this->action_m->update_batch('bank', $set, 'id_bank');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menampilkan pada sejumlah bank';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/bank #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menampilkan pada sejumlah user';;
            }
        } elseif ($action == 'deleted') {
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }

            $set['id_bank'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('bank', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah bank';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('master/bank #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah bank';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }

    
}

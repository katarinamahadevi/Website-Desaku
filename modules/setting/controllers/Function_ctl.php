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

    public function update()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama karyawan';
        $arrVar['notelp']           = 'Nomor telepon';

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
        $id_user = $this->id_user;

        $result = $this->action_m->get_single('user', ['id_user' => $id_user]);
        $password = $this->input->post('password');
        $new_password = $this->input->post('new_password');
        $repassword = $this->input->post('repassword');
        

        if ($result->notelp != $notelp) {
            if (!$password) {
                $data['required'][] = ['req_password', 'Kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            } 

            if (!$new_password) {
                $data['required'][] = ['req_new_password', 'Kata sandi baru tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            } 
            if (!$repassword) {
                $data['required'][] = ['req_repassword', 'Konfirmasi kata sandi tidak boleh kosong ! Karena email berubah'];
                $arrAccess[] = false;
            }     
        }
        $nama_foto = $this->input->post('nama_foto');
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
                $tujuan = './data/user/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_user = [];

                if (!$this->upload->do_upload('foto')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_user = array('upload_data' => $this->upload->data());
                    $post['foto'] = $data_user['upload_data']['file_name'];
                    $arrSession['hpalnickel_foto'] = $data_user['upload_data']['file_name'];
                    if ($nama_foto) {
                        unlink($tujuan.$nama_foto);
                    }
                }
            }
            if ($result->notelp != $notelp) {
                $cek_notelp = $this->action_m->get_single('user', ['notelp' => $notelp,'id_user != ' => $this->id_user]);
                if ($cek_notelp) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }
            }
            $post['notelp'] = $notelp;

            if ($password) {
                if (hash_my_password($result->notelp.$password) == $result->password) {
                    if ($new_password != $repassword) {
                        $data['status'] = false;
                        $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                        echo json_encode($data);
                        exit;
                    } else {
                        $post['password'] = hash_my_password($notelp . $new_password);
                    }
                }else{
                    $data['status'] = false;
                    $data['alert']['message'] = 'Password yang anda masukan salah!';
                    echo json_encode($data);
                    exit;
                }
                
            }
            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            if ($update) {
                $arrSession['hpalnickel_nama'] = $nama;
                $arrSession['hpalnickel_notelp'] = $notelp;
                $this->session->set_userdata($arrSession);
                $data['status'] = true;
                $data['alert']['message'] = 'Data profil berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('profile #reload_table');
                $data['modal']['id'] = '#kt_modal_1';
                $data['modal']['action'] = 'hide';
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


    public function setup()
    {
        // VARIABEL
        $arrVar['phone_admin']                   = 'Nomor admin';
        $arrVar['phone_cs']                      = 'Nomor customer service';

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

        $tentang_kami = $this->input->post('tentang_kami');
        $text_wa = $this->input->post('text_wa');
        $landing_text = $this->input->post('landing_text');
        $kode_pendaftaran = $this->input->post('kode_pendaftaran');
        $jaminan_keamanan = $this->input->post('jaminan_keamanan');
        $logo_ojk = $this->input->post('logo_ojk');
        $logo_ojk = ($logo_ojk != 'Y') ? 'N' : 'Y';

        $post['tentang_kami'] = trim($tentang_kami);
        $post['landing_text'] = trim($landing_text);
        $post['text_wa'] = trim($text_wa);
        $post['logo_ojk'] = trim($logo_ojk);
        $post['kode_pendaftaran'] = trim($kode_pendaftaran);
        $post['jaminan_keamanan'] = trim($jaminan_keamanan);

        if (!in_array(false, $arrAccess)) {
            $nama_logo = $this->input->post('nama_logo');
            if (!empty($_FILES['logo']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/logo/')) {
                    mkdir('/data/logo/');
                }
                $logo = $_FILES['logo'];
                $tujuan = './data/logo/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|PNG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_logo = [];

                if (!$this->upload->do_upload('logo')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_logo = array('upload_data' => $this->upload->data());
                    $post['logo'] = $data_logo['upload_data']['file_name'];
                    if ($nama_logo) {
                        unlink($tujuan.$nama_logo);
                    }
                }
            }else{
                if ($nama_logo == '') {
                     $data['status'] = false;
                    $data['alert']['message'] = 'Logo tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }

            $nama_icon = $this->input->post('nama_icon');
            if (!empty($_FILES['icon']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/icon/')) {
                    mkdir('/data/icon/');
                }
                $icon = $_FILES['icon'];
                $tujuan2 = './data/icon/';
                $config2['upload_path'] = $tujuan2;
                $config2['allowed_types'] = 'png|PNG';
                $config2['file_name'] = uniqid();
                $config2['file_ext_tolower'] = true;

                $this->load->library('upload', $config2);

                $data_icon = [];

                if (!$this->upload->do_upload('icon')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_icon = array('upload_data' => $this->upload->data());
                    $post['icon'] = $data_icon['upload_data']['file_name'];
                    if ($nama_icon) {
                        unlink($tujuan2.$nama_icon);
                    }
                }
            }else{
                if ($nama_icon == '') {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Icon tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }


            $nama_landing_image = $this->input->post('nama_landing_image');
            if (!empty($_FILES['landing_image']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/setting/')) {
                    mkdir('/data/setting/');
                }
                $landing_image = $_FILES['landing_image'];
                $tujuan3 = './data/setting/';
                $config3['upload_path'] = $tujuan3;
                $config3['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG|svg|SVG';
                $config3['file_name'] = uniqid();
                $config3['file_ext_tolower'] = true;

                $this->load->library('upload', $config3);

                $data_landing_image = [];

                if (!$this->upload->do_upload('landing_image')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_landing_image = array('upload_data' => $this->upload->data());
                    $post['landing_image'] = $data_landing_image['upload_data']['file_name'];
                    if ($nama_landing_image) {
                        unlink($tujuan3.$nama_landing_image);
                    }
                    
                }
            }
            
            $update = $this->action_m->update('setting', $post, ['id_setting' => 1]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data setting berhasil di rubah!';
                $data['load'][0]['parent'] = '#reload_sidebar';
                $data['load'][0]['reload'] = base_url('setting').' #kt_app_sidebar';
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


    public function upload_banner()
    {
        if (!empty($_FILES['gambar']['tmp_name'])) {
            if (!file_exists('/data/')) {
                mkdir('/data/');
            }
            if (!file_exists('../data/banner/')) {
                mkdir('/data/banner/');
            }
            $gambar = $_FILES['gambar'];
            $tujuan = './data/banner/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
            $config['file_name'] = uniqid();
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $data_gambar = [];

            if (!$this->upload->do_upload('gambar')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $data_gambar = array('upload_data' => $this->upload->data());
                $post['gambar'] = $data_gambar['upload_data']['file_name'];
                $insert = $this->action_m->insert('banner',$post);
                if ($insert) {
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('setting #reload_table');
                    $data['status'] = true;
                    $data['alert']['message'] = 'Banner berhasil di tambahkan';
                    echo json_encode($data);
                    exit;
                }else{
                    $data['status'] = false;
                    $data['alert']['message'] = 'Banner gagal di tambahkan';
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Banner tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }
    }


    public function hapus_banner()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('banner',['id_banner' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('banner', ['id_banner' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data banner berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data banner gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data banner tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

}
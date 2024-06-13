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
        $this->id_role = $this->session->userdata(PREFIX_SESSION.'_id_role');
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
        $this->nama = $this->session->userdata(PREFIX_SESSION.'_nama');
    }

    public function update()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama karyawan';
        $arrVar['email']            = 'Alamat email';
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
        $nama_foto = $this->input->post('nama_foto');

        if ($result->email != $email) {
            $cek_email = $this->action_m->get_single('user', ['email' => $email]);
            if ($cek_email) {
                $data['status'] = false;
                $data['alert']['message'] = 'Alamat email sudah terdaftar!';
                echo json_encode($data);
                exit;
            }   
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
                    $arrSession[PREFIX_SESSION.'_foto'] = $data_user['upload_data']['file_name'];
                    if ($nama_foto) {
                        unlink($tujuan.$nama_foto);
                    }
                }
            }
            if (!validasi_email($email)) {
                $data['status'] = false;
                $data['alert']['message'] = 'Alamat email tidak valid!';
                echo json_encode($data);
                exit;
            }

            if ($result->notelp != $notelp) {
                $cek_notelp = $this->action_m->get_single('user', ['notelp' => $notelp]);
                if ($cek_notelp) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Nomor telepon sudah terdaftar!';
                    echo json_encode($data);
                    exit;
                }
            }

            if ($password) {
                if (hash_my_password($result->email.$password) == $result->password) {
                    if ($new_password != $repassword) {
                        $data['status'] = false;
                        $data['alert']['message'] = 'Konfirmasi password tidak sesuai!';
                        echo json_encode($data);
                        exit;
                    } else {
                        $post['password'] = hash_my_password($email . $new_password);
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
                $arrSession[PREFIX_SESSION.'_nama'] = $nama;
                $arrSession[PREFIX_SESSION.'_email'] = $email;
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
        $arrVar['email']                         = 'Alamat email';
        $arrVar['phone_admin']                   = 'Nomor admin';
        $arrVar['phone_cs']                      = 'Nomor customer service';
        $arrVar['batas_waktu_pembayaran']        = 'Batas waktu pembayaran';

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
        $link_grub = $this->input->post('link_grub');
        $link_youtube = $this->input->post('link_youtube');
        $text_wa = $this->input->post('text_wa');
        $text_cs = $this->input->post('text_cs');
        
        $post['tentang_kami'] = trim($tentang_kami);
        $post['link_grub'] = trim($link_grub);
        $post['link_youtube'] = trim($link_youtube);
        $post['text_wa'] = trim($text_wa);
        $post['text_cs'] = trim($text_cs);

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
                    unlink($tujuan . $nama_logo);
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
                    unlink($tujuan2 . $nama_icon);
                }
            }else{
                if ($nama_icon == '') {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Icon tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
            }


            $nama_gambar_cs = $this->input->post('nama_gambar_cs');
            if (!empty($_FILES['gambar_cs']['tmp_name'])) {
                if (!file_exists('/data/')) {
                    mkdir('/data/');
                }
                if (!file_exists('../data/setting/')) {
                    mkdir('/data/setting/');
                }
                $gambar_cs = $_FILES['gambar_cs'];
                $tujuan3 = './data/setting/';
                $config3['upload_path'] = $tujuan3;
                $config3['allowed_types'] = 'png|PNG';
                $config3['file_name'] = uniqid();
                $config3['file_ext_tolower'] = true;

                $this->load->library('upload', $config3);

                $data_gambar_cs = [];

                if (!$this->upload->do_upload('gambar_cs')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_gambar_cs = array('upload_data' => $this->upload->data());
                    $post['gambar_cs'] = $data_gambar_cs['upload_data']['file_name'];
                    unlink($tujuan3 . $nama_gambar_cs);
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

}
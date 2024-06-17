<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_User
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
        $this->foto = $this->session->userdata(PREFIX_SESSION.'_foto');
        
    }


    public function profil()
    {
        // VARIABEL
        $arrVar['nama']            = 'Nama';
        $arrVar['nik']            = 'NIK';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = trim($this->input->post($var));
            if (!$$var) {
                $data['required'][] = ['req_profil_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $id_user = $this->id_user;

        $result = $this->action_m->get_single('user', ['id_user' => $id_user,'blocked' => 'N']);
        if (!$result) {
            redirect('logout');
        }
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            
            if ($update) {
                $arrSession[PREFIX_SESSION.'_nama'] = $nama;

                $this->session->set_userdata($arrSession);

                $data['status'] = true;
                $data['alert']['message'] = 'Biodata berhasil di rubah!';
                $data['load'][0]['parent'] = '#parent_ubah_profil';
                $data['load'][0]['reload'] = base_url('profil/ubah/ #reload_ubah_profil');
                $data['input']['password'] = true;
                $data['canvas'][0]['id'] = '#offcanvasNama';
                $data['canvas'][0]['action'] = 'hide';
               
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
    public function ubah_sandi()
    {
        // VARIABEL
        $arrVar['type_form']             = 'Form tipe';
        $arrVar['password']              = 'Kata sandi';
        $arrVar['repassword']            = 'Konfirmasi kata sandi';
        $arrVar['new_password']           = 'Kata sandi baru';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_profil_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var,['type_form','password','repassword','new_password'])) {
                    $post[$var] = trim($$var);
                }
                $arrAccess[] = true;
            }
        }
        $id_user = $this->id_user;

        $result = $this->action_m->get_single('user', ['id_user' => $id_user,'blocked' => 'N']);
        if (!$result) {
            redirect('logout');
        }
        if (!in_array($type_form,['masuk','pembayaran'])) {
            $data['status'] = false;
            $data['alert']['message'] = 'Type Form tidak di ketahui';
            echo json_encode($data);
            exit;
        }
        if (!in_array(false, $arrAccess)) {
            if (hash_my_password($result->notelp.$password) == $result->password) {
                if ($new_password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi kata sandi tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    if ($type_form == 'masuk') {
                        $post['password'] = hash_my_password($result->notelp . $new_password);
                    }

                    if ($type_form == 'pembayaran') {
                        $post['password_payment'] = hash_my_password($result->notelp . $new_password);
                    }
                    
                }
            }else{
                $data['status'] = false;
                $data['alert']['message'] = 'Kata sandi yang anda masukan salah!';
                echo json_encode($data);
                exit;
            }

            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Kata sandi '.$type_form.' berhasil di rubah!';
                $data['load'][0]['parent'] = '#parent_ubah_profil';
                $data['load'][0]['reload'] = base_url('profil/ubah/ #reload_ubah_profil');
                $data['canvas'][0]['id'] = '#offcanvasSandi';
                $data['canvas'][0]['action'] = 'hide';
               
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

    public function upload_foto()
    {
        if (!empty($_FILES['foto']['tmp_name'])) {
            if (!file_exists('/data/')) {
                mkdir('/data/');
            }
            if (!file_exists('../data/foto/')) {
                mkdir('/data/foto/');
            }
            $foto = $_FILES['foto'];
            $tujuan = './data/user/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
            $config['file_name'] = uniqid();
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $data_foto = [];

            if (!$this->upload->do_upload('foto')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $data_foto = array('upload_data' => $this->upload->data());
                $post['foto'] = $data_foto['upload_data']['file_name'];
                $update = $this->action_m->update('user',$post,['id_user' => $this->id_user]);
                if ($update) {
                    unlink($tujuan.$this->foto);
                    $arrSession[PREFIX_SESSION.'_foto'] = $data_foto['upload_data']['file_name'];

                    $this->session->set_userdata($arrSession);

                    $data['status'] = true;
                    $data['alert']['message'] = 'Foto berhasil di tambahkan';
                    echo json_encode($data);
                    exit;
                }else{
                    $data['status'] = false;
                    $data['alert']['message'] = 'Foto gagal di tambahkan';
                    echo json_encode($data);
                    exit;
                }
            }
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Foto tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }
    }


    public function get_single_berita()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('berita', ['id_berita' => $id]);

        $params['arrjoin']['user']['statement'] = 'berita_komentar.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $komentar = $this->action_m->get_where_params('berita_komentar',['id_berita' => $id],'berita_komentar.*,user.nama AS user',$params);
        $data['result'] = $result;
        $data['komentar'] = $komentar;

        $this->load->view('modal/berita',$data);
    }

    public function get_single_tiket()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('wisata', ['id_wisata' => $id]);

        $params['arrjoin']['fasilitas']['statement'] = 'wisata_fasilitas.id_fasilitas = fasilitas.id_fasilitas';
        $params['arrjoin']['fasilitas']['type'] = 'LEFT';
        $fasilitas = $this->action_m->get_where_params('wisata_fasilitas',['id_wisata' => $id],'wisata_fasilitas.*,fasilitas.nama AS fasilitas',$params);
        $data['result'] = $result;
        $data['fasilitas'] = $fasilitas;

        $this->load->view('modal/tiket',$data);
    }


    public function insert_komentar()
    {
        // VARIABEL
        $arrVar['komentar']                 = 'Komentar';
        $arrVar['id_berita']                = 'ID Berita';

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
        $post['id_user'] = $this->id_user;
        if (!in_array(false, $arrAccess)) {
            $insert = $this->action_m->insert('berita_komentar', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data komentar berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#parent_komentar';
                $data['load'][0]['reload'] = base_url('beranda?id_berita='.$id_berita.' #reload_komentar');
                $data['load'][1]['parent'] = '#berita';
                $data['load'][1]['reload'] = base_url('beranda #reload_berita');
                $data['input']['all'] = true;
            } else {
                $data['status'] = false;
            }
        }else{
            $data['status'] = false;
        }
        echo json_encode($data);
        exit;


    }
}
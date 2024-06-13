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

        // MASTER USER

    public function tambah_user()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama user';
        $arrVar['notelp']           = 'Nomor telepon';
        $arrVar['email']           = 'Alamat email';
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
        $alamat = $this->input->post('alamat');
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
                $post['password'] = hash_my_password($email . $password);
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
        $arrVar['email']           = 'Alamat email';
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
        $alamat = $this->input->post('alamat');
        
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
                    $post['password'] = hash_my_password($email . $password);
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
                unlink('./data/user/'.$res->foto);
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

            foreach ($cek as $key) {
                if ($key->foto) {
                    unlink('./data/user/'.$key->foto);
                }
                
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




}
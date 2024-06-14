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

        // pengurus JABATAN

    public function tambah_jabatan()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama jabatan';

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
             $cek = $this->action_m->get_single('jabatan', ['nama' => $nama]);
            if ($cek) {
                $data['status'] = false;
                $data['alert']['message'] = 'Jabatan sudah tersedia!';
                echo json_encode($data);
                exit;
            }
            $post['create_by'] = $this->id_user;
            $insert = $this->action_m->insert('jabatan', $post);
            if ($insert) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data jabatan berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/jabatan #reload_table');
                $data['modal']['id'] = '#kt_modal_jabatan';
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

    public function ubah_jabatan()
    {
        // VARIABEL
        $arrVar['id_jabatan']          = 'Id jabatan';
        $arrVar['nama']             = 'Nama jabatan';

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
        $result = $this->action_m->get_single('jabatan', ['id_jabatan' => $id_jabatan]);
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('jabatan', $post, ['id_jabatan' => $id_jabatan]);
            if ($update) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data jabatan berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/jabatan #reload_table');
                $data['modal']['id'] = '#kt_modal_jabatan';
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

    public function hapus_jabatan()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('jabatan',['id_jabatan' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('jabatan',['id_jabatan' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data jabatan berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data jabatan gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data jabatan tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function drag_jabatan($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('jabatan',['id_jabatan' => $id]);
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
                $data['alert']['message'] = 'Data jabatan tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data jabatan belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_jabatan'] = $value;
                $set[$num]['status'] = 'N';
            }
            $block = $this->action_m->update_batch('jabatan', $set, 'id_jabatan');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah jabatan';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/jabatan #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah jabatan';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_jabatan'] = $value;
                $set[$num]['status'] = 'Y';
            }
            $block = $this->action_m->update_batch('jabatan', $set, 'id_jabatan');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah jabatan';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/jabatan #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah jabatan';;
            }
        } elseif ($action == 'deleted') {
            
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }
            $set['id_jabatan'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('jabatan', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah jabatan';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/jabatan #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah jabatan';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }






    // FUNGSI PENGURUS
      public function tambah_pengurus()
    {
        // VARIABEL
        $arrVar['nama']                 = 'Nama pengurus';
        $arrVar['id_jabatan']           = 'Jabatan';

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
                $tujuan = './data/pengurus/';
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
            }
            $post['pengurus.create_by'] = $this->id_user;
            $insert = $this->action_m->insert('pengurus', $post);
            if ($insert) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data pengurus berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/anggota #reload_table');
                $data['modal']['id'] = '#kt_modal_pengurus';
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

    public function ubah_pengurus()
    {
        // VARIABEL
        $arrVar['id_pengurus']          = 'Id pengurus';
        $arrVar['nama']                 = 'Nama pengurus';
        $arrVar['id_jabatan']           = 'Jabatan';

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
        $result = $this->action_m->get_single('pengurus', ['id_pengurus' => $id_pengurus]);
        $nama_gambar = $this->input->post('nama_gambar');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/pengurus/';
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
                    if ($nama_gambar) {
                        unlink($tujuan.$nama_gambar);
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
            $update = $this->action_m->update('pengurus', $post, ['id_pengurus' => $id_pengurus]);
            if ($update) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data pengurus berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/anggota #reload_table');
                $data['modal']['id'] = '#kt_modal_pengurus';
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

    public function hapus_pengurus()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('pengurus',['id_pengurus' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('pengurus',['id_pengurus' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data pengurus berhasil dihapus';
                unlink('./data/pengurus/'.$res->gambar);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data pengurus gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data pengurus tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function block_pengurus($ent = 'pengurus')
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');
         $res = $this->action_m->get_single('pengurus',['id_pengurus' => $id]);
        if (!$res) {
             $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data '.$ent.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'Y') {
            $t = 'block';
        } else {
            $t = 'unblock';
        }

        $update = $this->action_m->update('pengurus', $set, ['id_pengurus' => $id]);
        $alasan = '';
        if ($update) {


            $data['status'] = 200;
            $data['alert']['icon'] = 'success';
            if ($action == 'N') {
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

    public function drag_pengurus($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('pengurus',['id_pengurus' => $id]);
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
                $data['alert']['message'] = 'Data pengurus tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data pengurus belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_pengurus'] = $value;
                $set[$num]['status'] = 'N';
            }
            $block = $this->action_m->update_batch('pengurus', $set, 'id_pengurus');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah pengurus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/anggota #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah pengurus';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_pengurus'] = $value;
                $set[$num]['status'] = 'Y';
            }
            $block = $this->action_m->update_batch('pengurus', $set, 'id_pengurus');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah pengurus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/anggota #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah pengurus';;
            }
        } elseif ($action == 'deleted') {
            
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }

            foreach ($cek as $key) {
                if ($key->gambar) {
                    unlink('./data/pengurus/'.$key->gambar);
                }
                
            }
            $set['id_pengurus'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('pengurus', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah pengurus';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('pengurus/anggota #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah pengurus';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }




}
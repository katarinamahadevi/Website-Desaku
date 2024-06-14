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

      public function tambah_tiket()
    {
        // VARIABEL
        $arrVar['nama']             = 'Nama tiket';
        $arrVar['harga']             = 'Harga tiket';

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
            $post['create_by'] = $this->id_user;
            $insert = $this->action_m->insert('tiket', $post);
            if ($insert) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data tiket berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/tiket #reload_table');
                $data['modal']['id'] = '#kt_modal_tiket';
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

    public function ubah_tiket()
    {
        // VARIABEL
        $arrVar['id_tiket']          = 'Id tiket';
        $arrVar['nama']             = 'Nama tiket';
        $arrVar['harga']             = 'Harga tiket';

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
        $result = $this->action_m->get_single('tiket', ['id_tiket' => $id_tiket]);
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('tiket', $post, ['id_tiket' => $id_tiket]);
            if ($update) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data tiket berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/tiket #reload_table');
                $data['modal']['id'] = '#kt_modal_tiket';
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

    public function hapus_tiket()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('tiket',['id_tiket' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('tiket',['id_tiket' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data tiket berhasil dihapus';
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data tiket gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data tiket tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function drag_tiket($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('tiket',['id_tiket' => $id]);
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
                $data['alert']['message'] = 'Data tiket tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data tiket belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_tiket'] = $value;
                $set[$num]['status'] = 'N';
            }
            $block = $this->action_m->update_batch('tiket', $set, 'id_tiket');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah tiket';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/tiket #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah tiket';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_tiket'] = $value;
                $set[$num]['status'] = 'Y';
            }
            $block = $this->action_m->update_batch('tiket', $set, 'id_tiket');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah tiket';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/tiket #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah tiket';;
            }
        } elseif ($action == 'deleted') {
            
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }
            $set['id_tiket'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('tiket', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah tiket';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/tiket #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah tiket';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }

    public function block_tiket($ent = 'tiket')
    {
        $id = $this->input->post('id');
        $action = $this->input->post('action');
        $reason = $this->input->post('reason');
         $res = $this->action_m->get_single('tiket',['id_tiket' => $id]);
        if (!$res) {
             $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data '.$ent.' tidak ditemukan';
            echo json_encode($data);
            exit;
        }
        $set['status'] = $action;
        if ($action == 'N') {
            $t = 'block';
        } else {
            $t = 'unblock';
        }

        $update = $this->action_m->update('tiket', $set, ['id_tiket' => $id]);
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






    // FASILITAS
      public function tambah_fasilitas()
    {
        // VARIABEL
        $arrVar['nama']                 = 'Nama fasilitas';

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
            if (!empty($_FILES['icon']['tmp_name'])) {
                $icon = $_FILES['icon'];
                $tujuan = './data/fasilitas/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|PNG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_produk = [];

                if (!$this->upload->do_upload('icon')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_produk = array('upload_data' => $this->upload->data());
                    $post['icon'] = $data_produk['upload_data']['file_name'];
                }
            }
            $post['fasilitas.create_by'] = $this->id_user;
            $insert = $this->action_m->insert('fasilitas', $post);
            if ($insert) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data fasilitas berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/fasilitas #reload_table');
                $data['modal']['id'] = '#kt_modal_fasilitas';
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

    public function ubah_fasilitas()
    {
        // VARIABEL
        $arrVar['id_fasilitas']          = 'Id fasilitas';
        $arrVar['nama']                 = 'Nama fasilitas';

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
        $result = $this->action_m->get_single('fasilitas', ['id_fasilitas' => $id_fasilitas]);
        $nama_icon = $this->input->post('nama_icon');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['icon']['tmp_name'])) {
                $icon = $_FILES['icon'];
                $tujuan = './data/fasilitas/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|PNG';
                $config['file_name'] = uniqid();
                $config['file_ext_tolower'] = true;

                $this->load->library('upload', $config);

                $data_produk = [];

                if (!$this->upload->do_upload('icon')) {

                    $error = $this->upload->display_errors();
                    $data['status'] = false;
                    $data['alert']['message'] = $error;
                    echo json_encode($data);
                    exit;
                } else {
                    $data_produk = array('upload_data' => $this->upload->data());
                    $post['icon'] = $data_produk['upload_data']['file_name'];
                    if ($nama_icon) {
                        unlink($tujuan.$nama_icon);
                    }
                    
                }
            }
            $update = $this->action_m->update('fasilitas', $post, ['id_fasilitas' => $id_fasilitas]);
            if ($update) {
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data fasilitas berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/fasilitas #reload_table');
                $data['modal']['id'] = '#kt_modal_fasilitas';
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

    public function hapus_fasilitas()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('fasilitas',['id_fasilitas' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('fasilitas',['id_fasilitas' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data fasilitas berhasil dihapus';
                unlink('./data/fasilitas/'.$res->icon);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data fasilitas gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data fasilitas tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function drag_fasilitas($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('fasilitas',['id_fasilitas' => $id]);
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
                $data['alert']['message'] = 'Data fasilitas tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data fasilitas belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_fasilitas'] = $value;
                $set[$num]['status'] = 'N';
            }
            $block = $this->action_m->update_batch('fasilitas', $set, 'id_fasilitas');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah fasilitas';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/fasilitas #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah fasilitas';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_fasilitas'] = $value;
                $set[$num]['status'] = 'Y';
            }
            $block = $this->action_m->update_batch('fasilitas', $set, 'id_fasilitas');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah fasilitas';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/fasilitas #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah fasilitas';;
            }
        } elseif ($action == 'deleted') {
            
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }

            foreach ($cek as $key) {
                if ($key->icon) {
                    unlink('./data/fasilitas/'.$key->icon);
                }
                
            }
            $set['id_fasilitas'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('fasilitas', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah fasilitas';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/fasilitas #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah fasilitas';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }





    // WISATA
    public function tambah_wisata()
    {
        // VARIABEL
        $arrVar['nama']                 = 'Nama wisata';
        $arrVar['alamat']                 = 'Alamat wisata';
         $arrVar['tiket']                 = 'Kategori tiket';
         $arrVar['fasilitas']                 = 'Fasilitas';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (in_array($var,['tiket','fasilitas'])) {
                if (!$$var[0]) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                    $arrAccess[] = false;
                }
            }else{
                if (!$$var) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                    $arrAccess[] = false;
                } else {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
           
        }
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');
        // var_dump($tiket);die;
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/wisata/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
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
                $data['alert']['message'] = 'Gambar tidak boleh kosong!';
                echo json_encode($data);
                exit;
            }
            $post['wisata.create_by'] = $this->id_user;
            
            $insert = $this->action_m->insert('wisata', $post);
            if ($insert) {
                if (count($tiket) > 0) {
                    $no = 0;
                    $set = [];
                    foreach ($tiket as $value) {
                        $num = $no++;
                        $set[$num]['id_tiket'] = $value;
                        $set[$num]['id_wisata'] = $insert;
                    }
                    $this->action_m->insert_batch('wisata_tiket',$set);
                }

                if (count($fasilitas) > 0) {
                    $no = 0;
                    $set = [];
                    foreach ($fasilitas as $value) {
                        $num = $no++;
                        $set[$num]['id_fasilitas'] = $value;
                        $set[$num]['id_wisata'] = $insert;
                    }
                    $this->action_m->insert_batch('wisata_fasilitas',$set);
                }
               
                $data['status'] = true;
                $data['alert']['message'] = 'Data wisata berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/unit #reload_table');
                $data['modal']['id'] = '#kt_modal_wisata';
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

    public function ubah_wisata()
    {
        // VARIABEL
        $arrVar['id_wisata']                 = 'ID wisata';
        $arrVar['nama']                 = 'Nama wisata';
        $arrVar['alamat']                 = 'Alamat wisata';
         $arrVar['tiket']                 = 'Kategori tiket';
         $arrVar['fasilitas']                 = 'Fasilitas';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (in_array($var,['tiket','fasilitas'])) {
                if (!$$var[0]) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                    $arrAccess[] = false;
                }
            }else{
                if (!$$var) {
                    $data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
                    $arrAccess[] = false;
                } else {
                    $post[$var] = trim($$var);
                    $arrAccess[] = true;
                }
            }
           
        }
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');

        $result = $this->action_m->get_single('wisata', ['id_wisata' => $id_wisata]);
        $nama_gambar = $this->input->post('nama_gambar');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/wisata/';
                $config['upload_path'] = $tujuan;
                $config['allowed_types'] = 'png|PNG|jpg|JPG|jpeg|JPEG';
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
            }else{
                if (!$nama_gambar) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Gambar tidak boleh kosong!';
                    echo json_encode($data);
                    exit;
                }
                
            }
            $update = $this->action_m->update('wisata', $post, ['id_wisata' => $id_wisata]);
            if ($update) {
                $delete_t = $this->action_m->delete('wisata_tiket',['id_wisata' => $id_wisata]);
                $delete_f = $this->action_m->delete('wisata_fasilitas',['id_wisata' => $id_wisata]);
                if ($delete_t) {
                    if (count($tiket) > 0) {
                        $no = 0;
                        $set = [];
                        foreach ($tiket as $value) {
                            $num = $no++;
                            $set[$num]['id_tiket'] = $value;
                            $set[$num]['id_wisata'] = $result->id_wisata;
                        }
                        $this->action_m->insert_batch('wisata_tiket',$set);
                    }
                }

                if ($delete_f) {
                    if (count($fasilitas) > 0) {
                        $no = 0;
                        $set = [];
                        foreach ($fasilitas as $value) {
                            $num = $no++;
                            $set[$num]['id_fasilitas'] = $value;
                            $set[$num]['id_wisata'] = $result->id_wisata;
                        }
                        $this->action_m->insert_batch('wisata_fasilitas',$set);
                    }
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Data wisata berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/unit #reload_table');
                $data['modal']['id'] = '#kt_modal_wisata';
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

    public function hapus_wisata()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('wisata',['id_wisata' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('wisata',['id_wisata' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data wisata berhasil dihapus';
                unlink('./data/wisata/'.$res->icon);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data wisata gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data wisata tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

    public function drag_wisata($action = 'deleted')
    {
        $id = $this->input->post('id_batch');
        $cek = $this->action_m->get_all('wisata',['id_wisata' => $id]);
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
                $data['alert']['message'] = 'Data wisata tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        if (!$id) {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data wisata belum terkait';
            echo json_encode($data);
            exit;
        }
        if ($action == 'block') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_wisata'] = $value;
                $set[$num]['status'] = 'N';
            }
            $block = $this->action_m->update_batch('wisata', $set, 'id_wisata');
            if ($block) {
                
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan block pada sejumlah wisata';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/unit #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal melakukan block pada sejumlah wisata';;
            }
        } elseif ($action == 'unblock') {
            $no = 0;
            $set = [];
            foreach ($id as $value) {
                $num = $no++;
                $set[$num]['id_wisata'] = $value;
                $set[$num]['status'] = 'Y';
            }
            $block = $this->action_m->update_batch('wisata', $set, 'id_wisata');
            if ($block) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil membuka block pada sejumlah wisata';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/unit #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal membuka block pada sejumlah wisata';;
            }
        } elseif ($action == 'deleted') {
            
            $ed = [];
            foreach ($id as $value) {
                $ed[] = $value;
            }

            foreach ($cek as $key) {
                if ($key->icon) {
                    unlink('./data/wisata/'.$key->icon);
                }
                
            }
            $set['id_wisata'] = $ed;
            
            
            $delete = $this->action_m->delete_batch('wisata', $set);
            if ($delete) {
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil menghapus sejumlah wisata';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('wisata/unit #reload_table');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menghapus sejumlah wisata';
            }
        } else {
            $data['status'] = 500;
            $data['alert']['message'] = 'Data aksi belum terkait';
        }
        echo json_encode($data);
        exit;
    }




}
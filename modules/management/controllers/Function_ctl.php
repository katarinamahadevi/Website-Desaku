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

    // BANNER
    public function tambah_banner()
    {
        // VARIABEL
        $arrVar['title']                 = 'Judul banner';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');
        // var_dump($tiket);die;
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/banner/';
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
            
            $insert = $this->action_m->insert('banner', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data banner berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/banner #reload_table');
                $data['modal']['id'] = '#kt_modal_banner';
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

    public function ubah_banner()
    {
        // VARIABEL
        $arrVar['id_banner']                 = 'ID banner';
        $arrVar['title']                 = 'Judul banner';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');

        $result = $this->action_m->get_single('banner', ['id_banner' => $id_banner]);
        $nama_gambar = $this->input->post('nama_gambar');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/banner/';
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
            $update = $this->action_m->update('banner', $post, ['id_banner' => $id_banner]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data banner berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/banner #reload_table');
                $data['modal']['id'] = '#kt_modal_banner';
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

    public function hapus_banner()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('banner',['id_banner' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('banner',['id_banner' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data banner berhasil dihapus';
                unlink('./data/banner/'.$res->gambar);
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





    // AGENDA
    public function tambah_agenda()
    {
        // VARIABEL
        $arrVar['title']                 = 'Judul agenda';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');
        $post['create_by'] = $this->id_user;
        // var_dump($tiket);die;
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/agenda/';
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
            
            $insert = $this->action_m->insert('agenda', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data agenda berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/agenda #reload_table');
                $data['modal']['id'] = '#kt_modal_agenda';
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

    public function ubah_agenda()
    {
        // VARIABEL
        $arrVar['id_agenda']                 = 'ID agenda';
        $arrVar['title']                 = 'Judul agenda';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');

        $result = $this->action_m->get_single('agenda', ['id_agenda' => $id_agenda]);
        $nama_gambar = $this->input->post('nama_gambar');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/agenda/';
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
            $update = $this->action_m->update('agenda', $post, ['id_agenda' => $id_agenda]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data agenda berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/agenda #reload_table');
                $data['modal']['id'] = '#kt_modal_agenda';
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

    public function hapus_agenda()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('agenda',['id_agenda' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('agenda',['id_agenda' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data agenda berhasil dihapus';
                unlink('./data/agenda/'.$res->gambar);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data agenda gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data agenda tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }




    // BERITA
    public function tambah_berita()
    {
        // VARIABEL
        $arrVar['title']                 = 'Judul berita';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');
        $post['create_by'] = $this->id_user;
        // var_dump($tiket);die;
        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/berita/';
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
            
            $insert = $this->action_m->insert('berita', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data berita berhasil di tambahkan!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/berita #reload_table');
                $data['modal']['id'] = '#kt_modal_berita';
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

    public function ubah_berita()
    {
        // VARIABEL
        $arrVar['id_berita']                 = 'ID berita';
        $arrVar['title']                 = 'Judul berita';

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
        $deskripsi = $post['deskripsi'] = $this->input->post('deskripsi');

        $result = $this->action_m->get_single('berita', ['id_berita' => $id_berita]);
        $nama_gambar = $this->input->post('nama_gambar');

        if (!in_array(false, $arrAccess)) {
            if (!empty($_FILES['gambar']['tmp_name'])) {
                $gambar = $_FILES['gambar'];
                $tujuan = './data/berita/';
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
            $update = $this->action_m->update('berita', $post, ['id_berita' => $id_berita]);
            if ($update) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data berita berhasil di rubah!';
                $data['load'][0]['parent'] = '#base_table';
                $data['load'][0]['reload'] = base_url('management/berita #reload_table');
                $data['modal']['id'] = '#kt_modal_berita';
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

    public function hapus_berita()
    {
        $id = $this->input->post('id');
        $res = $this->action_m->get_single('berita',['id_berita' => $id]);
        if ($res) {
            $hapus = $this->action_m->delete('berita',['id_berita' => $id]);
            if ($hapus) {
                $data['status'] = 200;
                $data['alert']['icon'] = 'success';
                $data['alert']['message'] = 'Data berita berhasil dihapus';
                unlink('./data/berita/'.$res->gambar);
            } else {
                $data['status'] = 500;
                $data['alert']['icon'] = 'warning';
                $data['alert']['message'] = 'Data berita gagal dihapus! Coba lagi nanti atau laporkan';
            }
        }else{
            $data['status'] = 500;
            $data['alert']['icon'] = 'warning';
            $data['alert']['message'] = 'Data berita tidak ditemukan';
        }
        

        echo json_encode($data);
        exit;
    }

}
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
        $arrVar['notelp']            = 'Nomor telepon';

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

        $result = $this->action_m->get_single('user', ['id_user' => $id_user]);
        if (!$result) {
            redirect('logout');
        }
        if (!in_array(false, $arrAccess)) {
            $update = $this->action_m->update('user', $post, ['id_user' => $id_user]);
            
            if ($update) {
                $arrSession[PREFIX_SESSION.'_nama'] = $nama;
                $arrSession[PREFIX_SESSION.'_notelp'] = $notelp;

                $this->session->set_userdata($arrSession);

                $data['status'] = true;
                $data['alert']['message'] = 'Biodata berhasil di rubah!';
                $data['modal']['id'] = '#modalProfil';
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
    public function ubah_sandi()
    {
        // VARIABEL
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
                if (!in_array($var,['password','repassword','new_password'])) {
                    $post[$var] = trim($$var);
                }
                $arrAccess[] = true;
            }
        }
        $id_user = $this->id_user;

        $result = $this->action_m->get_single('user', ['id_user' => $id_user]);
        if (!$result) {
            redirect('logout');
        }
        if (!in_array(false, $arrAccess)) {
            if (hash_my_password($result->email.$password) == $result->password) {
                if ($new_password != $repassword) {
                    $data['status'] = false;
                    $data['alert']['message'] = 'Konfirmasi kata sandi tidak sesuai!';
                    echo json_encode($data);
                    exit;
                } else {
                    $post['password'] = hash_my_password($result->email . $new_password);
                    
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
                $data['alert']['message'] = 'Kata sandi berhasil di rubah!';
                $data['modal']['id'] = '#modalPassword';
                $data['modal']['action'] = 'hide';
                $data['input']['id'] = '#form_ubah_sandi';
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

    public function pesiapan_order()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('wisata', ['id_wisata' => $id]);
        $params['arrjoin']['tiket']['statement'] = 'wisata_tiket.id_tiket = tiket.id_tiket';
        $params['arrjoin']['tiket']['type'] = 'LEFT';
        $tiket = $this->action_m->get_where_params('wisata_tiket',['id_wisata' => $id],'wisata_tiket.*,tiket.nama AS tiket,tiket.harga',$params);
        $data['result'] = $result;
        $data['tiket'] = $tiket;

        $this->load->view('modal/order',$data);
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


    public function transaksi()
    {
        $nama = $this->input->post('pengunjung');
        $id_tiket = $this->input->post('id_tiket');
        $id_wisata = $this->input->post('id_wisata');
        $total_harga = $this->input->post('total_harga');
        if ($nama != NULL && $id_tiket != NULL) {
            if (count($nama) <= 0 || count($id_tiket) <= 0) {
                $data['status'] = false;
                $data['alert']['message'] = 'Isi formulir pengunjung terlebih dahulu';
                echo json_encode($data);
                exit;
                
            }
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Isi formulir pengunjung terlebih dahulu';
            echo json_encode($data);
            exit;
        }

        $post1['id_user'] = $this->id_user;
        $post1['id_wisata'] = $id_wisata;
        $post1['total'] = $total_harga;

        $user = $this->action_m->get_single('user',['id_user' => $this->id_user]);
        $in = $this->action_m->insert('transaksi',$post1);
        if ($in) {
            $no = 0;
            foreach ($nama as $value) {
                $num = $no++;
                $post2[$num]['id_transaksi'] = $in;
                $post2[$num]['nama'] = $value;
                $post2[$num]['id_tiket'] = $id_tiket[$num];
            }
            
            $in2 = $this->action_m->insert_batch('transaksi_detail',$post2);
            if ($in2) {
                $message = '<div>
                    <h1>Anda harus melakukan pembayaran sebesar '.price_format($total_harga,1).'</h1></br>
                    <a href="'.base_url('pembayaran/upload?id_transaksi='.$in).'" class="">Tekan tombol berikut untuk menuju halaman pembayaran</a>
                </div>';
                $mail = sendmail('admin@gmail.com',$user->email,'Link Pembayaran',$message);
                if ($mail == true) {
                    $msg = 'cek email anda (cek folder spam jika tidak masuk)';
                }else{
                    $msg = 'Email tidak terkirim karena gangguan';
                }
                $data['status'] = true;
                $data['alert']['message'] = 'Tiket berhasil di tambahkan '.$msg;
                $data['modal']['id'] = '#modalOrder';
                $data['modal']['action'] = 'hide';
                $data['input']['all'] = true;
                echo json_encode($data);
                exit;
            }else{
                $data['status'] = false;
                $data['alert']['message'] = 'Berhasil insert transaksi namun gagal insert detail';
                echo json_encode($data);
                exit;   
            }
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Gagal menambahkan tiket! Coba lagi nanti atau hubungi developer';
            echo json_encode($data);
            exit;
        }
    
    }


    public function set_fav()
    {
        $id_wisata = $this->input->post('id');
        $action = $this->input->post('action');

        if ($action == 'Y') {
            $in['id_wisata'] = $id_wisata;
            $s = $this->action_m->insert('favorit',$in);
        }else{
            $s = $this->action_m->delete('favorit',['id_wisata' => $id_wisata]);
        }

        if ($s) {
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }
    }

    public function upload_bukti_bayar()
    {
        
        $id_transaksi = $this->input->post('id_transaksi');
        $cek = $this->action_m->get_single('transaksi',['id_transaksi' => $id_transaksi,'status' => 0]);
        if (!$cek) {
            redirect('beranda');
        }
        if (!$id_transaksi) {
            $data['status'] = false;
            $data['alert']['message'] = 'ID Transaksi tidak boleh kosong';
            echo json_encode($data);
            exit;
        }
        if (!empty($_FILES['bukti_bayar']['tmp_name'])) {
            $bukti_bayar = $_FILES['bukti_bayar'];
            $tujuan = './data/bukti/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|jpg|jpeg|PNG|JPG|JPEG';
            $config['file_name'] = uniqid();
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $data_produk = [];

            if (!$this->upload->do_upload('bukti_bayar')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $data_produk = array('upload_data' => $this->upload->data());
                $post['bukti_bayar'] = $data_produk['upload_data']['file_name'];
            }
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Bukti bayar tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }
        $post['payment_date'] = date('Y-m-d H:i:s');
        $post['status'] = 1;

        $update = $this->action_m->update('transaksi',$post,['id_transaksi' => $id_transaksi]);
        if ($update) {
            $data['status'] = true;
            $data['alert']['message'] = 'Bukti bayar berhasil di kirimkan!';
            $data['redirect'] = base_url('beranda');
        } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Bukti bayar gagal di kirimkan! Coba lagi atau tunggu beberapa saat';
        }
        echo json_encode($data);
        exit;
    }
}


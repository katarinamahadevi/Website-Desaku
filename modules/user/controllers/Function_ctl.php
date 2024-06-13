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
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
        $this->nama = $this->session->userdata('hpalnickel_nama');
        $this->foto = $this->session->userdata('hpalnickel_foto');
        
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
                $arrSession['hpalnickel_nama'] = $nama;

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
                    $arrSession['hpalnickel_foto'] = $data_foto['upload_data']['file_name'];

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

    // FUNGSI REKENING USER

    public function tambah_user_rekening($page = ''){
        // VARIABEL
        $arrVar['id_bank']             = 'Bank';
        $arrVar['nama']                = 'Nama rekening';
        $arrVar['nomor']               = 'Nomor rekening';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_rekening_'.$page.'_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }
        $post['id_user'] = $this->id_user;
        if (!in_array(false, $arrAccess)) {
            $insert = $this->action_m->insert('rekening', $post);
            if ($insert) {
                $data['status'] = true;
                $data['alert']['message'] = 'Data rekening berhasil di tambahkan!';
                if ($page == 'profil') {
                     $data['load'][0]['parent'] = '#form_withdraw';
                    $data['load'][0]['reload'] = base_url('home #reload_wd');
                    $data['input']['id'] = '#form_tambah_rekening_wd';
                }
                
                $data['input']['all'] = true;
                // $data['nonPushURL'] = true;
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

    public function upload_bukti_bayar()
    {
        
        $id_transaksi = $this->input->post('id_transaksi');
        if (!$id_transaksi) {
            $data['status'] = false;
            $data['alert']['message'] = 'ID Transaksi tidak boleh kosong';
            echo json_encode($data);
            exit;
        }
        if (!empty($_FILES['bukti_bayar']['tmp_name'])) {
            $bukti_bayar = $_FILES['bukti_bayar'];
            $tujuan = './data/bukti_bayar/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|jpg|jpeg';
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
        $post['tanggal_bayar'] = date('Y-m-d H:i:s');
        $post['status'] = 2;

        $update = $this->action_m->update('transaksi',$post,['id_transaksi' => $id_transaksi]);
        if ($update) {
            $data['status'] = true;
            $data['alert']['message'] = 'Bukti bayar berhasil di kirimkan!';
            $data['load'][1]['parent'] = '#base_convert_page';
            $data['load'][1]['reload'] = base_url('convert #reload_convert_page');
            $data['canvas'][0]['id'] = '#offcanvasDetailConvert';
            $data['canvas'][0]['action'] = 'hide';
            $data['redirect'] = base_url('convert');
            $data['nonPushURL'] = true;
        } else {
            $data['status'] = false;
            $data['alert']['message'] = 'Bukti bayar gagal di kirimkan! Coba lagi atau tunggu beberapa saat';
        }
        echo json_encode($data);
        exit;
    }


    public function auth_transaksi()
    {
        // VARIABEL
        $arrVar['password_payment']        = 'Kata sandi';
        $arrVar['id_investasi']            = 'ID Investasi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_transaksi_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        if (!in_array(FALSE, $arrAccess)) {
            $in = $this->action_m->get_single('investasi', ['id_investasi' => $id_investasi]);
            $result = $this->action_m->get_single('user', ['id_user' => $this->id_user]);
            if ($result) {
                $data['input']['id'] = '#form_transaksi_sandi';
                $data['input']['all'] = true;
                if ($result->saldo < $in->min_investasi) {
                    $data['canvas'][0]['id'] = '#canvasTransaksiSandi';
                    $data['canvas'][0]['action'] = 'hide';
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Saldo tidak mencukupi untuk melanjutkan investasi!</br><b>Saldo anda : '.price_format($result->saldo,2).'</b>';
                    echo json_encode($data);
                    exit;
                }
                if ($result->password_payment == hash_my_password($result->notelp . $password_payment)) {
                    $data['status'] = 200;       
                    $data['canvas'][0]['id'] = '#canvasTransaksiSandi';
                    $data['canvas'][0]['action'] = 'hide';
                    $data['canvas'][1]['id'] = '#canvasTransaksi';
                    $data['canvas'][1]['action'] = 'show';
                } else {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Kata sandi salah! Silahkan cek atau coba lagi.';
                }
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'User tidak terdaftar! Silahkan cek atau coba lagi.';
                $data['redirect'] = base_url('logout');
            }
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
        
        
    }

    public function proses_investasi()
    {
        // VARIABEL
        $arrVar['modal_investasi']        = 'Nominal investasi';
        $arrVar['id_investasi']            = 'ID Investasi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_transaksi_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        $post['id_user'] = $this->id_user;

        if (!in_array(FALSE, $arrAccess)) {
            $in = $this->action_m->get_single('investasi', ['id_investasi' => $id_investasi]);
            $result = $this->action_m->get_single('user', ['id_user' => $this->id_user]);

            if (!$in || !$result) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Transksi tidak valid';
                echo json_encode($data);
                exit;
            }
            if ($result->saldo < $in->min_investasi) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Saldo tidak mencukupi untuk melanjutkan investasi!</br><b>Saldo anda : '.price_format($result->saldo,2).'</b>';
                echo json_encode($data);
                exit;
            }
            if ($modal_investasi < $in->min_investasi) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Nominal minimal investasi sebesar <b>'.price_format($in->min_investasi,2).'</b>';
                echo json_encode($data);
                exit;
            }
            if ($modal_investasi > $result->saldo) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Nominal investasi terlalu besar!</br><b>Saldo anda : '.price_format($result->saldo,2).'</b>';
                echo json_encode($data);
                exit;
            }
            $post['profit'] = $in->profit;
            $post['keuntungan'] = (($modal_investasi * $in->profit) / 100);
            $post['durasi'] = $in->durasi;
            $post['start_date'] = $sdate =  date('Y-m-d').' '.$in->waktu;
            $post['end_date'] = date('Y-m-d H:i:s',strtotime("+".$in->durasi." minutes",strtotime($sdate)));
            $insert = $this->action_m->insert('investasi_member',$post);
            if ($insert) {
                $set['saldo'] = ($result->saldo - $modal_investasi);
                $update = $this->action_m->update('user',$set,['id_user' => $this->id_user]);
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan investasi pada proyek</br><span class="text-success">'.$in->nama.'</span>';
                $data['page_to']['page'] = 'profil';
                $data['page_to']['active'] = true;
                $data['canvas'][0]['id'] = '#canvasTransaksi';
                $data['canvas'][0]['action'] = 'hide';
                $data['load'][0]['parent'] = '#parent_profil';
                $data['load'][0]['reload'] = base_url('profil #reload_profil');
                $data['load'][1]['parent'] = '#parent_proyek_home';
                $data['load'][1]['reload'] = base_url('profil #reload_proyek_home');
                $data['load'][2]['parent'] = '#parent_proyek_investasi';
                $data['load'][2]['reload'] = base_url('profil #reload_proyek_investasi');
                $data['load'][3]['parent'] = '#parent_catatan_investasi';
                $data['load'][3]['reload'] = base_url('profil #reload_catatan_investasi');
            }else{
                $data['status'] = 200;
                $data['alert']['message'] = 'Berhasil melakukan investasi pada proyek</br><span class="text-success">'.$in->nama.'</span>';
            }
        }else{
            $data['status'] = false;
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function withdraw()
    {
        $nominal_penarikan = $post['nominal_penarikan'] = $this->input->post('nominal_penarikan');
        $id_rekening = $post['id_rekening'] = $this->input->post('id_rekening');
        $fee = $post['fee'] = $this->input->post('fee');

        $post['id_user'] = $this->id_user;
        $post['status'] = 0;
        if (!$nominal_penarikan) {
            $data['status'] = false;
            $data['alert']['message'] = 'Nominal penarikan tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }

        if (!$id_rekening) {
            $data['status'] = false;
            $data['alert']['message'] = 'Tujuan penarikan tidak boleh kosong!';
            echo json_encode($data);
            exit;
        }
        $kode_wd = 'WD'.date('H').'C'.date('is').base64url_encode($this->id_user);
        $post['kode_penarikan'] = $kode_wd;
        $user = $this->action_m->get_single('user',['id_user' => $this->id_user]);
        if ($nominal_penarikan > $user->saldo) {
             $data['status'] = false;
            $data['alert']['message'] = 'Saldo tidak mencukupi';
            echo json_encode($data);
            exit;
        }

        $sisa = $user->saldo - $nominal_penarikan;

        $post['penarikan_diterima'] = ($nominal_penarikan - $fee);

        $insert = $this->action_m->insert('penarikan',$post);
        
        if ($insert) {
            $set['saldo'] = $sisa; 
            $update = $this->action_m->update('user',$set,['id_user' => $this->id_user]);
            $data['status'] = true;
            $data['alert']['message'] = 'Penarikan berhasil diajukan! Saldo akan di potong sementara dan akan di kembalikan jika di tolak';
            
            $data['load'][0]['parent'] = '#parent_profile';
            $data['load'][0]['reload'] = base_url('profil #reload_profile');
            $data['load'][1]['parent'] = '#parent_penarikan';
            $data['load'][1]['reload'] = base_url('profil #reload_penarikan');

            $data['canvas'][0]['id'] = '#offcanvasTarik';
            $data['canvas'][0]['action'] = 'hide';
            
            
        }else{
            $data['status'] = false;
            $data['alert']['message'] = 'Gagal melakukan penarikan! Coba lagi atau tunggu beberapa saat';
        }

        echo json_encode($data);
        exit;
        
    }
}
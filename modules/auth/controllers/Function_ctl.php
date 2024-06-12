<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Auth
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

        if (in_array($this->uri->segment(2),['login','register','forgotpassword'])) {
            if ($this->id_user != '') {
                echo "Fungsi tidak dijalankan karena akses login";
            }
        }else{
            if ($this->id_user == '') {
                echo "Fungsi tidak di jalankan karena belum mendapat akses login";
            }
        }
        
    }
    public function register()
    {
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);

        // VARIABEL
        $arrVar['nama']            = 'Nama';
        $arrVar['notelp']          = 'Nomor telepon';
        $arrVar['password']        = 'Kata sandi';
        $arrVar['repassword']      = 'Konfirmasi kata sandi';
        if ($setting->kode_pendaftaran) {
            $arrVar['kode_pendaftaran'] = 'Kode pendaftaran';
        }
        

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_regis_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                if (!in_array($var,['repassword'])) {
                    $post[$var] = trim($$var);
                }
                $arrAccess[] = true;
            }
        }

        
        
        if (!in_array(FALSE, $arrAccess)) {
            if ($password != $repassword) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Konfirmasi kata sandi salah!';
                echo json_encode($data);
                exit;
            }

            if ($setting->kode_pendaftaran) {
                if ($kode_pendaftaran != $setting->kode_pendaftaran) {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Kode pendaftaran salah! Anda tidak di izinkan mendaftar';
                    echo json_encode($data);
                    exit;
                }
            }

            // CEK USER
            $result = $this->action_m->get_single('user', ['notelp' => $notelp]);
            if ($result) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Nomor telepon yang anda masukan sudah terdaftar!';
                echo json_encode($data);
                exit;
            }
            $arrInsert['nama'] = $nama;
            $arrInsert['notelp'] = $notelp;
            $arrInsert['password'] = hash_my_password($notelp . $password);
            $arrInsert['password_payment'] = hash_my_password($notelp . $password);
            $arrInsert['role'] = 3;
            $insert = $this->action_m->insert('user', $arrInsert);

            if ($insert) {
                $arrSession['hpalnickel_id_user'] = $insert;
                $arrSession['hpalnickel_nama'] = $nama;
                $arrSession['hpalnickel_notelp'] = $notelp;
                $arrSession['hpalnickel_id_role'] = 3;
                $arrSession['hpalnickel_foto'] = '';
                $arrSession['hpalnickel_role'] = get_role(3);


                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['alert']['message'] = 'Anda berhasil mendaftar! Selamat datang';
                $data['redirect'] = base_url('home');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menambah data! silahkan cek data atau coba lagi nanti';
            }
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
        
    }


    //  FUNCTION 
    public function login()
    {
        // VARIABEL=
        $arrVar['notelp']          = 'Nomor telepon';
        $arrVar['password']        = 'Kata sandi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $$var = $this->input->post($var);
            if (!$$var) {
                $data['required'][] = ['req_login_' . $var, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                $post[$var] = trim($$var);
                $arrAccess[] = true;
            }
        }

        if (!in_array(FALSE, $arrAccess)) {
            $result = $this->action_m->get_single('user', ['notelp' => $notelp]);
            if ($result) {
                if ($result->password == hash_my_password($notelp . $password)) {
                    if ($result->blocked == 'Y') {
                        $reason = '';
                        if ($result->block_reason != '') {
                            $reason .= ' dengan alasan <b>'.$result->block_reason.'</b>';
                        }
                        $data['status'] = 500;
                        $data['alert']['message'] = '<b>'.$result->nama.'</b> kamu dilarang masuk ke dalam sistem'.$reason;
                    }else{
                        $arrSession['hpalnickel_id_user'] = $result->id_user;
                        $arrSession['hpalnickel_nama'] = $result->nama;
                        $arrSession['hpalnickel_id_role'] = $result->role;
                        $arrSession['hpalnickel_notelp'] = $result->notelp;
                        $arrSession['hpalnickel_foto'] = $result->foto;
                        $arrSession['hpalnickel_role'] = get_role($result->role);

                        $this->session->set_userdata($arrSession);

                        $data['status'] = 200;
                        $data['alert']['message'] = 'Data sesuai! Selamat datang ' . get_role($result->role) . ' ' . $result->nama;
                        if ($result->role < 3) {
                            $r = 'dashboard';
                        }else{
                            $r = 'home';
                        }
                        $data['redirect'] = base_url($r);
                    }
                    
                } else {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Kata sandi salah! Silahkan cek dan coba lagi.';
                }
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Nomor telpon tidak terdaftar! Silahkan cek dan coba lagi.';
            }
        }
        sleep(1.5);
        echo json_encode($data);
        exit;
        
        
    }


    public function logout()
    {
        $this->session->unset_userdata('hpalnickel_id_user');
        $this->session->unset_userdata('hpalnickel_nama');
        $this->session->unset_userdata('hpalnickel_id_role');
        $this->session->unset_userdata('hpalnickel_role');
        $this->session->unset_userdata('hpalnickel_notelp');
        $this->session->unset_userdata('hpalnickel_email');

        redirect('landing');
    }
    
}
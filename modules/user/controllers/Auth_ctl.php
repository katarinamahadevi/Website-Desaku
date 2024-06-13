<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_ctl extends MY_User
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

    // FUNGSI AUTH
    public function register()
    {
        // VARIABEL
        $arrVar['nama']            = 'Nama';
        $arrVar['email']           = 'Alamat email';
        $arrVar['notelp']          = 'Nomor telepon';
        $arrVar['password']        = 'Kata sandi';
        $arrVar['repassword']      = 'Konfirmasi kata sandi';

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

        $email      = strtolower($email);
        $alamat = $this->input->post('alamat');
        // PERIKSA URL
        if (!$_POST) {
            $data['status'] = false;
            $data['alert']['message'] = 'Tidak ada data terdeteksi!';
            echo json_encode($data);
            exit;
        }
        if (!in_array(FALSE, $arrAccess)) {
            if (!validasi_email($email)) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            if ($password != $repassword) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Konfirmasi kata sandi salah!';
                echo json_encode($data);
                exit;
            }

            // CEK USER
            $result = $this->action_m->get_single('user', ['email' => $email]);
            if ($result) {
                $data['status'] = 500;
                $data['alert']['message'] = 'Email yang anda masukan sudah terdaftar!';
                echo json_encode($data);
                exit;
            }
            $arrInsert['email'] = $email;
            $arrInsert['nama'] = $nama;
            $arrInsert['notelp'] = $notelp;
            $arrInsert['alamat'] = $alamat;
            $arrInsert['password'] = hash_my_password($email . $password);
            $arrInsert['role'] = 3;
            $arrInsert['foto'] = '';
            $insert = $this->action_m->insert('user', $arrInsert);

            if ($insert) {
                $arrSession[PREFIX_SESSION.'_id_user'] = $insert;
                $arrSession[PREFIX_SESSION.'_email'] = $email;
                $arrSession[PREFIX_SESSION.'_nama'] = $nama;
                $arrSession[PREFIX_SESSION.'_notelp'] = $notelp;
                $arrSession[PREFIX_SESSION.'_id_role'] = 3;
                $arrSession[PREFIX_SESSION.'_foto'] = '';
                $arrSession[PREFIX_SESSION.'_role'] = get_role(3);


                $this->session->set_userdata($arrSession);

                $data['status'] = 200;
                $data['alert']['message'] = 'Anda berhasil mendaftar! Selamat datang';
                $data['redirect'] = base_url('beranda');
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Gagal menambah data! silahkan cek data atau coba lagi nanti';
            }
            echo json_encode($data);
            exit;
        }else{
            sleep(1.5);
            echo json_encode($data);
            exit;
        }
        
    }


    public function login()
    {
        // VARIABEL=
        $arrVar['email_login']           = 'Alamat email';
        $arrVar['password_login']        = 'Kata sandi';

        // INFORMASI UMUM
        foreach ($arrVar as $var => $value) {
            $fix = explode('_', $var);
            $fix = $fix[0];
            $$fix = $this->input->post($var);
            if (!$$fix) {
                $data['required'][] = ['req_login_' . $fix, $value . ' tidak boleh kosong !'];
                $arrAccess[] = false;
            } else {
                
                $post[$fix] = trim($$fix);
                $arrAccess[] = true;
            }
        }

        $email = strtolower($email);
        if (!$_POST) {
            echo "Tidak ada input terdeteksi";
            redirect('beranda');
        }
        

        if (!in_array(FALSE, $arrAccess)) {
            if (!validasi_email($email)) {
                $data['status'] = 700;
                $data['alert']['message'] = 'Email tidak valid! Silahkan cek dan coba lagi.';
                echo json_encode($data);
                exit;
            }
            $result = $this->action_m->get_single('user', ['email' => $email]);
            if ($result) {
                if ($result->password == hash_my_password($email . $password)) {
                    if ($result->blocked == 'Y') {
                        $reason = '';
                        if ($result->block_reason != '') {
                            $reason .= ' dengan alasan <b>'.$result->block_reason.'</b>';
                        }
                        $data['status'] = 500;
                        $data['alert']['message'] = '<b>'.$result->nama.'</b> kamu dilarang masuk ke dalam sistem'.$reason;
                    }else{
                        $arrSession[PREFIX_SESSION.'_id_user'] = $result->id_user;
                        $arrSession[PREFIX_SESSION.'_nama'] = $result->nama;
                        $arrSession[PREFIX_SESSION.'_email'] = $result->email;
                        $arrSession[PREFIX_SESSION.'_id_role'] = $result->role;
                        $arrSession[PREFIX_SESSION.'_notelp'] = $result->notelp;
                        $arrSession[PREFIX_SESSION.'_foto'] = $result->foto;
                        $arrSession[PREFIX_SESSION.'_role'] = get_role($result->role);

                        $this->session->set_userdata($arrSession);

                        $data['status'] = 200;
                        $data['alert']['message'] = 'Data sesuai! Selamat datang ' . $result->nama;
                        if ($result->role < 3) {
                            $data['redirect'] = base_url('dashboard');
                        }else{
                            $data['redirect'] = base_url('beranda');
                        }
                        
                    }
                    
                } else {
                    $data['status'] = 500;
                    $data['alert']['message'] = 'Kata sandi salah! Silahkan cek dan coba lagi.';
                }
            } else {
                $data['status'] = 500;
                $data['alert']['message'] = 'Email tidak terdaftar! Silahkan cek dan coba lagi.';
            }
            sleep(1.5);
            echo json_encode($data);
            exit;
        }else{
            sleep(1.5);
            echo json_encode($data);
            exit;
        }
        
        
    }

    public function logout()
    {
        $this->session->unset_userdata(PREFIX_SESSION.'_id_user');
        $this->session->unset_userdata(PREFIX_SESSION.'_nama');
        $this->session->unset_userdata(PREFIX_SESSION.'_id_role');
        $this->session->unset_userdata(PREFIX_SESSION.'_role');
        $this->session->unset_userdata(PREFIX_SESSION.'_notelp');
        $this->session->unset_userdata(PREFIX_SESSION.'_email');

        redirect('beranda');
    }

}
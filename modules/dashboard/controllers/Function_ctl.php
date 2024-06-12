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
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
        $this->nama = $this->session->userdata('hpalnickel_nama');
    }

    public function ubah_status_penarikan()
    {
        $status = $this->input->post('status');
        $id_penarikan = $this->input->post('id_penarikan');
        $baru = $this->input->post('baru');
        $reason = $this->input->post('reason');
        
        $post['status'] = $baru;
        $post['approve_by'] = $this->id_user;
        $post['approval_date'] = date('Y-m-d H:i:s');
        $post['alasan'] = $reason;

        $cek_penarikan = $this->action_m->get_single('penarikan',['id_penarikan' => $id_penarikan]);
        $cek_user = $this->action_m->get_single('user',['id_user' => $cek_penarikan->id_user]);
        $update = $this->action_m->update('penarikan',$post,['id_penarikan' => $id_penarikan]);
        if ($update) {

            if ($baru == 2) {
                
                $saldo = $cek_user->saldo + $cek_penarikan->nominal_penarikan;
                $set['saldo'] = $saldo;
                $user = $this->action_m->update('user',$set,['id_user' => $cek_penarikan->id_user]);
            }
            $kata = 'Berhasil merubah status <b>"'.status_wd($status).'"</b> menjadi status <b>"'.status_wd($baru).'"</b>';


            $data['status'] = true;
            $data['message'] = $kata;
        }else{
            $kata = 'Gagal merubah status <b>"'.status_wd($status).'"</b> menjadi status <b>"'.status_wd($baru).'"</b>';

            $data['status'] = true;
            $data['message'] = $kata;
        }

        echo json_encode($data);
        exit;
    }


    public function upload_bukti_tf()
    {
        $id_penarikan = $this->input->post('id_penarikan');
        if (!empty($_FILES['bukti_tf']['tmp_name'])) {
            $bukti_tf = $_FILES['bukti_tf'];
            $tujuan = './data/bukti_tf/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = uniqid();
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $data_produk = [];

            if (!$this->upload->do_upload('bukti_tf')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $data_produk = array('upload_data' => $this->upload->data());
                $post['bukti_tf'] = $data_produk['upload_data']['file_name'];
                if ($nama_bukti_tf) {
                    unlink($tujuan.$nama_bukti_tf);
                }

                $this->action_m->update('penarikan',$post,['id_penarikan' => $id_penarikan]);
                $data['status'] = true;
                echo json_encode($data);
                exit;
            }
        }
    }


    public function topup()
    {
        // VARIABEL
        $arrVar['id_user']          = 'Member';
        $arrVar['nominal']          = 'Nominal';

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

        if (!empty($_FILES['bukti_tf']['tmp_name'])) {
            $bukti_tf = $_FILES['bukti_tf'];
            $tujuan = './data/bukti_tf/';
            $config['upload_path'] = $tujuan;
            $config['allowed_types'] = 'png|jpg|jpeg';
            $config['file_name'] = uniqid();
            $config['file_ext_tolower'] = true;

            $this->load->library('upload', $config);

            $data_tf = [];

            if (!$this->upload->do_upload('bukti_tf')) {

                $error = $this->upload->display_errors();
                $data['status'] = false;
                $data['alert']['message'] = $error;
                echo json_encode($data);
                exit;
            } else {
                $data_tf = array('upload_data' => $this->upload->data());
                $post['bukti_tf'] = $data_tf['upload_data']['file_name'];
            }
        }

        if (!in_array(FALSE,$arrAccess)) {
           $cek_user = $this->action_m->get_single('user',['id_user' => $id_user]);
            if (!$cek_user) {
                $data['status'] = false;
                $data['alert']['message'] = 'Data user tidak ditemukan';
                echo json_encode($data);
                exit;
            }
        
            $insert = $this->action_m->insert('topup',$post);
            if ($insert) {
                $set['saldo'] = ($cek_user->saldo + $nominal);
                $update = $this->action_m->update('user',$set,['id_user' => $id_user]);
                if ($update) {
                    $data['status'] = true;
                    $data['input']['all'] = true;
                    $data['alert']['message'] = 'Berhasil TopUp saldo sebesar <b>'.price_format($nominal,2).'</b> untuk member <b>'.$cek_user->nama.'</b>';
                    $data['load'][0]['parent'] = '#base_table';
                    $data['load'][0]['reload'] = base_url('dashboard #reload_table');
                }else{
                    $data['status'] = false;
                    $data['input']['all'] = true;
                    $data['alert']['message'] = 'Berhasil TopUp saldo sebesar <b>'.price_format($nominal,2).'</b> namun gagal update saldo untuk member <b>'.$cek_user->nama.'</b>';
                    
                }
            }else{
                $data['status'] = false;
                $data['alert']['message'] = 'Gagal TopUp saldo sebesar <b>'.price_format($nominal,2).'</b> untuk member <b>'.$cek_user->nama.'</b>';
            }
        }else{
            $data['status'] = false;
        }
        

        echo json_encode($data);
        exit;
    }


}
<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_role = '';
    var $id_user = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata(PREFIX_SESSION.'_id_role');
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
    }

    public function index()
    {
        // GLBL
        $this->data['title'] = 'Pantau Antrian Transaksi';

        // JS ADD
        $this->data['js_add'][] = '<script>var page = "dashboard";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/dashboard.js"></script>';

         // GET DATA
        $where = [];
        $params['arrjoin']['user']['statement'] = 'transaksi.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['wisata']['statement'] = 'transaksi.id_wisata = wisata.id_wisata';
        $params['arrjoin']['wisata']['type'] = 'LEFT';

        $select = 'transaksi.*,user.nama AS user,wisata.nama AS wisata';

        $result = $this->action_m->get_where_params('transaksi',$where,$select,$params);

        $no = 0;
        $status = 0;
        $arr = [];
        if ($result) {
            foreach ($result as $row) {
                if ($status != $row->status) {
                    $status = $row->status;
                    $no = 0;
                }
                $num = $no++;
                $arr[$row->status][$num]['id_transaksi'] = $row->id_transaksi;
                $arr[$row->status][$num]['id_user'] = $row->id_user;
                $arr[$row->status][$num]['id_wisata'] = $row->id_wisata;
                $arr[$row->status][$num]['user'] = $row->user;
                $arr[$row->status][$num]['wisata'] = $row->wisata;
                $arr[$row->status][$num]['total'] = $row->total;
                $arr[$row->status][$num]['bukti_bayar'] = $row->bukti_bayar;
                $arr[$row->status][$num]['create_date'] = $row->create_date;
                $arr[$row->status][$num]['payment_date'] = $row->payment_date;
            }
        }
        // MYDATA DEKLARASI
        $mydata['result'] = $arr;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }


     public function ubah_status_transaksi()
    {
        $status = $this->input->post('status');
        $id_transaksi = $this->input->post('id_transaksi');
        $baru = $this->input->post('baru');
        
        $post['status'] = $baru;
        if ($status == 0 ) {
            $post['payment_date'] = date('Y-m-d H:i:s');
        }
        
        $transaksi = $this->action_m->get_single('transaksi',['id_transaksi' => $id_transaksi]);
        $update = $this->action_m->update('transaksi',$post,['id_transaksi' => $id_transaksi]);
        $user = $this->action_m->get_single('user',['id_user' => $transaksi->id_user]);
        if ($update) {
            if ($status == 1) {
                $message = 'Tiket anda telah di approve admin';
                $mail = sendmail('admin@gmail.com',$user->email,'Konfirmasi pembayaran',$message);
            }
            $kata = 'Berhasil merubah status <b>"'.status_payment($status).'"</b> menjadi status <b>"'.status_payment($baru).'"</b>';
            $data['status'] = true;
            $data['message'] = $kata;
        }else{
            $kata = 'Gagal merubah status <b>"'.status_payment($status).'"</b> menjadi status <b>"'.status_payment($baru).'"</b>';

            $data['status'] = true;
            $data['message'] = $kata;
        }

        echo json_encode($data);
        exit;
    }
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Auth
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

    public function index()
    {
        redirect('pembayaran/upload');
    }
    
    public function upload()
    {
        $id_transaksi = $this->input->get('id_transaksi');

        $transaksi = $this->action_m->get_single('transaksi', ['id_transaksi' => $id_transaksi,'status' => 0]);
        if (!$transaksi) {
            redirect('beranda');
        }
        $params['arrjoin']['tiket']['statement'] = 'tiket.id_tiket = transaksi_detail.id_tiket';
        $params['arrjoin']['tiket']['type'] = 'LEFT';
        $detail = $this->action_m->get_where_params('transaksi_detail',['id_transaksi' => $id_transaksi],'transaksi_detail.*,tiket.nama AS tiket,tiket.harga AS harga',$params);
        
        $mydata['result'] = $transaksi;
        $mydata['detail'] = $detail;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }
}

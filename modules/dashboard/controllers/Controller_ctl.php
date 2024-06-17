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
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/transaksi.js"></script>';

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
                $arr[$status][$num]['id_transaksi'] = $row->id_transaksi;
                $arr[$status][$num]['id_user'] = $row->id_user;
                $arr[$status][$num]['id_wisata'] = $row->id_wisata;
                $arr[$status][$num]['user'] = $row->user;
                $arr[$status][$num]['wisata'] = $row->wisata;
                $arr[$status][$num]['total'] = $row->total;
                $arr[$status][$num]['bukti_bayar'] = $row->bukti_bayar;
                $arr[$status][$num]['create_date'] = $row->create_date;
                $arr[$status][$num]['payment_date'] = $row->payment_date;
            }
        }
        // MYDATA DEKLARASI
        $mydata['result'] = $arr;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

   
}

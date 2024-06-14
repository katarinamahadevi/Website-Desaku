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

        $no = 0;
        $status = 0;
        foreach (status_payment(99, [2,3,0]) as $num => $name) {
            $arr[$num] = [];
        }
        // MYDATA DEKLARASI
        $mydata['result'] = $arr;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

   
}

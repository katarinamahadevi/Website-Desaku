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
        $mydata = [];

         // LOAD JS
        $this->data['js_add'][] = '<script>var page = "dashboard"</script>';
        // $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/dashboard.js"></script>';

        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

   
}

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
        $this->data['js_add'][] = '<script>var page = "setting"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/setting/setting.js"></script>';

        // LOAD DATA
        $result = $this->action_m->get_single('setting',['id_setting' => 1]);
        // $banner = $this->action_m->get_all('banner');

        $mydata['result'] = $result;
        $mydata['banner'] = [];
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

    public function profil()
    {
        $mydata = [];

        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "profile"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/setting/profil.js"></script>';


        $result = $this->action_m->get_single('user',['id_user' => $this->id_user]);

        $mydata['result'] = $result;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('profil', $mydata, TRUE);
        $this->display();
    }
   
}

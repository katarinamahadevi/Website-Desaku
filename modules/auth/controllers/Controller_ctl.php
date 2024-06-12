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
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
        $this->nama = $this->session->userdata('hpalnickel_nama');

        if ($this->id_user != '') {
            if ($this->id_role > 2) {
                redirect('home');
            }elseif(in_array($this->id_role,[1,2])){
                redirect('dashboard');
            }else{
                redirect('logout');
            }
            
        }  
        
    }

    public function index()
    {
        redirect('landing');
    }

    public function base($page = 'landing')
    {
        // GLOBAL VARIABEL
        $this->data['title'] = $mydata['title'] =  ucfirst($page);
        $this->data['page'] = $page;

        $mydata['page'] = $page;
        $mydata['allpage'] = ['landing','login','register'];
        $mydata['form_number'] = ['',0,1];
        
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);

        $mydata['data']['setting'] = $setting;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('base', $mydata, TRUE);
        $this->display();
    }


}

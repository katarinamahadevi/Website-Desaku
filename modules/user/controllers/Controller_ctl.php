<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_User
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
        redirect('beranda');
    }
    
    public function beranda()
    {
        $mydata = [];

        $this->data['title'] = $mydata['title'] =  'Selamat datang di Desaku';
        
        // LOAD VIEW
        $this->data['content'] = $this->load->view('beranda', $mydata, TRUE);
        $this->display();
    }

    public function favorit()
    {
        $mydata = [];

        $this->data['title'] = $mydata['title'] =  'Selamat datang di Desaku';
        
        // LOAD VIEW
        $this->data['content'] = $this->load->view('favorit', $mydata, TRUE);
        $this->display();
    }
}

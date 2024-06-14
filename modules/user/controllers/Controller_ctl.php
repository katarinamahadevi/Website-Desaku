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

        // SETUP DATA
        $where['wisata.status'] = 'Y';
        $params['arrjoin']['wisata_tiket']['statement'] = 'wisata.id_wisata = wisata_tiket.id_wisata';
        $params['arrjoin']['wisata_tiket']['type'] = 'LEFT';
        $params['arrjoin']['tiket']['statement'] = 'wisata_tiket.id_tiket = tiket.id_tiket';
        $params['arrjoin']['tiket']['type'] = 'LEFT';
        $params['groupby'] = 'wisata.id_wisata';
        $select = "wisata.*,GROUP_CONCAT(tiket.nama SEPARATOR ',') AS tiket";
        
        $wisata = $this->action_m->get_where_params('wisata', $where, $select, $params);

         $params2['arrjoin']['jabatan']['statement'] = 'pengurus.id_jabatan = jabatan.id_jabatan';
        $params2['arrjoin']['jabatan']['type'] = 'LEFT';
         $pengurus = $this->action_m->get_where_params('pengurus', ['pengurus.status' => 'Y'], 'pengurus.*,jabatan.nama AS jabatan', $params2);


        // CETAK DATA
        $mydata['wisata'] = $wisata;
        $mydata['pengurus'] = $pengurus;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('beranda', $mydata, TRUE);
        $this->display();
    }
}

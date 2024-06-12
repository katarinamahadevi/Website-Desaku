<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_User
{
    var $id_role = '';
    var $id_user = '';
    var $nama = '';
    var $mainpage = [];
    var $allpage = [];
    var $subpage = [];
    var $form_numbar = [];
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata(PREFIX_SESSION.'_id_role');
        $this->id_user = $this->session->userdata(PREFIX_SESSION.'_id_user');
        $this->nama = $this->session->userdata(PREFIX_SESSION.'_nama');

        $this->mainpage = ['home'];
        $this->allpage = ['home'];
        $this->subpage = [];
        $this->form_number = [''];
    }

    public function index()
    {
        redirect('home');
    }
    // SINGLE PAGE APLICATION
    public function base($page = 'home')
    {
        // GLOBAL VARIABEL
        $max_params = 3;
        $params = [];
        $params1 = [];
        $params2 = [];
        $arr = [];
        $no = 1;
        $mydata = [];
        for ($m=1; $m <= $max_params ; $m++) { 
            $v = 'web_params'.$m;
            $$v = '';
            $mydata[$v] = $$v;
        }
        foreach (get_arr_uri() as $value) {
            if ($value != $page) {
                $num = $no++;
                $v = 'web_params'.$num;
                $$v = $value;
                $mydata[$v] = $$v;
                $arr[] = $value;
            }
        }

        $this->data['title'] = $mydata['title'] =  ucwords(page_to_title($page,$arr));
        $this->data['page'] = $page;
        
        
        // LOAD VIEW
        $this->data['content'] = $this->load->view('base', $mydata, TRUE);
        $this->display();
    }


    public function get_display_page($page)
    {
        $data['noshell'] = true;
        
        $ins = $this->input->post('ins');
        if ($ins) {
            for ($i=0; $i < count($ins); $i++) { 
                $p = 'web_params'.($i+1);
                $$p = $ins[$i];
            }
        }
        $pg = explode('-',$page);

        if (count($pg) > 1) {
           $page = $pg[0].'/'.$pg[1];
        }
        $data['setting'] = $this->action_m->get_single('setting',['id_setting' => 1]);
        // var_dump($page);die;
        
        if ($page == 'transaksi' || $page == 'catatan/detail_investasi') {
            $params2['arrjoin']['investasi_member']['statement'] = 'investasi_member.id_investasi = investasi.id_investasi';
            $params2['arrjoin']['investasi_member']['type'] = 'LEFT';
            $params2['arrorderby']['kolom'] = 'live';
            $params2['arrorderby']['order'] = 'DESC';
            $params2['groupby'] = 'investasi.id_investasi';
            $select2 = "investasi.*,SUM(modal_investasi) AS modal, SUM(keuntungan) AS keuntungan,(SELECT SUBSTR(MAX(CONCAT(LPAD(investasi_member.id_investasi,50,' '),live)),51) AS LIVE FROM investasi_member WHERE investasi.id_investasi = investasi_member.id_investasi GROUP BY investasi_member.id_investasi ORDER BY live DESC) AS live";
            $single_proyek = [];
            if (!isset($web_params1)) {
                redirect('home');
            }
            
            $id_inves = [];
            $id_inv = $web_params1;
            if ($page == 'catatan/detail_investasi') {
                $params3['arrjoin']['investasi']['statement'] = 'investasi.id_investasi = investasi_member.id_investasi';
                $params3['arrjoin']['investasi']['type'] = 'LEFT';

                
                $where3['investasi_member.id_user'] = $this->id_user;
                $params3['arrorderby']['kolom'] = 'investasi_member.create_date';
                $params3['arrorderby']['order'] = 'DESC';
                $where3['investasi_member.id_investasi'] = $id_inv;
                $id_inves = $this->action_m->get_where_params('investasi_member',$where3,'investasi.*,investasi_member.modal_investasi,investasi_member.keuntungan,investasi_member.create_date AS tgl',$params3);
            }
         
            $single_proyek = $this->action_m->get_where_params('investasi',['investasi.id_investasi' => $id_inv,'status' => 'Y'],$select2,$params2);
            // var_dump($single_proyek);die;
            if (!$single_proyek) {
                redirect('home');
            }
            $single_proyek = $single_proyek[0];
            if ($page == 'transaksi') {
                if (cek_date_skale($single_proyek->waktu,$single_proyek->durasi) != 'now') {
                    redirect('home');
                }
            }
            $data['single_proyek'] = $single_proyek;
            $data['id_inves'] = $id_inves;
        }
       
        $user = $this->action_m->get_single('user',['id_user' => $this->id_user,'blocked' => 'N']);

        $data['page'] = $page;
        $data['mainpage'] = $this->mainpage;
        $data['allpage'] = $this->allpage;
        $data['subpage'] = $this->subpage;
        $data['form_number'] = $this->form_number;
        $data['profil'] = $user;
        // var_dump($ins);die;
        $this->load->view('page/'.$page,$data);
    }
}

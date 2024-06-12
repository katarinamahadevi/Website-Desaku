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
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
        $this->nama = $this->session->userdata('hpalnickel_nama');

        $this->mainpage = ['home','investasi','informasi','profil'];
        $this->allpage = ['home','investasi','informasi','profil','catatan','transaksi'];
        $this->subpage = ['profil/ubah','catatan/investasi','catatan/keuntungan','catatan/isi_ulang','catatan/penarikan','catatan/detail_investasi'];
        $this->form_number = ['','','',[0,2],'',1];
    }

    public function index()
    {
        redirect('home');
    }

    public function base($page = 'home')
    {
        // GLOBAL VARIABEL
        $max_params = 3;
        $params = [];
        $params1 = [];
        $params2 = [];
        $arr = [];
        $no = 1;
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
        
        $params2['arrjoin']['investasi_member']['statement'] = 'investasi_member.id_investasi = investasi.id_investasi';
        $params2['arrjoin']['investasi_member']['type'] = 'LEFT';
        $params2['arrorderby']['kolom'] = 'live';
        $params2['arrorderby']['order'] = 'DESC';
        $params2['groupby'] = 'investasi.id_investasi';
        $select2 = "investasi.*,SUM(modal_investasi) AS modal, SUM(keuntungan) AS keuntungan,(SELECT SUBSTR(MAX(CONCAT(LPAD(investasi_member.id_investasi,50,' '),live)),51) AS LIVE FROM investasi_member WHERE investasi.id_investasi = investasi_member.id_investasi GROUP BY investasi_member.id_investasi ORDER BY live DESC) AS live";
        $single_proyek = [];
        // TRANSAKSI PAGE
        if ($page == 'transaksi' || $web_params1 == 'detail_investasi') {
            if (!isset($web_params1)) {
                redirect('home');
            }
            
            if ($web_params1 == 'detail_investasi') {
                if (!isset($web_params2)) {
                    redirect('home');
                }
                $id_inv = $web_params2;
            }else{
                $id_inv = $web_params1;
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
            

            
        }

        // GET SETTING
        $setting = $this->action_m->get_single('setting',['id_setting' => 1]);
        // GET ALL PROYEK
        $where = [];
        $detail_invest = [];
        $params['limit'] = 5;
        $params['arrorderby']['kolom'] = 'waktu';
        $params['arrorderby']['order'] = 'ASC';
        
        $where['investasi.status'] = 'Y';
        $proyek = $this->action_m->get_where_params('investasi', $where, 'investasi.*,(SELECT SUM(investasi_member.modal_investasi) FROM investasi_member WHERE investasi.id_investasi = investasi_member.id_investasi AND DATE(investasi_member.create_date) = "'.date('Y-m-d').'") AS jumlah_dana', $params);
        // SETUP PROYEK
        $proyek_rekomendasi = [];
        if ($proyek) {
            $prn = 0;
            foreach ($proyek as $row) {
                if (in_array(cek_date_skale($row->waktu, $row->durasi),['now','soon'])) {
                    $prnum = $prn++;
                    $proyek_rekomendasi[$prnum]['id_investasi'] = $row->id_investasi;
                    $proyek_rekomendasi[$prnum]['nama'] = $row->nama;
                    $proyek_rekomendasi[$prnum]['gambar'] = image_check($row->gambar,'proyek');
                    $proyek_rekomendasi[$prnum]['profit'] = $row->profit;
                    $proyek_rekomendasi[$prnum]['status'] = cek_date_skale($row->waktu, $row->durasi);
                    $proyek_rekomendasi[$prnum]['deskripsi'] = $row->deskripsi;
                    $proyek_rekomendasi[$prnum]['skala_proyek'] = $row->skala_proyek;
                    $proyek_rekomendasi[$prnum]['jumlah_dana'] = $row->jumlah_dana;
                    $proyek_rekomendasi[$prnum]['min_investasi'] = $row->min_investasi;
                    $proyek_rekomendasi[$prnum]['durasi'] = $row->durasi;
                    $proyek_rekomendasi[$prnum]['waktu'] = $row->waktu;
                    if ($row->jumlah_dana >= $row->skala_proyek) {
                        $kuota = 100;
                    }else{
                        $kuota = ($row->jumlah_dana / $row->skala_proyek) * 100;
                    }
                    $proyek_rekomendasi[$prnum]['persentase'] = $kuota;
                } 
            }
        }

        

        // INVESTASI

       
      

        $params3['arrjoin']['investasi']['statement'] = 'investasi.id_investasi = investasi_member.id_investasi';
        $params3['arrjoin']['investasi']['type'] = 'LEFT';

        
        $where3['investasi_member.id_user'] = $this->id_user;
        $params3['arrorderby']['kolom'] = 'investasi_member.create_date';
        $params3['arrorderby']['order'] = 'DESC';
        $investasi = $this->action_m->get_where_params('investasi',$where3,$select2,$params2);
        $all_inves = $this->action_m->get_where_params('investasi_member',$where3,'investasi.*,investasi_member.keuntungan,investasi_member.create_date AS tgl',$params3);
        $id_inves = [];
        if ($web_params1 == 'detail_investasi') {
            $where3['investasi_member.id_investasi'] = $web_params2;
            $id_inves = $this->action_m->get_where_params('investasi_member',$where3,'investasi.*,investasi_member.modal_investasi,investasi_member.keuntungan,investasi_member.create_date AS tgl',$params3);
        }
        
        // SETUP INVESTASI
        // var_dump($investasi);die;
        $inv_profil = [];
        $join_proyek = [];
        $keuntungan = [];
        if ($investasi) {
            $modal = 0;
            $untung = 0;
            foreach ($investasi as $row) {
                if ($row->live == 'Y') {
                    $modal += $row->modal;
                    $untung += $row->keuntungan;
                }
            }
            $inv_profil['modal'] = $modal;
            $inv_profil['untung'] = $untung;  
        }

        if ($all_inves) {
            $no = 0;
            foreach ($all_inves as $row) {
                $num = $no++;
                $keuntungan[$num]['id_investasi'] = $row->id_investasi;
                $keuntungan[$num]['nama'] = $row->nama;
                $keuntungan[$num]['keuntungan'] = $row->keuntungan;
                $keuntungan[$num]['durasi'] = $row->durasi;
                $keuntungan[$num]['create_date'] = $row->create_date;
            }
        }

        // GET USER PROFIL
        $user = $this->action_m->get_single('user',['id_user' => $this->id_user,'blocked' => 'N']);
        if (!$user) {
            redirect('logout');
        }
         // GET USER DATA
        $banner = $this->action_m->get_all('banner',['status' => 'Y']);
        $where1['id_user'] = $this->id_user;
        $topup = $this->action_m->get_all('topup',$where1);
        $params5['arrjoin']['rekening']['statement'] = 'penarikan.id_rekening = rekening.id_rekening';
        $params5['arrjoin']['rekening']['type'] = 'LEFT';
        $params5['arrjoin']['bank']['statement'] = 'bank.id_bank = rekening.id_bank';
        $params5['arrjoin']['bank']['type'] = 'LEFT';
        $params5['arrorderby']['kolom'] = 'penarikan.tanggal';
        $params5['arrorderby']['order'] = 'DESC';
        $penarikan = $this->action_m->get_where_params('penarikan',['penarikan.id_user' => $this->id_user],'penarikan.*,bank.gambar',$params5);
        $where1['deleted'] = 'N';

        $params4['arrjoin']['bank']['statement'] = 'bank.id_bank = rekening.id_bank';
        $params4['arrjoin']['bank']['type'] = 'LEFT';

        $rekening = $this->action_m->get_where_params('rekening',$where1,'rekening.*,bank.nama AS nama_bank,bank.gambar,bank.fee',$params4);
        

        // DATA UMUM
        $bank = $this->action_m->get_all('bank',['status' => 'Y']);

        // DEFINE MYDATA
        $mydata['page'] = $page;
        $mydata['mainpage'] = $this->mainpage;
        $mydata['allpage'] = $this->allpage;
        $mydata['subpage'] = $this->subpage;
        $mydata['form_number'] = $this->form_number;

        $mydata['data']['setting'] = $setting;
        $mydata['data']['proyek']['rekomendasi'] = $proyek_rekomendasi;
        $mydata['data']['proyek']['all'] = $proyek;
        $mydata['data']['profil'] = $user;
        $mydata['data']['banner'] = $banner;
        $mydata['data']['rekening'] = $rekening;
        $mydata['data']['bank'] = $bank;
        $mydata['data']['single_proyek'] = $single_proyek;
        $mydata['data']['live_invest'] = $inv_profil;
        $mydata['data']['join_proyek'] = $investasi;
        $mydata['data']['keuntungan'] = $keuntungan;
        $mydata['data']['topup'] = $topup;
        $mydata['data']['penarikan'] = $penarikan;
        $mydata['data']['id_inves'] = $id_inves;
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

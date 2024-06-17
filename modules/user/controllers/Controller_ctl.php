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


         $berita = $this->action_m->get_where_params('berita',[],'*,(SELECT COUNT(*) FROM berita_komentar WHERE berita_komentar.id_berita = berita.id_berita) AS komentar',[]);
         $agenda = $this->action_m->get_all('agenda');
         $banner = $this->action_m->get_all('banner');
        
        $id_berita = $this->input->get('id_berita');
        if (isset($id_berita)) {
            $result = $this->action_m->get_single('berita', ['id_berita' => $id_berita]);

            $params_khusus['arrjoin']['user']['statement'] = 'berita_komentar.id_user = user.id_user';
            $params_khusus['arrjoin']['user']['type'] = 'LEFT';
            $komentar = $this->action_m->get_where_params('berita_komentar',['id_berita' => $id_berita],'berita_komentar.*,user.nama AS user',$params_khusus);
            $mydata['data']['result'] = $result;
            $mydata['data']['komentar'] = $komentar;
        }else{
            $mydata['data'] = '';
        }


        $params5['arrjoin']['wisata']['statement'] = 'transaksi.id_wisata = wisata.id_wisata';
        $params5['arrjoin']['wisata']['type'] = 'LEFT';
        $history = $this->action_m->get_where_params('transaksi', [], 'transaksi.*,wisata.nama AS wisata, wisata.gambar', $params5);
        
        $params6['arrjoin']['wisata']['statement'] = 'favorit.id_wisata = wisata.id_wisata';
        $params6['arrjoin']['wisata']['type'] = 'LEFT';
        $favorit = $this->action_m->get_where_params('favorit', [], 'favorit.id_favorit,wisata.*', $params6);
        $id_favorit = [];
        if ($favorit) {
            foreach ($favorit as $key) {
                $id_favorit[] = $key->id_wisata;
            }
        }
        // CETAK DATA
        $mydata['wisata'] = $wisata;
        $mydata['pengurus'] = $pengurus;
        $mydata['agenda'] = $agenda;
        $mydata['berita'] = $berita;
        $mydata['banner'] = $banner;
         $mydata['history'] = $history;
         $mydata['favorit'] = $favorit;
         $mydata['id_favorit'] = $id_favorit;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('beranda', $mydata, TRUE);
        $this->display();
    }
}

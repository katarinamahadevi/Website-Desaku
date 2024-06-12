<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_role = '';
    var $id_user = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata('savanna_id_role');
        $this->id_user = $this->session->userdata('savanna_id_user');
    }

    public function index()
    {
        redirect('report/topup');
    }
    public function topup()
    {
        // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $id_user = ($this->input->get('id_user')) ? $this->input->get('id_user') : 'all';
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Isi Ulang';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "report/topup"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/report/topup.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        
         // GET DATA
        $where['MONTH(topup.create_date)'] = $bulan;
        $where['YEAR(topup.create_date)'] = $tahun;
        if ($id_user != 'all') {
            $where['topup.id_user'] = $id_user;
        }
         
        $params['arrjoin']['user']['statement'] = 'topup.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
         $jumlah = $this->action_m->cnt_where_params('topup',$where,$select,$params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }

        $select = 'topup.*,user.nama AS user';
        $params['arrorderby']['kolom'] = 'topup.create_date';
        $params['arrorderby']['order'] = 'DESC';
        $result = $this->action_m->get_where_params('topup',$where,$select,$params);

        
        $user = $this->action_m->get_all('user',['role' => 3]);
        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['user'] = $user;
        $mydata['tahun'] = $tahun;
        $mydata['bulan'] = $bulan;
        $mydata['id_user'] = $id_user;
        $mydata['offset'] =  ($offset+1);

        load_pagination('report/topup', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }

    public function penarikan()
    {
        // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Penarikan';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "report/penarikan"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/report/penarikan.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        // // GET DATA
        $where['MONTH(penarikan.tanggal)'] = $bulan;
        $where['YEAR(penarikan.tanggal)'] = $tahun;
        $params['arrjoin']['user']['statement'] = 'penarikan.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['rekening']['statement'] = 'penarikan.id_rekening = rekening.id_rekening';
        $params['arrjoin']['rekening']['type'] = 'LEFT';
        $params['arrjoin']['bank']['statement'] = 'rekening.id_bank = bank.id_bank';
        $params['arrjoin']['bank']['type'] = 'LEFT';
        $params['arrorderby']['kolom'] = 'penarikan.tanggal';
        $params['arrorderby']['order'] = 'DESC';
        $select = 'penarikan.*,user.nama AS user,rekening.nama AS rekening,rekening.nomor AS nomor_rekening, bank.gambar AS gambar_bank';
        $jumlah = $this->action_m->cnt_where_params('penarikan',$where,$select,$params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }

        $result = $this->action_m->get_where_params('penarikan',$where,$select,$params);
        
        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['tahun'] = $tahun;
        $mydata['bulan'] = $bulan;
        $mydata['offset'] =  ($offset+1);

        load_pagination('report/penarikan', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('penarikan', $mydata, TRUE);
        $this->display();
    }


     public function investasi()
    {
        // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $id_investasi = ($this->input->get('id_investasi')) ? $this->input->get('id_investasi') : 'all';
        $id_user = ($this->input->get('id_user')) ? $this->input->get('id_user') : 'all';
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Investasi Member';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "report/investasi"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/report/investasi.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        
         // GET DATA
        $where['MONTH(investasi_member.create_date)'] = $bulan;
        $where['YEAR(investasi_member.create_date)'] = $tahun;
        $where['live'] = 'N';
        if ($id_investasi != 'all') {
            $where['investasi_member.id_investasi'] = $id_investasi;
        }
        if ($id_user != 'all') {
            $where['investasi_member.id_user'] = $id_user;
        }
         
        $params['arrjoin']['user']['statement'] = 'investasi_member.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['investasi']['statement'] = 'investasi_member.id_investasi = investasi.id_investasi';
        $params['arrjoin']['investasi']['type'] = 'LEFT';
        $jumlah = $this->action_m->cnt_where_params('investasi_member',$where,$select,$params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }

        $select = 'investasi_member.*,investasi.nama AS proyek, user.nama AS user';
        $params['arrorderby']['kolom'] = 'investasi_member.create_date';
        $params['arrorderby']['order'] = 'DESC';
        $result = $this->action_m->get_where_params('investasi_member',$where,$select,$params);

        
        $investasi = $this->action_m->get_all('investasi');
         $user = $this->action_m->get_all('user',['role' => 3]);
        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['investasi'] = $investasi;
        $mydata['user'] = $user;
        $mydata['tahun'] = $tahun;
        $mydata['bulan'] = $bulan;
        $mydata['id_investasi'] = $id_investasi;
        $mydata['id_user'] = $id_user;
        $mydata['offset'] =  ($offset+1);

        load_pagination('report/investasi', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('investasi', $mydata, TRUE);
        $this->display();
    }

   
}

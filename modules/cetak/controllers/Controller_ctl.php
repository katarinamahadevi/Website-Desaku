<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Controller
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
    }
    public function index()
    {
        echo "PRIVATE PAGE";
    }
    public function excel($page = NULL)
    {
        if ($page) {
            $data = [];
            if ($page == 'topup') {
                $data = $this->_func_topup($this->input->get());
            }elseif($page == 'penarikan'){
                $data = $this->_func_penarikan($this->input->get());
            }elseif($page == 'investasi'){
                $data = $this->_func_investasi($this->input->get());
            }
            $data['result'] = $data;
            $this->load->view($page, $data);
        } else {
            echo "HALAMAN CETAK BELUM SIAP";
        }
    }

    private function _func_topup($get){
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }
         // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $id_user = ($this->input->get('id_user')) ? $this->input->get('id_user') : 'all';
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD DATA
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
        $select = 'topup.*,user.nama AS user';
        $params['arrorderby']['kolom'] = 'topup.create_date';
        $params['arrorderby']['order'] = 'DESC';
        $result = $this->action_m->get_where_params('topup',$where,$select,$params);
        // CETAK DATA
        $data['result'] = $result;
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['id_user'] = $id_user;

        return $data;
    }

    private function _func_penarikan($get){
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }
        $tahun = ($tahun) ? $tahun : date('Y');
        $bulan = ($bulan) ? $bulan : date('m');
        
        // GET DATA
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
        $select = 'penarikan.*,user.nama AS user,rekening.nama AS rekening,rekening.nomor AS nomor_rekening,bank.nama AS bank, bank.gambar AS gambar_bank';

        $result = $this->action_m->get_where_params('penarikan',$where,$select,$params);
        

        $data['result'] = $result;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        return $data;
    }

    private function _func_investasi($get){
        if ($get) {
            foreach ($get as $field => $value) {
                $$field = $value;
            }
        }
         // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $id_user = ($this->input->get('id_user')) ? $this->input->get('id_user') : 'all';
        $id_investasi = ($this->input->get('id_investasi')) ? $this->input->get('id_investasi') : 'all';
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD DATA
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

        $select = 'investasi_member.*,investasi.nama AS proyek, user.nama AS user';
        $params['arrorderby']['kolom'] = 'investasi_member.create_date';
        $params['arrorderby']['order'] = 'DESC';
        $result = $this->action_m->get_where_params('investasi_member',$where,$select,$params);
        // CETAK DATA
        $data['result'] = $result;
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['id_investasi'] = $id_investasi;
        $data['id_user'] = $id_user;

        return $data;
    }

}

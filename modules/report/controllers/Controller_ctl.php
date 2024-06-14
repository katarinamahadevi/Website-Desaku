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
        redirect('report/transaksi');
    }
    public function transaksi()
    {
        // GET FILTER DATA
        $tahun = ($this->input->get('tahun')) ? $this->input->get('tahun') : date('Y');
        $id_kategori_produk = ($this->input->get('id_kategori_produk')) ? $this->input->get('id_kategori_produk') : 'all';
        $bulan = ($this->input->get('bulan')) ? $this->input->get('bulan') : date('m');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Transaksi';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "report/transaksi"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/report/transaksi.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        ;
        // CETAK DATA
        $mydata['result'] = [];
        $mydata['offset'] =  ($offset+1);

        load_pagination('report/transaksi', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }


    // FUNGSI AJAX
    public function get_single_user()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('user', ['id_user' => $id]);
        $data['user'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function destroy(Type $var = null)
    {
        $this->session->sess_destroy();
    }
   
}

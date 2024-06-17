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
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Transaksi';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "report/transaksi"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/report/transaksi.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        
        // GET DATA
        $where = [];
        $params['arrjoin']['user']['statement'] = 'transaksi.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['wisata']['statement'] = 'transaksi.id_wisata = wisata.id_wisata';
        $params['arrjoin']['wisata']['type'] = 'LEFT';

        $select = 'transaksi.*,user.nama AS user,wisata.nama AS wisata';

        $result = $this->action_m->get_where_params('transaksi',$where,$select,$params);

        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['offset'] =  ($offset+1);

        load_pagination('report/transaksi', $limit, count($result));

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

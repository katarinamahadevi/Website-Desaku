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
        redirect('wisata/tiket');
    }
    
    public function tiket()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Tiket';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "wisata/tiket"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/wisata/tiket.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        if ($status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['status'] = $status;
            }
        }
        if ($search) {
            $params['columnsearch'][] = 'nama';
            $params['search'] = $search;
        }
        $jumlah = $this->action_m->cnt_where_params('tiket', $where, '*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $tiket = $this->action_m->get_where_params('tiket', $where, '*', $params);
        // CETAK DATA
        $mydata['result'] = $tiket;
        $mydata['search'] = $search;

        load_pagination('wisata/tiket', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('wisata/tiket', $mydata, TRUE);
        $this->display();
    }


    public function fasilitas()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Fasilitas';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "wisata/fasilitas"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/wisata/fasilitas.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $params = [];
        if ($status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['status'] = $status;
            }
        }
        if ($search) {
            $params['columnsearch'][] = 'nama';
            $params['search'] = $search;
        }
        $jumlah = $this->action_m->cnt_where_params('fasilitas', $where, '*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $fasilitas = $this->action_m->get_where_params('fasilitas', $where, 'fasilitas.*', $params);
        // CETAK DATA
        $mydata['result'] = $fasilitas;
        $mydata['search'] = $search;

        load_pagination('wisata/fasilitas', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('wisata/fasilitas', $mydata, TRUE);
        $this->display();
    }

    // FUNGSI AJAX
    public function get_single_tiket()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('tiket', ['id_tiket' => $id]);
        $data['tiket'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function get_single_fasilitas()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('fasilitas', ['id_fasilitas' => $id]);
        $data['fasilitas'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }
   
}

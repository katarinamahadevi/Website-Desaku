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
        redirect('pengurus/jabatan');
    }
    public function jabatan()
    {
        if (!in_array($this->id_role,[1])) {
            redirect('dashboard');
        }
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Jabatan';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "pengurus/jabatan"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/pengurus/pengurus.js"></script>';

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
        $jumlah = $this->action_m->cnt_where_params('jabatan', $where, '*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $jabatan = $this->action_m->get_where_params('jabatan', $where, '*', $params);
        // CETAK DATA
        $mydata['result'] = $jabatan;
        $mydata['search'] = $search;

        load_pagination('pengurus/jabatan', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('pengurus/jabatan', $mydata, TRUE);
        $this->display();
    }


    public function anggota()
    {
        if (!in_array($this->id_role,[1])) {
            redirect('dashboard');
        }
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');
        $id_jabatan = $this->input->get('id_jabatan');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Anggota';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "pengurus/anggota"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/pengurus/anggota.js"></script>';

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
        if (!$id_jabatan || $id_jabatan == 'all') {
            $where['pengurus.id_jabatan > '] = 1;
        }else{
            if (in_array($id_jabatan,[2,3])) {
                $where['pengurus.id_jabatan'] = $id_jabatan;
            }else{
                $where['pengurus.id_jabatan > '] = 1;
            }
        }
        $jumlah = $this->action_m->cnt_where_params('pengurus', $where, '*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $params['arrjoin']['jabatan']['statement'] = 'pengurus.id_jabatan = jabatan.id_jabatan';
        $params['arrjoin']['jabatan']['type'] = 'LEFT';
        $pengurus = $this->action_m->get_where_params('pengurus', $where, 'pengurus.*,jabatan.nama AS jabatan', $params);
        $jabatan = $this->action_m->get_all('jabatan');
        // CETAK DATA
        $mydata['result'] = $pengurus;
        $mydata['jabatan'] = $jabatan;
        $mydata['search'] = $search;

        load_pagination('pengurus/angota', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('pengurus/anggota', $mydata, TRUE);
        $this->display();
    }

    // FUNGSI AJAX
    public function get_single_jabatan()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('jabatan', ['id_jabatan' => $id]);
        $data['jabatan'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function get_single_pengurus()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('pengurus', ['id_pengurus' => $id]);
        $data['pengurus'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }
   
}

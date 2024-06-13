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
        redirect('master/user');
    }
    public function user()
    {
        if (!in_array($this->id_role,[1])) {
            redirect('dashboard');
        }
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');
        $role = $this->input->get('role');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data User';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/user"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/user.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $paramsuser = [];
        if ($status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['blocked'] = $status;
            }
        }
        if ($search) {
            $paramsuser['columnsearch'][] = 'nama';
            $paramsuser['columnsearch'][] = 'email';
            $paramsuser['columnsearch'][] = 'notelp';
            $paramsuser['search'] = $search;
        }
        if (!$role || $role == 'all') {
            $where['user.role > '] = 1;
        }else{
            if (in_array($role,[2,3])) {
                $where['user.role'] = $role;
            }else{
                $where['user.role > '] = 1;
            }
        }
        $jumlah = $this->action_m->cnt_where_params('user', $where, '*', $paramsuser);
        $paramsuser['limit'] = $limit;
        if ($offset) {
            $paramsuser['offset'] = $offset;
        }
        $user = $this->action_m->get_where_params('user', $where, '*', $paramsuser);
        // CETAK DATA
        $mydata['result'] = $user;
        $mydata['search'] = $search;

        load_pagination('master/user', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('user', $mydata, TRUE);
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


    
}

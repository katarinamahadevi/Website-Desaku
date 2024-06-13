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
        // $limit = 5;
        // $offset = $this->uri->segment(3);
        // $params = [];
        // $paramsuser = [];
        // if ($status != 'all') {
        //     if (in_array($status, ['Y', 'N'])) {
        //         $where['blocked'] = $status;
        //     }
        // }
        // if ($search) {
        //     $paramsuser['columnsearch'][] = 'nama';
        //     $paramsuser['columnsearch'][] = 'notelp';
        //     $paramsuser['search'] = $search;
        // }
        load_pagination('master/user', $limit, $jumlah);


        $mydata['result'] = false;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('table', $mydata, TRUE);
        $this->display();
    }

    public function proyek()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);

        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Proyek';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/proyek"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/proyek.js"></script>';
        $where = [];
        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        if ($search) {
            $params['columnsearch'][] = 'investasi.nama';
            $params['search'] = $search;
        }
        $order['order_by'] = 'investasi.nama';
        $order['ascdesc'] = 'ASC';
        if ($status) {
            if (in_array($status,['Y','N'])) {
                $where['investasi.status'] = $status;
            }
             
        }
        $jumlah = $this->action_m->cnt_where_params('investasi', $where, 'investasi.*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $params['arrorderby']['kolom'] = 'nama';
        $params['arrorderby']['order'] = 'ASC';
        
        $result = $this->action_m->get_where_params('investasi', $where, 'investasi.*', $params);

        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['search'] = $search;

        load_pagination('master/investasi', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('proyek', $mydata, TRUE);
        $this->display();
    }

    public function bank()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);

        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Bank';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "master/bank"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/bank.js"></script>';
        $where = [];
        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        if ($search) {
            $params['columnsearch'][] = 'bank.nama';
            $params['search'] = $search;
        }
        $order['order_by'] = 'bank.nama';
        $order['ascdesc'] = 'ASC';
        if ($status) {
            if (in_array($status,['Y','N'])) {
                $where['bank.status'] = $status;
            }  
        }
        $jumlah = $this->action_m->cnt_where_params('bank', $where, 'bank.*', $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        $params['arrorderby']['kolom'] = 'bank.nama';
         $params['arrorderby']['order'] = 'ASC';
        
        $result = $this->action_m->get_where_params('bank', $where, 'bank.*', $params);

        // CETAK DATA
        $mydata['result'] = $result;
        $mydata['search'] = $search;

        load_pagination('master/bank', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('bank', $mydata, TRUE);
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



    public function get_single_proyek()
    {
        $id = $this->input->post('id');
        $params = [];
        $result = $this->action_m->get_where_params('investasi', ['id_investasi' => $id],'investasi.*',$params);
        // $data['user'] = $result;
        // sleep(1.5);
        echo json_encode($result[0]);
        exit;
    }

    public function get_single_bank()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('bank', ['id_bank' => $id]);
        // sleep(1.5);
        echo json_encode($result);
        exit;
    }

    public function get_peserta_investasi()
    {
        $id = $this->input->post('id');

        $p['arrjoin']['user']['statement'] = 'investasi_member.id_user = user.id_user';
        $p['arrjoin']['user']['type'] = 'LEFT';
        $result = $this->action_m->get_where_params('investasi_member',['user.blocked' => 'N','investasi_member.id_investasi' => $id],'investasi_member.*, user.nama, user.notelp,user.foto',$p);
        $data['result'] = $result;
        $data['id_investasi'] = $id;
        $this->load->view('modal/peserta_investasi',$data);
    }
   
}

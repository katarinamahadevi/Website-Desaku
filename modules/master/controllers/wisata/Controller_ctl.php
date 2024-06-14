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


    public function unit()
    {
        // GET FILTER DATA
        $search = $this->input->get('search');
        $search = search_encode($search);
        $status = $this->input->get('status');

        // LOAD MAIN DATA
        $this->data['title'] = 'Data Wisata';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "wisata/unit"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/master/wisata/unit.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];
        if ($status != 'all') {
            if (in_array($status, ['Y', 'N'])) {
                $where['wisata.status'] = $status;
            }
        }
        if ($search) {
            $params['columnsearch'][] = 'wisata.nama';
            $params['columnsearch'][] = 'wisata.alamat';
            $params['search'] = $search;
        }
        $params['arrjoin']['wisata_tiket']['statement'] = 'wisata.id_wisata = wisata_tiket.id_wisata';
        $params['arrjoin']['wisata_tiket']['type'] = 'LEFT';
        $params['arrjoin']['tiket']['statement'] = 'wisata_tiket.id_tiket = tiket.id_tiket';
        $params['arrjoin']['tiket']['type'] = 'LEFT';
        $params['groupby'] = 'wisata.id_wisata';
        $select = "wisata.*,GROUP_CONCAT(tiket.nama SEPARATOR ',') AS tiket";
        
        $jumlah = $this->action_m->cnt_where_params('wisata', $where, $select, $params);
        $params['limit'] = $limit;
        if ($offset) {
            $params['offset'] = $offset;
        }
        
        $wisata = $this->action_m->get_where_params('wisata', $where, $select, $params);
        $tiket = $this->action_m->get_where_params('tiket',['status' => 'Y']);
        $fasilitas = $this->action_m->get_all('fasilitas');
        // CETAK DATA
        $mydata['result'] = $wisata;
        $mydata['tiket'] = $tiket;
        $mydata['fasilitas'] = $fasilitas;
        $mydata['search'] = $search;

        load_pagination('wisata/unit', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('wisata/wisata', $mydata, TRUE);
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

    public function get_single_wisata()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('wisata', ['id_wisata' => $id]);

        $params['arrjoin']['tiket']['statement'] = 'wisata_tiket.id_tiket = tiket.id_tiket';
        $params['arrjoin']['tiket']['type'] = 'LEFT';
        $tiket = $this->action_m->get_where_params('wisata_tiket', ['id_wisata' => $id],'tiket.*',$params);

        $params2['arrjoin']['fasilitas']['statement'] = 'wisata_fasilitas.id_fasilitas = fasilitas.id_fasilitas';
        $params2['arrjoin']['fasilitas']['type'] = 'LEFT';
        $fasilitas = $this->action_m->get_where_params('wisata_fasilitas', ['id_wisata' => $id],'fasilitas.*',$params2);
        $it = [];
        $if = [];
        if ($tiket) {
           foreach ($tiket as $row) {
                $it[] = (int)$row->id_tiket;
           }
        }

        if ($fasilitas) {
           foreach ($fasilitas as $row) {
                $if[] = (int)$row->id_fasilitas;
           }
        }
        $data['wisata'] = $result;
        $data['tiket'] = $it;
        $data['fasilitas'] = $if;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }
   
}

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
        redirect('management/banner');
    }
    public function banner()
    {
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Banner';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "management/banner"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/management/banner.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        // CETAK DATA
        $mydata['result'] = $this->action_m->get_all('banner');

        load_pagination('management/banner', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('banner', $mydata, TRUE);
        $this->display();
    }

     public function agenda()
    {
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Agenda';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "management/agenda"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/management/agenda.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        // CETAK DATA
        $mydata['result'] = $this->action_m->get_all('agenda');

        load_pagination('management/agenda', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('agenda', $mydata, TRUE);
        $this->display();
    }

    public function berita()
    {
        // LOAD MAIN DATA
        $this->data['title'] = 'Data Berita';
        // LOAD JS
        $this->data['js_add'][] = '<script>var page = "management/berita"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/management/berita.js"></script>';

        // LOAD DATA
        $limit = 5;
        $offset = $this->uri->segment(3);
        $params = [];
        $where = [];

        // CETAK DATA
        $mydata['result'] = $this->action_m->get_all('berita');

        load_pagination('management/berita', $limit, $jumlah);

        // LOAD VIEW
        $this->data['content'] = $this->load->view('berita', $mydata, TRUE);
        $this->display();
    }




     // FUNGSI AJAX
    public function get_single_banner()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('banner', ['id_banner' => $id]);
        $data['banner'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function get_single_agenda()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('agenda', ['id_agenda' => $id]);
        $data['agenda'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }

    public function get_single_berita()
    {
        $id = $this->input->post('id');

        $result = $this->action_m->get_single('berita', ['id_berita' => $id]);
        $data['berita'] = $result;
        // sleep(1.5);
        echo json_encode($data);
        exit;
    }
}

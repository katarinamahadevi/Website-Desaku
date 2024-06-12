<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Admin
{
    var $id_role = '';
    var $id_user = '';
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        $this->id_role = $this->session->userdata('hpalnickel_id_role');
        $this->id_user = $this->session->userdata('hpalnickel_id_user');
    }

    public function index()
    {
        $mydata = [];

         // LOAD JS
        $this->data['js_add'][] = '<script>var page = "dashboard"</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/dashboard.js"></script>';

        // LOAD DATA
        $p['arrorderby']['kolom'] = 'create_date';
        $p['arrorderby']['order'] = 'DESC';
        $p['arrjoin']['user']['statement'] = 'topup.id_user = user.id_user';
        $p['arrjoin']['user']['type'] = 'LEFT';
        $topup = $this->action_m->get_where_params('topup',['DATE(topup.create_date)' => date('Y-m-d')],'topup.*,user.nama AS user',$p);

        $user = $this->action_m->get_all('user',['role' => 3]);

        $mydata['topup'] = $topup;
        $mydata['user'] = $user;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }



    public function penarikan()
    {
        // GLBL
        $this->data['title'] = 'Pantau Antrian Penarikan';

        // JS ADD
        $this->data['js_add'][] = '<script>var page = "penarikan";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/penarikan.js"></script>';


        // // GET DATA
         $where['DATE(penarikan.tanggal)'] = date('Y-m-d');
        $params['arrjoin']['user']['statement'] = 'penarikan.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['rekening']['statement'] = 'penarikan.id_rekening = rekening.id_rekening';
        $params['arrjoin']['rekening']['type'] = 'LEFT';
        $params['arrjoin']['bank']['statement'] = 'rekening.id_bank = bank.id_bank';
        $params['arrjoin']['bank']['type'] = 'LEFT';
        $params['arrorderby']['kolom'] = 'penarikan.tanggal';
        $params['arrorderby']['order'] = 'DESC';
        $select = 'penarikan.*,user.nama AS user,rekening.nama AS rekening, bank.gambar AS gambar_bank,rekening.nama AS pemilik,rekening.nomor AS nomor_rekening';
        $result = $this->action_m->get_where_params('penarikan',$where,$select,$params);
        
        $no = 0;
        $status = 0;
        foreach (status_wd() as $num => $name) {
            $arr[$num] = [];
        }
        if ($result) {
            foreach ($result as $row) {
                if ($status != $row->status) {
                    $status = $row->status;
                    $no = (isset($arr[$status])) ? count($arr[$status]) : 0;      
                }
                $num = $no++;
                $arr[$status][$num]['id_penarikan'] = $row->id_penarikan;
                $arr[$status][$num]['id_user'] = $row->id_user;
                $arr[$status][$num]['id_rekening'] = $row->id_rekening;
                $arr[$status][$num]['kode_penarikan'] = $row->kode_penarikan;
                $arr[$status][$num]['tanggal'] = $row->tanggal;
                $arr[$status][$num]['user'] = $row->user;
                $arr[$status][$num]['nominal_penarikan'] = $row->nominal_penarikan;
                $arr[$status][$num]['nominal_diterima'] = $row->penarikan_diterima;
                $arr[$status][$num]['fee'] = $row->fee;
                $arr[$status][$num]['status'] = $row->status;
                $arr[$status][$num]['gambar_bank'] = $row->gambar_bank;
                $arr[$status][$num]['nomor_rekening'] = $row->nomor_rekening;
                $arr[$status][$num]['rekening'] = $row->rekening;
                $arr[$status][$num]['bukti_tf'] = $row->bukti_tf;
                $arr[$status][$num]['alasan'] = $row->alasan;
            }
        }
        // MYDATA DEKLARASI
        $mydata['result'] = $arr;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('penarikan', $mydata, TRUE);
        $this->display();
    }
    
   
}

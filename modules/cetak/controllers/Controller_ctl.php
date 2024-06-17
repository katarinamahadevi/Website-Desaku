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
            if ($page == 'transaksi') {
                $data = $this->_func_transaksi($this->input->get());
            }
            $data['result'] = $data;
            $this->load->view($page, $data);
        } else {
            echo "HALAMAN CETAK BELUM SIAP";
        }
    }

    private function _func_transaksi($get){

        // LOAD DATA
        $where = [];
        $params['arrjoin']['user']['statement'] = 'transaksi.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['wisata']['statement'] = 'transaksi.id_wisata = wisata.id_wisata';
        $params['arrjoin']['wisata']['type'] = 'LEFT';

        $select = 'transaksi.*,user.nama AS user,wisata.nama AS wisata';

        $result = $this->action_m->get_where_params('transaksi',$where,$select,$params);
       
        // CETAK DATA
        $data['result'] = $result;

        return $data;
    }

}

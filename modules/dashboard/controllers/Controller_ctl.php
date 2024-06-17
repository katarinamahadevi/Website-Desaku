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
        // GLBL
        $this->data['title'] = 'Pantau Antrian Transaksi';

        // JS ADD
        $this->data['js_add'][] = '<script>var page = "dashboard";</script>';
        $this->data['js_add'][] = '<script src="' . base_url() . 'assets/admin/js/modul/dashboard/dashboard.js"></script>';

         // GET DATA
        $where = [];
        $params['arrjoin']['user']['statement'] = 'transaksi.id_user = user.id_user';
        $params['arrjoin']['user']['type'] = 'LEFT';
        $params['arrjoin']['wisata']['statement'] = 'transaksi.id_wisata = wisata.id_wisata';
        $params['arrjoin']['wisata']['type'] = 'LEFT';

        $select = 'transaksi.*,user.nama AS user,wisata.nama AS wisata';

        $result = $this->action_m->get_where_params('transaksi',$where,$select,$params);

        $no = 0;
        $status = 0;
        $arr = [];
        if ($result) {
            foreach ($result as $row) {
                if ($status != $row->status) {
                    $status = $row->status;
                    $no = 0;
                }
                $num = $no++;
                $arr[$row->status][$num]['id_transaksi'] = $row->id_transaksi;
                $arr[$row->status][$num]['id_user'] = $row->id_user;
                $arr[$row->status][$num]['id_wisata'] = $row->id_wisata;
                $arr[$row->status][$num]['user'] = $row->user;
                $arr[$row->status][$num]['wisata'] = $row->wisata;
                $arr[$row->status][$num]['total'] = $row->total;
                $arr[$row->status][$num]['bukti_bayar'] = $row->bukti_bayar;
                $arr[$row->status][$num]['create_date'] = $row->create_date;
                $arr[$row->status][$num]['payment_date'] = $row->payment_date;
            }
        }
        // MYDATA DEKLARASI
        $mydata['result'] = $arr;
        // LOAD VIEW
        $this->data['content'] = $this->load->view('index', $mydata, TRUE);
        $this->display();
    }


     public function ubah_status_transaksi()
    {
        $status = $this->input->post('status');
        $id_transaksi = $this->input->post('id_transaksi');
        $baru = $this->input->post('baru');
        
        $post['status'] = $baru;
        if ($status == 0 ) {
            $post['payment_date'] = date('Y-m-d H:i:s');
        }
        
        $transaksi = $this->action_m->get_single('transaksi',['id_transaksi' => $id_transaksi]);
        $update = $this->action_m->update('transaksi',$post,['id_transaksi' => $id_transaksi]);
        
        if ($update) {
            if ($status == 1) {
                $user = $this->action_m->get_single('user',['id_user' => $transaksi->id_user]);
                $wisata = $this->action_m->get_single('wisata',['id_wisata' => $transaksi->id_wisata]);
                $params['arrjoin']['tiket']['statement'] = 'tiket.id_tiket = transaksi_detail.id_tiket';
                $params['arrjoin']['tiket']['type'] = 'LEFT';
                $detail = $this->action_m->get_where_params('transaksi_detail',['id_transaksi' => $id_transaksi],'transaksi_detail.*,tiket.nama AS tiket,tiket.harga AS harga',$params);
                $message = '<!doctype html>
                <html>

                <head>
                    <title>

                    </title>
                    <!--[if !mso]> -->
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <!--<![endif]-->
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <style type="text/css">
                        #outlook a {
                            padding: 0;
                        }

                        .ReadMsgBody {
                            width: 100%;
                        }

                        .ExternalClass {
                            width: 100%;
                        }

                        .ExternalClass * {
                            line-height: 100%;
                        }

                        body {
                            margin: 0;
                            padding: 0;
                            -webkit-text-size-adjust: 100%;
                            -ms-text-size-adjust: 100%;
                        }

                        table,
                        td {
                            border-collapse: collapse;
                            mso-table-lspace: 0pt;
                            mso-table-rspace: 0pt;
                        }

                        img {
                            border: 0;
                            height: auto;
                            line-height: 100%;
                            outline: none;
                            text-decoration: none;
                            -ms-interpolation-mode: bicubic;
                        }

                        p {
                            display: block;
                            margin: 13px 0;
                        }
                    </style>

                    <style type="text/css">
                        @media only screen and (max-width:480px) {
                            @-ms-viewport {
                                width: 320px;
                            }
                            @viewport {
                                width: 320px;
                            }
                        }
                    </style>

                </head>

                <body style="background-color:#f9f9f9;">


                    <div style="background-color:#f9f9f9;">


                        <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:1200px;">

                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>


                        <div style="background:transparent;background-color:transparent;Margin:0px auto;max-width:1000px;">

                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">

                                            <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">

                                                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">

                                                    <tr>
                                                        <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">

                                                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="width:125px;">

                                                                            <!-- <img height="auto" src="https://i.imgur.com/KO1vcE9.png" style="border:0;display:block;outline:none;text-decoration:none;width:100%;" width="64" /> -->

                                                                            <div style="font-family:Arial,sans-serif;font-size:28px;font-weight:bold;line-height:1;text-align:center;color:#f8b864 !important;">
                                                                                DESAKU
                                                                            </div>

                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">

                                                            <div style="font-family:Arial,sans-serif;font-size:28px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                                '.$wisata->nama.'
                                                            </div>

                                                        </td>
                                                    </tr>';
                                                    foreach ($detail as $key) {
                                                       $message .= '<tr>
                                                        <td align="left" style="font-size:0px;padding:10px 25px; word-break:break-word; display:flex; justify-content:space-between; align-items:center ;">

                                                            <div>
                                                                <div style="font-family:Arial,sans-serif;font-size:12px; font-weight: light; margin-bottom: 3px; line-height:22px;text-align:left;color:#555;">
                                                                    Nama Lengkap
                                                                </div>
                                                                <div style="font-family:Arial,sans-serif;font-size:20px; font-weight: medium; line-height:22px; text-align:left;color:#555;">
                                                                    '.$key->nama.'
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <div style="font-family:Arial,sans-serif;font-size:12px; font-weight: normal; margin-bottom: 3px; line-height:22px;text-align:left;color:#555; text-align: end;">
                                                                    ,Kategori Tiket
                                                                </div>
                                                                <div style="font-family:Arial,sans-serif;font-size:20px; font-weight: medium; line-height:22px; text-align:left;color:#555; text-align: end;">
                                                                    ,'.$key->tiket.'
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word; display: flex; justify-content: space-between; align-items: center;">

                                                            <div>
                                                                <div style="font-family:Arial,sans-serif;font-size:12px; font-weight: light; margin-bottom: 3px; line-height:22px;text-align:left;color:#555;">
                                                                    Harga Tiket
                                                                </div>
                                                                <div style="font-family:Arial,sans-serif;font-size:20px; font-weight: medium; line-height:22px; text-align:left;color:#555;">
                                                                    '.price_format($key->harga,1).'
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>';
                                                    }
                                                    

                                                    


                                        $message .= '<tr>
                                                        <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word; display: flex; justify-content: center; align-items: center;">

                                                            <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:left;color:#555;">
                                                                Terima kasih telah memesan tiket wisata '.$wisata->nama.'
                                                            </div>

                                                        </td>
                                                    </tr>

                                                </table>

                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                        <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:1200px;">

                            <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:0px 0;text-align:center;vertical-align:top;">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                </body>

                </html>';
                $mail = sendmail('admin@gmail.com',$user->email,'Konfirmasi pembayaran',$message);
            }
            $kata = 'Berhasil merubah status <b>"'.status_payment($status).'"</b> menjadi status <b>"'.status_payment($baru).'"</b>';
            $data['status'] = true;
            $data['message'] = $kata;
        }else{
            $kata = 'Gagal merubah status <b>"'.status_payment($status).'"</b> menjadi status <b>"'.status_payment($baru).'"</b>';

            $data['status'] = true;
            $data['message'] = $kata;
        }

        echo json_encode($data);
        exit;
    }
}

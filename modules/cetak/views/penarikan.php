<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Penukaran</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        table td img {
            width: 100px;
        }


        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>
</head>

<body>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Penarikan ".month_from_number($result['bulan'])." ".$result['tahun'].".xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="10">DATA PENARIKAN</th>
            </tr>
            <tr>
                <th><center>Tanggal</center></th>
                <th><center>Status</center></th>
                <th><center>Customer</center></th>
                <th><center>Kode Penarikan</center></th>
                <th><center>Nominal Penarikan</center></th>
                <th><center>Nominal Diterima</center></th>
                <th><center>Nama Rekening</center></th>
                <th><center>Tujuan Bank</center></th>
                <th><center>Nomor Rekening</center></th>
                <th><center>Fee Penarikan</center></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result['result']) : ?>
                <?php $no = 1;
                foreach ($result['result'] as $row) : ?>
                     <tr>
                        <td><center><?= date('d F Y H:i',strtotime($row->tanggal)); ?></center></td>
                        <td><center><?= status_wd($row->status); ?></center></td>
                        <td><?= $row->user; ?></td>
                        <td><?= $row->kode_penarikan ?></td>
                        <td><center><?= price_format($row->nominal_penarikan,1); ?></center></td>
                        <td><center><?= price_format($row->penarikan_diterima,1); ?></center></td>
                        <td><?= $row->rekening; ?></td>
                        <td><?= $row->bank; ?></td>
                        <td><?= $row->nomor_rekening; ?></td>
                        <td><?= ifnull(price_format($row->fee,1),' - '); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="10">
                        <center>Tidak ada data penarikan</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
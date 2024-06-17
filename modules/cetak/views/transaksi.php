<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Transaksi</title>
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
    header("Content-Disposition: attachment; filename=Data Transaksi.xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="6">DATA PENARIKAN</th>
            </tr>
            <tr>
                <th><center>Tanggal Transaksi</center></th>
                <th><center>Tanggal Pembayaran</center></th>
                <th><center>Pemesan</center></th>
                <th><center>Wisata</center></th>
                <th><center>Total Harga</center></th>
                <th><center>Status</center></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result['result']) : ?>
                <?php $no = 1;
                foreach ($result['result'] as $row) : ?>
                     <tr>
                        <td><center><?= date('d F Y H:i',strtotime($row->create_date)); ?></center></td>
                        <td><center><?= date('d F Y H:i',strtotime($row->payment_date)); ?></center></td>
                        <td><center><?= $row->user; ?></center></td>
                        <td><?= $row->wisata; ?></td>
                        <td><center><?= price_format($row->total,1); ?></center></td>
                        <td><?= status_payment($row->status); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6">
                        <center>Tidak ada data transaksi</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
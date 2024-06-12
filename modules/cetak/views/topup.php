<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Isi Ulang</title>
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
    header("Content-Disposition: attachment; filename=Data Isi Ulang ".month_from_number($result['bulan'])." ".$result['tahun'].".xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="3">DATA ISI ULANG</th>
            </tr>
            <tr>
                <th><center>Tanggal</center></th>
                <th><center>Customer</center></th>
                <th><center>Nominal Top Up</center></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result['result']) : ?>
                <?php $no = 1;
                foreach ($result['result'] as $row) : ?>
                    <tr>
                        <td>
                            <center><?= date('d F Y H:i',strtotime($row->create_date)); ?></center>
                        </td>
                        <td>
                            <?= $row->user; ?>
                        </td>
                        <td>
                         <center>
                            <?= price_format($row->nominal,1); ?>
                         </center>   
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">
                        <center>Tidak ada data isi ulang</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Data Investasi</title>
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
    header("Content-Disposition: attachment; filename=Data Investasi ".month_from_number($result['bulan'])." ".$result['tahun'].".xls");
    ?>


    <table>
        <thead>
            <tr>
                <th colspan="8">DATA INVESTASI</th>
            </tr>
            <tr>
                <th><center>Waktu Mulai</center></th>
                <th><center>Waktu Investasi</center></th>
                <th><center>Waktu Selesai</center></th>
                <th><center>Member</center></th>
                <th><center>Proyek</center></th>
                <th><center>Nominal Investasi</center></th>
                <th><center>Profit</center></th>
                <th><center>Keuntungan</center></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result['result']) : ?>
                <?php $no = 1;
                foreach ($result['result'] as $row) : ?>
                    <tr>
                        <td>
                            <center><?= date('d F Y H:i',strtotime($row->start_date)); ?></center>
                        </td>
                        <td>
                            <center><?= date('d F Y H:i',strtotime($row->create_date)); ?></center>
                        </td>
                        <td>
                            <center><?= date('d F Y H:i',strtotime($row->end_date)); ?></center>
                        </td>
                        <td>
                            <?= $row->user; ?>
                        </td>
                        <td>
                            <?= $row->proyek; ?>
                        </td>
                        <td>
                         <center>
                            <?= price_format($row->modal_investasi,1); ?>
                         </center>   
                        </td>
                        <td>
                         <center>
                            <?= $row->profit.'%'; ?>
                         </center>   
                        </td>
                        <td>
                         <center>
                            <?= price_format($row->keuntungan,1); ?>
                         </center>   
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8">
                        <center>Tidak ada data investasi</center>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faktur Pembelian</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>

    <h1 align="Center"> Faktur Pembelian </h1>

    <table width="100%">
        <tr>
        <img src="pictures/kos.png" width="80px" />
        </td>
            <td align="right">
                <h3>CV Balibo</h3>
            </td>
        </tr>

    </table>
    </table>
    <br />
    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Nama Supplier</th>
                <th>Tanggal Pembelian</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $total;
            foreach ($dataPembelian->getResult() as $data) {
                // $total += $data->subtotal_pembelian;
            ?>
                <tr>
                    <th scope="row">1</th>
                    <td><?= $data->nama_barang; ?></td>
                    <td><?= $data->nama_supplier; ?></td>
                    <td><?= $data->tgl_pembelian; ?></td>
                    <td><?= format_rupiah($data->total); ?></td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total: </td>
                <td align="right" class="gray"><?=  format_rupiah($data->total);?></td>
            </tr>
        </tfoot>
    </table>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>
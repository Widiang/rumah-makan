<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        .table {
            font-family: ponzi hat;
            color: #232323;
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #999;
        }

        th, td {
            border: 2px solid #999;
            padding: 8px 20px;
            text-align: center;
        }

        .no-border {
            border: none;
        }

        img {
            width: 30%;
        }
    </style>
</head>
<body>

<br>
<br>
<br>
<br>
<br>
<br>
<p style="font-size: 40px; font-weight: bold; border-bottom: 0px solid black; width: 100%; margin: 0 auto; text-align: center;">HASIL PENJUALAN</p>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<table class="table datatable" id="mitraTable">
                <thead>
                  <tr>
                    <th align="center" scope="col">No Order</th>
                    <th align="center" scope="col">Pelanggan</th>
                    <th align="center" scope="col">Petugas</th>
                    <th align="center" scope="col">alamat</th>
                    <th align="center" scope="col">Tgl. Pemesanan</th>
                    <th align="center" scope="col">Makanan</th>
                    <th align="center" scope="col">Minuman</th>
                    <th align="center" scope="col">Total harga</t>
                  </tr>
                </thead>
                <tbody>

    </thead>
    <tbody>
    <?php
$no = 1;
foreach ($print as $key) {
    if ($key->progress === "selesai") { // Add this condition
?>
    <tr>
          <td align="center" scope="col"><?= $no++ ?></td>
        <td align="center" scope="col"><?= $key->user?></td>
        <td align="center" scope="col"><?= $key->admin?></td>
        <td align="center" scope="col"><?= $key->alamat?></td>
        <td align="center" scope="col"><?= $key->tanggal?></td>
        <td align="center" scope="col"><?= $key->nama_Menu?></td>
        <td align="center" scope="col"><?= $key->nama_minuman?></td>
        <td align="center" scope="col">Rp <?= number_format($key->total_harga, 0, ',', '.') ?></td>  
      </tr>
<?php
    }
}
?>
    <tr>
    <th class="no-border"></th>
    <th class="no-border"></th>
    <th class="no-border"></th>
    <th class="no-border"></th>
    <th class="no-border"></th>
    <th class="no-border"></th>
    <th>Total :</th>
    <th>Total :</th>
    <?php
        $total = 0;
        foreach ($print as $key){
            $total += $key->total_harga;
        }?>
        <th class="no-border" colspan="4">Rp <?= number_format($total, 0, ',', '.') ?></th>
</tr>
    </tbody>
</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script>
    // Function to convert HTML to PDF
    function convertToPDF() {
        const element = document.body; // Assuming you want to convert the whole body
        const opt = {
            margin: 1,
            filename: 'LaporanPenjualan.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'a3', orientation: 'landscape' } // Adjust format to 'a3' for bigger page size
        };
        
        html2pdf()
            .set(opt)
            .from(element)
            .save();
    }

    // Call the function to trigger conversion when the document loads
    window.onload = function() {
        convertToPDF();
    };
</script>
</body>
</html>

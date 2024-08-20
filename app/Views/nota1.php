<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print View</title>
    <style>
        .container {
            margin: 0;
            padding: 0;
            width: 100%; /* Ensure container takes full width */
            height: 100%; /* Ensure container takes full height */
        }

        @page {
            size: 8.5cm 14cm; /* Set the page size to 8.5 x 14 cm */
            margin: 0; /* Remove default margin */
        }

        @media print {
            .container {
                width: 100%; /* Ensure container takes full width */
                height: 100%; /* Ensure container takes full height */
                padding: 0;
                margin: 0;
            }

            .page-number::after {
                content: none !important;
            }
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 3px;
        }

        .flex-container .item-left {
            text-align: left;
            width: 40%; /* Adjust width to align with your layout needs */
        }

        .flex-container .item-center {
            text-align: center;
            width: 20%; /* Adjust width to align with your layout needs */
        }

        .flex-container .item-right {
            text-align: right;
            width: 40%; /* Adjust width to align with your layout needs */
        }

        .total-section {
            display: flex;
            justify-content: flex-end;
            font-size: 14px;
            margin-bottom: 3px;
            border-top: 2px solid black;
            padding-top: 3px;
        }
    </style>
</head>
<body>
    <div class="container" style="text-align: center;">
        <div style="display: flex; justify-content: space-between;">

            <div style="text-align: right;">
                <img src="<?php echo base_url('assets/img/custom/'.$satu->logos)?>" width="150px">
            </div>
        </div>

        <br>

        <p id="info-text" style="font-weight: bold; border-bottom: 2px solid black; font-size: 14px;">Lytech Industry, belian, kec, batam kota, kota batam</p>
        <p id="date-time" style="font-weight: bold; border-bottom: 2px solid black; font-size: 14px;"></p>
        <br>

        <?php
        // Initialize totals
        $totalMenuAmount = 0;
        $totalMinumanAmount = 0;
        ?>

        <!-- Display menu items -->
        <?php foreach ($te as $rr): ?>
            <?php
            // Calculate amount for this item
            $menuAmount = $rr->total_menu > 0 ? $rr->harga_menu * $rr->total_menu : $rr->harga_menu;
            $totalMenuAmount += $menuAmount;
            ?>
            <div class="flex-container">
                <p class="item-left" style="margin: 0;"><?= $rr->nama_Menu ?></p>
                <p class="item-center" style="margin: 0;"><?= $rr->total_menu ?></p>
                <p class="item-right" style="margin: 0;">
                    Rp <?= number_format($menuAmount, 0, ',', '.') ?>
                </p>
            </div>
        <?php endforeach; ?>

        <!-- Display minuman items -->
        <?php foreach ($te as $rr): ?>
            <?php
            // Calculate amount for this item
            $minumanAmount = $rr->total_minuman > 0 ? $rr->harga_minuman * $rr->total_minuman : $rr->harga_minuman;
            $totalMinumanAmount += $minumanAmount;
            ?>
            <div class="flex-container">
                <p class="item-left" style="margin: 0;"><?= $rr->nama_minuman ?></p>
                <p class="item-center" style="margin: 0;"><?= $rr->total_minuman ?></p>
                <p class="item-right" style="margin: 0;">
                    Rp <?= number_format($minumanAmount, 0, ',', '.') ?>
                </p>
            </div>
        <?php endforeach; ?>

        <!-- Calculate and display totals -->
        <?php
        $totalAmount = $totalMenuAmount + $totalMinumanAmount;
        $bayar = $sa->Total_bayar; // Replace with the actual amount paid variable
        $kembalian = $bayar - $totalAmount;
        ?>

        <div class="total-section">
            <p style="margin: 0;">
                Total : Rp <?= number_format($totalAmount, 0, ',', '.') ?>
            </p>
        </div>

        <div class="total-section">
            <p style="margin: 0;">
                Bayar : Rp <?= number_format($bayar, 0, ',', '.') ?>
            </p>
        </div>

        <div class="total-section">
            <p style="margin: 0;">
                Kembalian : Rp <?= number_format($kembalian, 0, ',', '.') ?>
            </p>
        </div>
        
        <script>
          function formatNumber(num) {
            return num < 10 ? '0' + num : num;
          }

          function updateDateTime() {
            const now = new Date();
            const year = now.getFullYear();
            const month = formatNumber(now.getMonth() + 1);
            const day = formatNumber(now.getDate());
            const hours = formatNumber(now.getHours());
            const minutes = formatNumber(now.getMinutes());
            const seconds = formatNumber(now.getSeconds());

            const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            document.getElementById('date-time').textContent = formattedDateTime;
          }

          updateDateTime();
        </script>

        <script type="text/javascript">
            window.onload = function () {
                window.print();
            }
        </script>
    </div>
</body>
</html>

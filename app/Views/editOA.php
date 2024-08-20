<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_editOA')?>" method="post">
                <div class="pagetitle">
                    <h1>Order</h1>

                    <section class="section">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Order</h5>

                                        <!-- General Form Elements -->
                                        <div class="mb-3 mt-3">
                                            <label for="Deskripsi" class="form-label">Nama Pemesan</label>
                                            <input class="form-control" id="Deskripsi" value="<?= $sa->user ?>" name="nama"></input>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="Invoice" class="form-label">Tanggal order</label>
                                            <input type="date" class="form-control" id="Invoice" value="<?= $sa->tanggal ?>" name="Tanggal">
                                        </div>

                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="jenis1" class="form-label">Menu Makanan</label>
                                                <select name="jenis1[]" class="form-control" id="menuMakanan" onchange="updateTotalHarga()">
                                                    <option value="<?= $sa->id_menu ?>" data-total-harga="<?= $sa->total_harga ?>"><?= $sa->nama_Menu ?></option>
                                                    <?php foreach($s as $key): ?>
                                                        <option value="<?= $key->id_menu ?>" data-total-harga="<?= $key->total_harga ?>"><?= $key->nama_Menu ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="totalM" class="form-label">Total</label>
                                                <input class="form-control total-field" id="totalMakanan" name="totalM" style="width: 100%;" value="<?=$sa->total_menu?>" onchange="updateTotalHarga()">
                                            </div>
                                        </div>

                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-6 col-lg-6">
                                                <label for="jenis2" class="form-label">Menu Minuman</label>
                                                <select name="jenis2[]" class="form-control" id="menuMinuman" onchange="updateTotalHarga()">
                                                    <option value="<?= $sa->id_minuman ?>" data-total-harga="<?= $sa->total_harga ?>"><?= $sa->nama_minuman ?></option>
                                                    <?php foreach($t as $key): ?>
                                                        <option value="<?= $key->id_minuman ?>" data-total-harga="<?= $key->total_harga ?>"><?= $key->nama_minuman ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-5 col-lg-5">
                                                <label for="totalMI" class="form-label">Total</label>
                                                <input class="form-control total-field" id="totalMinuman" name="totalMI" style="width: 100%;" value="<?=$sa->total_minuman?>" onchange="updateTotalHarga()">
                                            </div>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="totalHarga" class="form-label">Total Harga</label>
                                            <input type="text" class="form-control" id="totalHarga" name="totalHarga" value="<?= $sa->total_harga ?>" readonly>
                                        </div>
                                        <input type="hidden" name="id" value="<?= $sa->id_transaksi ?>">
                                        <div class="row mb-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </main><!-- End #main -->

    <style>
        .product {
            margin-bottom: 20px;
        }

        .product .form-group {
            margin-bottom: 0;
        }

        .product .form-group:last-child {
            margin-bottom: 15px;
        }

        .product select, .product textarea, .product input {
            width: 100%;
        }

        .delete-btn {
            margin-top: 35px;
        }
    </style>

    <script>
        const menuPrices = {
            <?php foreach($s as $key): ?>
                '<?= $key->id_menu ?>': {
                    harga: <?= $key->harga_menu ?>
                },
            <?php endforeach; ?>
        };

        const minumanPrices = {
            <?php foreach($t as $key): ?>
                '<?= $key->id_minuman ?>': {
                    harga: <?= $key->harga_minuman ?>
                },
            <?php endforeach; ?>
        };

        function updateTotalHarga() {
            let totalHarga = 0;

            // Get selected menu makanan
            const selectedMenuMakanan = document.getElementById('menuMakanan').value;
            const totalMakanan = parseFloat(document.getElementById('totalMakanan').value.replace(/\./g, '') || '0');
            const hargaMakanan = menuPrices[selectedMenuMakanan]?.harga || 0;

            totalHarga += hargaMakanan * totalMakanan;

            // Get selected menu minuman
            const selectedMenuMinuman = document.getElementById('menuMinuman').value;
            const totalMinuman = parseFloat(document.getElementById('totalMinuman').value.replace(/\./g, '') || '0');
            const hargaMinuman = minumanPrices[selectedMenuMinuman]?.harga || 0;

            totalHarga += hargaMinuman * totalMinuman;

            // Update the totalHarga field
            document.getElementById('totalHarga').value = totalHarga.toFixed(0);
        }

        // Initialize totalHarga on page load
        document.addEventListener('DOMContentLoaded', () => {
            updateTotalHarga();
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_order')?>" method="post">
                <div class="pagetitle">
                    <h1>Order</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                                <li class="nav-item">
                                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-message-alt-add"></i> ORDER</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('home/inprogress')?>"><i class="bx bx-spreadsheet me-1"></i> IN PROGRESS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?=base_url('home/history')?>"><i class="bx bx-history me-1"></i> HISTORY</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End Page Title -->

                    <section class="section">
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Order</h5>

                                        <!-- General Form Elements -->
                                        <div class="mb-3 mt-3">
                                            <label for="Deskripsi" class="form-label">Nama Pemesan</label>
                                            <input class="form-control" id="Deskripsi"  name="nama"></input>
                                        </div>

                                        <div class="mb-3 mt-3">
                                            <label for="Invoice" class="form-label">Tanggal order</label>
                                            <input type="date" class="form-control" id="Invoice" value="<?php echo date('Y-m-d'); ?>" name="Tanggal">
                                        </div>

                                        <!-- Product Section for Makanan -->
                                        <div id="product-section-makanan">
                                            <!-- Product Forms for Makanan will be dynamically added here -->
                                        </div>
                                        <div class="row mb-3">
                                            <button type="button" class="btn btn-success" onclick="addProductForm('makanan')">Add Menu Makanan</button>
                                        </div>

                                        <!-- Product Section for Minuman -->
                                        <div id="product-section-minuman">
                                            <!-- Product Forms for Minuman will be dynamically added here -->
                                        </div>
                                        <div class="row mb-3">
                                            <button type="button" class="btn btn-success" onclick="addProductForm('minuman')">Add Menu Minuman</button>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <label for="totalHarga" class="form-label">Total Harga</label>
                                            <input type="text" class="form-control" id="totalHarga" name="totalHarga" readonly>
                                        </div>
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
        margin-bottom: 20px; /* Adjust margin bottom as needed */
    }

    .product .form-group {
        margin-bottom: 0; /* Remove default margin */
    }

    .product .form-group:last-child {
        margin-bottom: 15px; /* Add margin to the last form group */
    }

    .product select, .product textarea, .product input {
        width: 100%; /* Make form elements full-width */
    }

    .delete-btn {
        margin-top: 35px; /* Adjust the vertical position as needed */
    }
    </style>

    <script>
    const menuPrices = {
        <?php foreach($s as $key): ?>
            '<?= $key->id_menu ?>': <?= $key->harga_menu ?>,
        <?php endforeach; ?>
    };

    const minumanPrices = {
        <?php foreach($t as $key): ?>
            '<?= $key->id_minuman ?>': <?= $key->harga_minuman ?>,
        <?php endforeach; ?>
    };

    function addProductForm(type) {
    let productSection = (type === 'makanan') ? document.getElementById('product-section-makanan') : document.getElementById('product-section-minuman');
    let productForm = document.createElement('div');
    productForm.classList.add('product');

    if (type === 'makanan') {
        productForm.innerHTML = `
            <div class="row align-items-center mb-3">
                <div class="col-md-6 col-lg-6">
                    <label for="jenis1" class="form-label">Menu Makanan</label>
                    <select name="jenis1[]" class="form-control" onchange="updateTotalHarga()">
                        <option value="">Pilih</option>
                        <?php foreach($s as $key): ?>
                            <?php if($key->Stok > 0): ?>
                                <option value="<?=$key->id_menu?>"><?=$key->nama_Menu?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5 col-lg-5">
                    <label for="totalM" class="form-label">Total</label>
                    <input type="number" class="form-control total-field" name="totalM[]" style="width: 100%;" min="1" onchange="updateTotalHarga()">
                </div>
                <div class="col-md-1 col-lg-1 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" onclick="deleteProductForm(this)">X</button>
                </div>
            </div>
        `;
    } else if (type === 'minuman') {
        productForm.innerHTML = `
            <div class="row align-items-center mb-3">
                <div class="col-md-6 col-lg-6">
                    <label for="jenis2" class="form-label">Menu Minuman</label>
                    <select name="jenis2[]" class="form-control" onchange="updateTotalHarga()">
                        <option value="">Pilih</option>
                        <?php foreach($t as $key): ?>
                            <?php if($key->stok > 0): ?>
                                <option value="<?=$key->id_minuman?>"><?=$key->nama_minuman?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-5 col-lg-5">
                    <label for="totalM" class="form-label">Total</label>
                    <input type="number" class="form-control total-field" name="totalMI[]" style="width: 100%;" min="1" onchange="updateTotalHarga()">
                </div>
                <div class="col-md-1 col-lg-1 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" onclick="deleteProductForm(this)">X</button>
                </div>
            </div>
        `;
    }

    productSection.appendChild(productForm);
}

function deleteProductForm(button) {
    let productForm = button.closest('.product');
    productForm.remove();
    updateTotalHarga();
}

function updateTotalHarga() {
    let totalHarga = 0;

    // Calculate total for makanan
    document.querySelectorAll('#product-section-makanan .product').forEach(product => {
        const select = product.querySelector('select');
        const totalInput = product.querySelector('input[name="totalM[]"]');
        const harga = menuPrices[select.value] || 0;
        const jumlah = parseFloat(totalInput.value) || 0;

        if (jumlah > 0) {
            totalHarga += harga * jumlah;
        } else {
            totalHarga += harga;
        }
    });

    // Calculate total for minuman
    document.querySelectorAll('#product-section-minuman .product').forEach(product => {
        const select = product.querySelector('select');
        const totalInput = product.querySelector('input[name="totalMI[]"]');
        const harga = minumanPrices[select.value] || 0;
        const jumlah = parseFloat(totalInput.value) || 0;

        if (jumlah > 0) {
            totalHarga += harga * jumlah;
        } else {
            totalHarga += harga;
        }
    });

    document.getElementById('totalHarga').value = totalHarga;
}
    </script>
</body>
</html>

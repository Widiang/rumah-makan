<main id="main" class="main">
    <div class="pagetitle">
        <h1>Order</h1>
        <nav></nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
                        <li class="breadcrumb-item active">
                            <!-- Add your breadcrumb or header content here if needed -->
                        </li>
                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">
                            <!-- Profile Edit Form -->
                            <form method="post" action="<?= base_url('home/Update') ?>">
                                <div class="mb-3 mt-3">
                                    <label for="Deskripsi" class="form-label">Nama Pemesan</label>
                                    <input class="form-control" id="Deskripsi" name="nama" value="<?= $sa->user ?>" readonly>
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="Invoice" class="form-label">Tanggal order</label>
                                    <input type="date" class="form-control" id="Invoice" name="Tanggal" value="<?= $sa->tanggal ?>" readonly>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="Invoice" class="form-label">Nama Petugas</label>
                                    <input type="text" class="form-control" id="Invoice" name="petugas" value="<?= $sa->admin ?>" readonly>
                                </div>

                                <?php foreach ($te as $rr): ?>
                                    <div class="row product">
                                        <div class="col">
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-5 col-lg-5">
                                                    <label for="jenis1" class="form-label">Menu Makanan</label>
                                                    <select name="jenis1[]" class="form-control" onchange="updateTotalHarga()">
                                                        <option value="<?= $rr->id_menu ?>" data-harga="<?= $menuPrices[$rr->id_menu]['harga'] ?>"><?= $rr->nama_Menu ?></option>
                                                        <?php foreach($s as $key): ?>
                                                            <option value="<?= $key->id_menu ?>" data-harga="<?= $key->harga_menu ?>"><?= $key->nama_Menu ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <label for="totalMI" class="form-label">Total</label>
                                                    <input class="form-control total-field" name="totalM[]" style="width: 100%;" value="<?= $rr->total_menu ?>" onchange="updateTotalHarga()">
                                                </div>
                                                <div class="col-auto delete-btn">
                                                <div class="col-auto delete-btn">
                                                <button type="button" class="btn btn-danger" onclick="Delete2ProductForm(this, <?= $rr->id_transaksi ?>)">X</button>
                                                <button type="button" class="btn btn-warning" onclick="editProductForm(this, <?= $rr->id_transaksi ?>)">E</button>
                                                </div>
                                                </div>
                                                <input type="hidden" name="id[]" value="<?= $rr->Nomor ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                               

                                <?php foreach ($te as $rr): ?>
                                    <div class="row product">
                                        <div class="col">
                                            <div class="row align-items-center mb-3">
                                                <div class="col-md-5 col-lg-5">
                                                    <label for="jenis2" class="form-label">Menu Minuman</label>
                                                    <select name="jenis2[]" class="form-control" onchange="updateTotalHarga()">
                                                        <option value="<?= $rr->id_minuman ?>" data-harga="<?= $minumanPrices[$rr->id_minuman]['harga'] ?>"><?= $rr->nama_minuman ?></option>
                                                        <?php foreach($t as $key): ?>
                                                            <option value="<?= $key->id_minuman ?>" data-harga="<?= $key->harga_minuman ?>"><?= $key->nama_minuman ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-lg-4">
                                                    <label for="totalMI" class="form-label">Total</label>
                                                    <input class="form-control total-field" name="totalMI[]" style="width: 100%;" value="<?= $rr->total_minuman ?>" onchange="updateTotalHarga()">
                                                </div>
                                                <div class="col-auto delete-btn">
                                                <div class="col-auto delete-btn">
                                                <button type="button" class="btn btn-danger" onclick="Delete2ProductForm(this, <?= $rr->id_transaksi ?>)">X</button>
                                                <button type="button" class="btn btn-warning" onclick="editProductForm(this, <?= $rr->id_transaksi ?>)">E</button>
                                                </div>
                                                </div>
                                                <input type="hidden" name="id[]" value="<?= $rr->Nomor ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                              
                                <div class="mb-3 mt-3">
                                    <label for="totalHarga" class="form-label">Total Harga</label>
                                    <input type="text" class="form-control" id="totalHarga" name="totalHarga" value="<?= $sa->total_harga ?>" readonly>
                                    <div class="col-auto delete-btn">
                                    <input type="hidden" name="id" value="<?= $sa->Nomor ?>">
                                                <button type="submit" class="btn btn-success">U</button>
                                                <button type="button" class="btn btn-success" onclick="window.location.href='<?= base_url('Home/TambahEdit/' .$sa->id_transaksi) ?>'">A</button>
                                                </div>
                                </div>
                              

                    
                            </form>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </section>
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

    // Calculate initial total from PHP data
    let initialTotalHarga = 0;
    <?php foreach ($te as $rr): ?>
        // Calculate for makanan
        if (<?= $rr->id_menu ?>) {
            initialTotalHarga += (menuPrices[<?= $rr->id_menu ?>]?.harga || 0) * (parseFloat('<?= $rr->total_menu ?>') || 0);
        }

        // Calculate for minuman
        if (<?= $rr->id_minuman ?>) {
            initialTotalHarga += (minumanPrices[<?= $rr->id_minuman ?>]?.harga || 0) * (parseFloat('<?= $rr->total_minuman ?>') || 0);
        }
    <?php endforeach; ?>

    // Update Total Harga field on page load
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('totalHarga').value = initialTotalHarga.toFixed(0); // Format as a plain number without commas
    });

   

    function deleteProductForm(button) {
        let productForm = button.closest('.product');
        productForm.remove();
        updateTotalHarga();
       
    }
    function editProductForm(button, id) {
        window.location.href = '<?= base_url('home/EditOA/') ?>/' + id;
    }
    function Delete2ProductForm(button, id) {
        window.location.href = '<?= base_url('home/hapusOA/') ?>/' + id;
    }
      document.addEventListener('DOMContentLoaded', () => {
        // Calculate the initial totalHarga based on existing PHP data
        let totalHarga = 0;

        <?php foreach ($te as $rr): ?>
            // Calculate total for makanan
            if (<?= $rr->id_menu ?>) {
                const makananHarga = menuPrices[<?= $rr->id_menu ?>]?.harga || 0;
                const makananJumlah = parseFloat('<?= $rr->total_menu ?>') || 0;
                totalHarga += makananHarga * makananJumlah;
            }

            // Calculate total for minuman
            if (<?= $rr->id_minuman ?>) {
                const minumanHarga = minumanPrices[<?= $rr->id_minuman ?>]?.harga || 0;
                const minumanJumlah = parseFloat('<?= $rr->total_minuman ?>') || 0;
                totalHarga += minumanHarga * minumanJumlah;
            }
        <?php endforeach; ?>

        // Set the initial value of the totalHarga field
        document.getElementById('totalHarga').value = totalHarga.toFixed(0);

        // Update totalHarga based on form changes
        updateTotalHarga();
    });

    function updateTotalHarga() {
        // Start from the existing value of totalHarga
        let totalHarga = parseFloat(document.getElementById('totalHarga').value) || 0;

        // Calculate total for makanan
        document.querySelectorAll('#product-section-makanan .product').forEach(product => {
            const select = product.querySelector('select');
            const totalInput = product.querySelector('input[name="totalM[]"]');
            const harga = menuPrices[select.value]?.harga || 0;
            const jumlah = parseFloat(totalInput.value.replace(/\./g, '') || '0');

            totalHarga += harga * (jumlah > 0 ? jumlah : 1); // Add to totalHarga, defaulting quantity to 1 if not provided
        });

        // Calculate total for minuman
        document.querySelectorAll('#product-section-minuman .product').forEach(product => {
            const select = product.querySelector('select');
            const totalInput = product.querySelector('input[name="totalMI[]"]');
            const harga = minumanPrices[select.value]?.harga || 0;
            const jumlah = parseFloat(totalInput.value.replace(/\./g, '') || '0');

            totalHarga += harga * (jumlah > 0 ? jumlah : 1); // Add to totalHarga, defaulting quantity to 1 if not provided
        });

        // Update the totalHarga field
        document.getElementById('totalHarga').value = totalHarga.toFixed(0); // Format as a plain number without commas
    }
</script>

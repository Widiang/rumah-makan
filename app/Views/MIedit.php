<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_MIedit')?>" method="post">
                <div class="pagetitle">
                    <h1>Edit Menu</h1>
                     <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">

                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Menu</h5>

                                    <!-- General Form Elements -->
                                    <div class="mb-3 mt-3">
                                        <label for="status" class="form-label">Kategory</label>
                                        <select class="form-select" id="Kategory" name="Kategory" required>
                                            <option value="<?= $satus->Kategory ?>"><?= $satus->Kategory ?></option>
                                            <option value="Panas">Panas</option>
                                            <option value="Dingin">Dingin</option>
                                            </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                    <label for="Deskripsi" class="form-label">Nama Menu</label>
                                    <input class="form-control" id="Deskripsi" value="<?= $satus->nama_minuman ?>" name="nama"></input>
                                </div>
                                    <div class="mb-3 mt-3">
                                        <label for="jumlah" class="form-label">Harga Menu</label>
                                        <input type="text" class="form-control" id="harga"value="<?= $satus->harga_minuman ?>" name="harga">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="jumlah" class="form-label">Stok Menu</label>
                                        <input type="text" class="form-control" id="stok" value="<?= $satus->stok ?>" name="stok">
                                    </div>
                                    <div class="row mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <input type="hidden" name="id" value="<?= $satus->id_minuman ?>">
                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_t_minum')?>" method="post">
                <div class="pagetitle">
                    <h1>Menu Minuman</h1>
                     <div class="row">
                     <nav>
         <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/t_makan')?>"
                        ><i class="bx bx-drink me-1"></i> Menu Makanan</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-food-menu me-1"></i> Menu Minuman</a
                      >
      </nav>
                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">Menu Minuman</h5>

                                    <!-- General Form Elements -->

                                    
                                    <div class="mb-3 mt-3">
                                        <label for="status" class="form-label">Kategory</label>
                                        <select class="form-select" id="Kategory" name="Kategory" required>
                                            <option value="<?= $satus->Kategory ?>">Pilih</option>
                                            <option value="Panas">Panas</option>
                                            <option value="Dingin">Dingin</option>
                                            </select>
                                    </div>
                                    <div class="mb-3 mt-3">
                                    <label for="Deskripsi" class="form-label">Nama Menu</label>
                                    <input class="form-control" id="Deskripsi" name="nama"></input>
                                </div>
                                    <div class="mb-3 mt-3">
                                        <label for="jumlah" class="form-label">Harga Menu</label>
                                        <input type="text" class="form-control" id="harga" name="harga">
                                    </div>
                                    <div class="mb-3 mt-3">
                                        <label for="jumlah" class="form-label">Stok Menu</label>
                                        <input type="text" class="form-control" id="stok" name="stok">
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
    </main>
</body>
</html>

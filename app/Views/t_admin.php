<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
</head>
<body>
    <main id="main" class="main">
        <div class="container">
            <form action="<?= base_url('home/aksi_t_admin')?>" method="post">
                <div class="pagetitle">
                    <h1></h1>
                     <div class="row">
                     <nav>
                     <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">

                      <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/user')?>"
                        ><i class="bx bx-user"></i>petugas</a
                      >
                      <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/Koki')?>"
                        ><i class="bx bx-user"></i>Koki</a
                      >
<li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/admin')?>"
                        ><i class="bx bx-user"></i>admin</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/manager')?>"
                        ><i class="bx bx-user"></i> manager</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx"></i>+Tambah</a
                      >
</li>
      </nav>
                </div><!-- End Page Title -->

                <section class="section">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>

                                    <!-- General Form Elements -->

                                    <div class="mb-3 mt-3">
                                    <div class="mb-3 mt-3">
                                    <label for="Deskripsi" class="form-label">Nama</label>
                                    <input class="form-control" id="Deskripsi" name="nama"></input>
                                </div>
                                    <div class="mb-3 mt-3">
                                        <label for="jumlah" class="form-label">username</label>
                                        <input type="text" class="form-control" id="username" name="username">
                                    </div>
                                    
                                    <div class="mb-3 mt-3">
                                        <label for="status" class="form-label">Jabatan</label>
                                        <select class="form-select" id="level" name="level" required>
                                            <option value="Petugas">Pilih</option>
                                            <option value="admin">admin</option>
                                            <option value="Petugas">Petugas</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Koki">Koki</option>
                                        </select>
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

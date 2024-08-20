<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1></h1>
      <nav>
         <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                  <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-user"></i>Petugas</a
                      >
                      <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/Koki')?>"
                        ><i class="bx bx-user"></i>Koki</a
                      >
                      <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/admin')?>"
                        ><i class="bx bx-user"></i>Admin</a
                      >
</li>
<li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/manager')?>"
                        ><i class="bx bx-user"></i>Manager</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/t_admin')?>"
                        ><i class="bx bx"></i> +Tambah</a
                      >
                    </li>
                   
                      
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row justify-content-center">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">

              <div class="d-flex justify-content-between align-items-center mb-3">

                <!-- Add a search input on the right side -->
                <div class="search-container">
                  <label for="search">Search:</label>
                  <input type="text" id="search" placeholder="Enter keywords...">
                </div>
              </div>
              <?php
           $userLevel = session()->get('level');
           $allowedLevels = ['admin'];
  
           if (in_array($userLevel, $allowedLevels)) {
        ?> 
               <a href="<?= base_url("home/RestoreUser")?>">
		<button class="btn btn-success">Restore</button>
  </a>
  <?php } ?>
              <!-- Table with stripped rows -->
              <table class="table datatable" id="mitraTable">
                <thead>
                <tr style="font-weight: bold; color: black; font-size: larger;">
    <td align="center" scope="col">No</td>
    <td align="center" scope="col">Nama Petugas</td>
    <td align="center" scope="col">username</td>
    <td align="center" scope="col">Tindakan</td>
    </tr> 
                </thead>
                <tbody>
                <?php
$no = 1;
foreach ($s as $key) {
    if ($key->level === "Petugas" && $key->Soft === "Restore") { // Add this condition
?>
    <tr>
          <td align="center" scope="col"><?= $no++ ?></td>
        <td align="center" scope="col"><?= $key->nama_user?></td>
        <td align="center" scope="col"><?= $key->username?></td>
        <td align="center">
                <!-- <li class="nav-item dropdown pe-3"> -->
                <a class="btn btn-success" class="nav-link d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">tindakan</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>
                            <a href="<?= base_url('home/Pdelete/'.$key->id_user)?>">
                                <i class="btn btn-danger">delete</i>
                            </a>
                            <a href="<?= base_url('home/Reset1/'.$key->id_user)?>">
                                <i class="btn btn-warning">Reset</i>
                            </a>
                        </h6>
                        <span></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                </ul>
            </td>
      </tr>
<?php
    }
}
?>
                </tbody>
              </table>
               </div>
          </div>

        </div>
      </div>
    </section>

  </div>
</main><!-- End #main -->

<script>
  // Add JavaScript for search functionality
  document.getElementById('search').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const rows = document.querySelectorAll('#mitraTable tbody tr');

    rows.forEach(row => {
      const rowData = row.textContent.toLowerCase();
      row.style.display = rowData.includes(searchValue) ? '' : 'none';
    });
  });
</script>

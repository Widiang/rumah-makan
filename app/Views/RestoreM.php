<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1>Menu Makanan</h1>
      <nav>
         <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-food-menu me-1"></i> Menu Makanan</a
                      >
                      <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/RestoreMI')?>"
                        ><i class="bx bx-drink me-1"></i> Menu Minuman</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/RestoreUser')?>"
                        ><i class="bx bx-user"></i> User</a
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

              <!-- Table with stripped rows -->
              <table class="table datatable" id="mitraTable">
                <thead>
                <tr style="font-weight: bold; color: black; font-size: larger;">
    <td align="center" scope="col">No Menu</td>
    <td align="center" scope="col">Kategory</td>
    <td align="center" scope="col">Nama Menu</td>
    <td align="center" scope="col">Harga Menu</td>
    <td align="center" scope="col">Stok</td>
    <?php
           $userLevel = session()->get('level');
           $allowedLevels = ['Manager', 'admin'];
  
           if (in_array($userLevel, $allowedLevels)) {
        ?> 
    <td align="center" scope="col">Tindakan</td>
    <?php } ?>
</tr>

                </thead>
                <tbody>
                <?php
$no = 1;
foreach ($s as $key) {
    if ($key->Soft === "Deleted") { // Add this condition
?>
    <tr>
          <td align="center" scope="col"><?= $key->Kode?></td>
          <td align="center" scope="col"><?= $key->Kategory?></td>
        <td align="center" scope="col"><?= $key->nama_Menu?></td>
        <td align="center" scope="col">Rp <?= number_format($key->harga_menu, 0, ',', '.') ?></td>
       <td align="center" scope="col"><?= $key->Stok ?></td>
       <td align="center">
                        <h6>
                            <a href="<?= base_url('home/Mrestore/'.$key->id_menu)?>">
                                <i class="btn btn-success">Restore</i>
                            </a>
                        </h6>
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

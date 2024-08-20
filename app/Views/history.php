<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1>History</h1>
      <nav>
         <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/order')?>"
                        ><i class="bx bx-message-alt-add"></i> ORDER</a>
                      
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="<?=base_url('home/inprogress')?>"
                        ><i class="bx bx-spreadsheet me-1"></i> IN PROGRESS</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"
                        ><i class="bx bx-history me-1"></i> HISTORY</a
                      >
                      
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
                  <tr>
                    <th align="center" scope="col">No Order</th>
                    <th align="center" scope="col">Pelanggan</th>
                    <th align="center" scope="col">Petugas</th>
                    <th align="center" scope="col">Tgl. Pemesanan</th>
                    <th align="center" scope="col">Makanan</th>
                    <th align="center" scope="col">Minuman</th>
                    <th align="center" scope="col">Total harga</th>

                    <th align="center" scope="col">Pending Pembayaran</th>
                    <th align="center" scope="col">Tindakan</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php
$no = 1;
$orderDetails = [];
$displayed = [];

// Get the current username from the session
$currentUsername = session()->get('username');

// Group data by Nomor and filter by progress and username
foreach ($sa as $key) {
    if ($key->progress === "selesai") {
        $orderDetails[$key->Nomor]['Pelanggan'] = $key->user;
        $orderDetails[$key->Nomor]['Petugas'] = $key->admin;
        $orderDetails[$key->Nomor]['Tanggal'] = $key->tanggal;
        $orderDetails[$key->Nomor]['Makanan'][] = $key->nama_Menu;
        $orderDetails[$key->Nomor]['Minuman'][] = $key->nama_minuman;
        $orderDetails[$key->Nomor]['Total'] = $key->total_harga;

        $orderDetails[$key->Nomor]['pending'] = $key->pending;
    }
}

// Display data
foreach ($orderDetails as $nomor => $details) {
?>
    <tr>
        <td align="center"><?= $no++ ?></td>
        <td align="center"><?= $details['Pelanggan'] ?></td>
        <td align="center"><?= $details['Petugas'] ?></td>
        <td align="center"><?= $details['Tanggal'] ?></td>
        <td align="center">
          <select>
            <?php foreach ($details['Makanan'] as $menu) { ?>
              <option value="<?= $menu ?>"><?= $menu ?></option>
            <?php } ?>
          </select>
        </td>
        <td align="center">
          <select>
            <?php foreach ($details['Minuman'] as $minuman) { ?>
              <option value="<?= $minuman ?>"><?= $minuman ?></option>
            <?php } ?>
          </select>
        </td>
        <td align="center">Rp <?= number_format($details['Total'], 0, ',', '.') ?></td>

        <td align="center"><?= $details['pending'] ?></td>
        <td align="center">
            <a class="btn btn-success" class="nav-link d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2">Tindakan</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>
                    <a href="<?= base_url('Home/Nota1/'.$nomor)?>">
                <i class="btn btn-warning">Nota</i>
            </a>
            <a href="<?= base_url('Home/BayarF/'.$nomor)?>">
                <i class="btn btn-success">Bayar</i>
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

<main id="main" class="main">
  <div class="container">
    <div class="pagetitle">
      <h1>Order In Progress</h1>
      
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

                    <th align="center" scope="col">Tgl. Pemesanan</th>
                    <th align="center" scope="col">Makanan</th>
                    <th align="center" scope="col">Minuman</th>
                    <th align="center" scope="col">Prosess Pembuatan</th>
                    <th align="center" scope="col">Tindakan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
$no = 1;
$orderDetails = [];
$currentUsername = session()->get('username');
foreach ($sa as $key) {
    if ($key->Selesai === "Inprogress" || $key->Selesai === "pending" ) {
        $orderDetails[$key->Nomor]['Pelanggan'] = $key->user;
        $orderDetails[$key->Nomor]['Petugas'] = $key->admin;
        $orderDetails[$key->Nomor]['Tanggal'] = $key->tanggal;
        $orderDetails[$key->Nomor]['Makanan'][] = $key->nama_Menu;
        $orderDetails[$key->Nomor]['Minuman'][] = $key->nama_minuman;
        $orderDetails[$key->Nomor]['Total'] = $key->total_harga;
        $orderDetails[$key->Nomor]['Progress'] = $key->Selesai;
     // Initialize or update the total for the order
    
    }
}

foreach ($orderDetails as $nomor => $details) {
?>
    <tr>
        <td align="center"><?= $no++ ?></td>
        <td align="center"><?= $details['Pelanggan'] ?></td>
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
        <td align="center"><?= $details['Progress'] ?></td>
        <td align="center">
        <a class="btn btn-success" class="nav-link d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle ps-2">Tindakan</span>
            </a><!-- End Profile Iamge Icon -->

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>
                    <a href="<?= base_url('Home/SELESAI2/'.$nomor) ?>" class="btn btn-warning">
        SELESAI
    </a>
                        <a href="<?= base_url('Home/Terima/'.$nomor)?>">
            <i class="btn btn-success">Terima</i>
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

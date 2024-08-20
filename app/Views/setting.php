 <div class="container-xxl flex-grow-1 container-p-y">

                  <div class="card mb-4">
                 
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <div style="text-align: center;">
                    <?php if (!empty($satu->logos)): ?>
        <img src="<?= base_url('assets/img/custom/' . $satu->logos) ?>" alt="Login Icon"
             class="img-fluid mb-3 logo-login" style="max-width: 100px;">
   <?php endif; ?>
</div>

                        <div class="button-wrapper">
                       

                         
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                    <form action="<?= base_url('home/aksi_setting')?>" method="post" enctype="multipart/form-data">
                      <div class="container">
    <form>
        <div class="row mb-3">
            <label for="nama" class="col-sm-2 col-form-label">Nama Website</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $satu->nama_Logo ?>">
            </div>
        </div>
        
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image" id="image">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Upload Image Icon</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image2" id="image2">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Upload Image Banner 1</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image3" id="image2">
            </div>
        </div>
        <div class="row mb-3">
            <label for="image" class="col-sm-2 col-form-label">Upload Image Banner 2</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" name="image4" id="image2">
            </div>
        </div>
        <input type="hidden" name="id" value="<?= $satu->id_logo ?>">
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                 
<div class="container-xxl flex-grow-1 container-p-y">

<div class="card mb-4">

  <!-- Account -->
  <div class="card-body">
    <div class="d-flex align-items-start align-items-sm-center gap-4">
  <div style="text-align: center;">
<img src="<?php echo base_url('assets/img/custom/'.$user->foto)?>" id="image" style="width: 200px; height: auto;" />
</div>

      <div class="button-wrapper">
     

       
      </div>
    </div>
  </div>
  <hr class="my-0" />
  <div class="card-body">
  <form action="<?= base_url('home/aksi_Profile')?>" method="post" enctype="multipart/form-data">
    <div class="container">
<form>


<div class="row mb-3">
<label for="image" class="col-sm-2 col-form-label">Upload Image</label>
<div class="col-sm-10">
<input type="file" class="form-control" name="image" id="image">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">Nama</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="nama" id="nama" value="<?= $user->nama_user ?>">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">Username</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="nama2" id="nama" value="<?= $user-> username ?>">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">Email</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="email" id="nama" value="<?= $user-> Email ?>">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">Nomor</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="nomor" id="nama" value="<?= $user->Nomor ?>">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">password</label>
<div class="col-sm-10">
<input type="password" class="form-control" name="pass" id="nama">
</div>
</div>
<div class="row mb-3">
<label for="nama" class="col-sm-2 col-form-label">Jabatan</label>
<div class="col-sm-10">
<input type="text" class="form-control" name="level" id="nama" value="<?= $user->level ?>" readonly>
</div>
</div>

<div class="row mb-3">

<input type="hidden" name="id" value="<?= $user->id_user ?>">
      <div class="mt-2">
        <button type="submit" class="btn btn-primary me-2">Save changes</button>
      </div>
    </form>
  </div>
  <!-- /Account -->
</div>

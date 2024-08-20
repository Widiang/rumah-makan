<main id="main" class="main d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container">
        <form action="<?= base_url('home/Bayar') ?>" method="post" enctype="multipart/form-data">
            <div class="pagetitle">
                <nav>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <div class="card">
                            <div class="card-body">
                                <!-- General Form Elements -->
                                <div class="mb-3 mt-3">
                                    <label for="inputText" class="formal-label">Total Harga</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="Rp <?= $t->total_harga ?>" name="Total" readonly>
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="inputEmail" class="formal-label">Bayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="" name="bayar" >
                                    </div>
                                </div>
                               
                                <div class="row mb-3">
                                    <input type="hidden" name="id" value="<?= $t->Nomor ?>">
                                </div>
                                <div class="row mb-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                <!-- End General Form Elements -->

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

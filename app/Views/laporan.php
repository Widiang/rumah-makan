<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include your head content here -->
    <style>
        .card {
            margin-bottom: 30px;
        }

        @media (min-width: 992px) {
            .card {
                margin-left: 20px;
            }
        }

        .btn-box {
    border-radius: 11px; /* Adds a slight border radius */
    padding: 10px 20px; /* Adjust padding for a cleaner look */
    width: 80px; /* Uniform size for buttons */
    background-color: #007bff; /* Bootstrap primary color */
    color: white; /* White text color for contrast */
    border: none; /* Remove default border */
    cursor: pointer; /* Change cursor to pointer */
    margin-left: 50px; /* Adds left margin */
}


        .btn-box:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .btn-box + .btn-box {
            margin-left: 20px; /* Space between buttons */
        }

        .form-control-lg {
            padding: 15px 20px; /* Larger padding for inputs */
        }

        .col-lg-4 {
            flex: 0 0 auto;
            width: 50%; /* Adjust the column width */
        }
    </style>
</head>
<body>
    <br>
    <br>
    <main id="main" class="main">
        <div class="container">
            <div class="row">
                <!-- Print Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Print</h5>
                            <form action="<?= base_url('home/print')?>" method="post">
                                <div class="mb-3 mt-3">
                                    <label for="printStartDate" class="formal-label">TANGGALAWAL</label>
                                    <div class="row mb-3">
                                        <input type="date" class="form-control form-control-lg" name="DATE">
                                    </div>
                                </div>
                                <div class="mb-3 mt-3">
                                    <label for="printEndDate" class="formal-label">TANGGALAKHIR</label>
                                    <div class="row mb-3">
                                        <input type="date" class="form-control form-control-lg" name="DATE1">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary btn-sm btn-box">Print</button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" formaction="<?= base_url('home/PDF')?>" class="btn btn-primary btn-sm btn-box">PDF</button>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" formaction="<?= base_url('home/Excel')?>" class="btn btn-primary btn-sm btn-box">Excel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

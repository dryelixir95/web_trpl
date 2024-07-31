<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRPL POLIWANGI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5cc;
        }
        .header {
            background-color: #ffeb3b;
            color: #000;
            padding: 30px 0;
        }
        .header h1 {
            margin: 0;
            padding: 0 20px;
            font-weight: bold;
        }
        .header img {
            height: 50px;
        }
        .navbar-nav a {
            color: #000 !important;
            font-weight: bold;
        }
        .hero-section {
            background-color: #0046ad;
            padding: 50px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 3em;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2em;
            margin: 20px 0;
        }
        .hero-section .btn-primary, .hero-section .btn-secondary {
            margin-top: 20px;
        }
        .learning-section {
            padding: 50px 0;
        }
        .learning-section h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        .learning-section .card {
            margin: 0 15px;
        }
        footer {
            margin-top: 50px;
        }
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .custom-footer {
            background-color: #0046ad;
            color: white;
            padding: 20px 0;
        }
        .custom-footer .footer-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .custom-footer .footer-section {
            margin: 10px;
            flex: 1;
            min-width: 200px;
        }
        .custom-footer .footer-section h3 {
            margin-bottom: 10px;
        }
        .custom-footer .footer-section p,
        .custom-footer .footer-section a {
            color: white;
            text-decoration: none;
            line-height: 1.6;
        }
        .custom-footer .footer-section a:hover {
            text-decoration: underline;
        }
        .custom-footer .footer-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .custom-footer .footer-icons img {
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('public.navbar')
    <!-- Akhir Navbar -->

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h2><u>Berita Terbaru</u></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" style="width: 100%; height: 200px;" class="card-img-top" alt="Lab 1">
                        <div class="card-body">
                            <h4 class="card-title">Berita 1</h4>
                            <p>Keterangan berita 1</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" style="width: 100%; height: 200px;" class="card-img-top" alt="Lab 1">
                        <div class="card-body">
                            <h5 class="card-title">Berita 2</h5>
                            <p>Keterangan berita 2</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" style="width: 100%; height: 200px;" class="card-img-top" alt="Lab 1">
                        <div class="card-body">
                            <h5 class="card-title">Berita 3</h5>
                            <p>Keterangan berita 3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Hero Section -->

    <!-- Learning Section -->
    <div class="learning-section">
        <div class="container">
            <h2><u>Fasilitas</u></h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 1">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 1</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 2">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 2</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/300" class="card-img-top" alt="Lab 3">
                        <div class="card-body">
                            <h5 class="card-title">Lab. 3</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Learning Section -->
    <div class="learning-section">
        <div class="container">
            <h2><u>Sejarah TRPL</u></h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        </div>
    </div>
    <div class="learning-section">
        <div class="container">
            <h2><u>Visi TRPL</u></h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        </div>
    </div>
    <div class="learning-section">
        <div class="container">
            <h2><u>Misi TRPL</u></h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        </div>
    </div>
    <!-- Footer -->
    @include('public.footer')
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

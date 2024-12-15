<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('/image/tol.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
        }

        .blue-trapezium {
            position: absolute;
            top: 0;
            left: 0;
            width: 70%;
            height: 100%;
            background-color: #6c757d;
            clip-path: polygon(0 0, 85% 0, 65% 100%, 0 100%);
            color: white;
            padding: 20px;
        }

        .blue-trapezium h1 {
            font-size: 2.5rem;
            margin-top: 300px;
            margin-left: 50px;
        }

        .blue-trapezium p {
            font-size: 1rem;
            margin-bottom: 15px;
            margin-left: 50px;
        }

        .blue-trapezium .btn-start {
            background-color: white;
            color: #6c757d;
            border: none;
            padding: 8px 16px;
            font-size: 1rem;
            font-weight: bold;
        }

        .blue-trapezium .btn-start:hover {
            background-color: #e2e6ea;
        }

        .floating-buttons {
            position: fixed;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .floating-buttons .btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #6c757d;
            color: white;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-buttons .btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="blue-trapezium">
        <h1>Pengaduan Masyarakat</h1>
        <p>Selamat datang di platform pengaduan masyarakat. Sampaikan keluhan atau masukan Anda <br> untuk membantu menciptakan lingkungan yang lebih baik.</p>
        <button class="btn btn-start ms-5" onclick="window.location.href='login';">Mulai Pengaduan</button>
    </div>

    <div class="floating-buttons">
        <button class="btn" title="Home"><i class="fas fa-home"></i></button>
        <button class="btn" title="Info"><i class="fas fa-info-circle"></i></button>
        <button class="btn" title="Pengaduan"><i class="fas fa-comments"></i></button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

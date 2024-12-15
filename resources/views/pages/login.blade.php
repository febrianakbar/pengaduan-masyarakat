<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login atau Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f7f8fc;
            font-family: 'Poppins', sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
            padding: 30px;
        }
        h2 {
            font-weight: 600;
            font-size: 1.8rem;
            color: #495057;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #dee2e6;
            padding: 12px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 5px rgba(108, 117, 125, 0.3);
        }
        .btn {
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-primary {
            background-color: #6c757d;
            border: none;
            color: #fff;
        }
        .btn-primary:hover {
            background-color: #5a6268;
            transform: scale(1.05);
        }
        .btn-secondary {
            background-color: #adb5bd;
            border: none;
            color: #fff;
        }
        .btn-secondary:hover {
            background-color: #868e96;
            transform: scale(1.05);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="container">
        <div class="card mx-auto" style="max-width: 400px;">
            <h2>Login atau Register</h2>
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email Anda" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" name="action" value="login" class="btn btn-primary w-45 py-2">Login</button>
                    <button type="submit" name="action" value="register" class="btn btn-secondary w-45 py-2">Register</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

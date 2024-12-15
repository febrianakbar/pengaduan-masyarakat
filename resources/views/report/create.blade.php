<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('/image/tol.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .form-container {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            width: 45%;
            background: #ffffff; /* Warna solid putih */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }

        .form-container h2 {
            font-weight: bold;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 20px;
        }

        .btn-submit {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-submit:hover {
            background-color: #5a6268;
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

    <div class="form-container">
        <h2>Form Pengaduan</h2>
        <form action="{{ url('/report') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="province" class="form-label">Provinsi*</label>
                <select class="form-select" id="province" name="province" required>
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="regency" class="form-label">Kota/Kabupaten*</label>
                <select class="form-select" id="regency" name="regency" required>
                    <option value="">Pilih Kota/Kabupaten</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="subdistrict" class="form-label">Kecamatan*</label>
                <select class="form-select" id="subdistrict" name="subdistrict" required>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="village" class="form-label">Kelurahan*</label>
                <select class="form-select" id="village" name="village" required>
                    <option value="">Pilih Kelurahan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type*</label>
                <select class="form-select" id="type" name="type" required>
                    <option value="KEJAHATAN">KEJAHATAN</option>
                    <option value="PEMBANGUNAN">PEMBANGUNAN</option>
                    <option value="SOSIAL">SOSIAL</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Detail Keluhan*</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Pendukung</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-submit w-100">Submit</button>
        </form>
    </div>
    
    <div class="floating-buttons">
        <button class="btn" title="Home"><i class="fas fa-home"></i></button>
        <button class="btn" title="Info"><i class="fas fa-info-circle"></i></button>
        <button class="btn" title="Pengaduan"><i class="fas fa-comments"></i></button>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('province');
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    provinceSelect.appendChild(option);
                });
            });

        document.getElementById('province').addEventListener('change', function() {
            const provinceId = this.value;
            const regencySelect = document.getElementById('regency');
            regencySelect.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>'; 

            if (provinceId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(regency => {
                            const option = document.createElement('option');
                            option.value = regency.id;
                            option.textContent = regency.name;
                            regencySelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('regency').addEventListener('change', function() {
            const regencyId = this.value;
            const subdistrictSelect = document.getElementById('subdistrict');
            subdistrictSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';

            if (regencyId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${regencyId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subdistrict => {
                            const option = document.createElement('option');
                            option.value = subdistrict.id;
                            option.textContent = subdistrict.name;
                            subdistrictSelect.appendChild(option);
                        });
                    });
            }
        });

        document.getElementById('subdistrict').addEventListener('change', function() {
            const subdistrictId = this.value;
            const villageSelect = document.getElementById('village');
            villageSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

            if (subdistrictId) {
                fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${subdistrictId}.json`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(village => {
                            const option = document.createElement('option');
                            option.value = village.id;
                            option.textContent = village.name;
                            villageSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
</body>
</html>
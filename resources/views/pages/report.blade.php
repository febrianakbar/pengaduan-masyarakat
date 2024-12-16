<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Halaman Report</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>  
        .sidebar {  
            position: fixed;  
            top: 180px;  
            right: 350px;  
            width: 40%;  
            border-radius: 8px;  
            z-index: 1000;  
            transform: translateX(50%);  
        }  
        .main-content {  
            margin-right: 340px;  
            padding-right: 20px;  
        }  
        .card-js {  
            display: flex;  
            flex-direction: row;  
            align-items: center;  
            justify-content: space-between;  
            width: 60%;  
            padding: 15px;  
            margin-bottom: 20px;  
            border: 1px solid #ddd;  
            border-radius: 8px;  
            background-color: #fff;  
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
        }  
        .card-js img {  
            width: 30%;  
            height: auto;  
            object-fit: cover;  
            flex-shrink: 0;  
        }  
        .card-js p {  
            margin-bottom: 10px;  
        }  
        .search-container {  
            display: flex;  
            gap: 10px;  
            margin-bottom: 20px;  
            align-items: center;  
        }  
        .container {  
            margin-left: 50px;  
        }  
        .btn-primary {  
            width: 60px;  
            height: 60px;
            margin-top: 15px;
            margin-left: 550px;  
            padding: 0;  
            text-align: center;  
            background-color: #007bff;  
            color: white;  
            border: none;  
            border-radius: 50%;  
            font-size: 24px;  
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  
            transition: background-color 0.3s, transform 0.3s;  
        }  
        .btn-primary:hover {  
            background-color: #0056b3;  
            transform: translateY(-4px);  
        }
        .sidebar .btn-primary i {
            font-size: 28px;
        }
        .card-body-left-margin {
            margin-left: 15px;
        }
        .text-description {
            font-size: 14px; 
            font-weight: bold; 
            text-decoration: underline; 
            color: #000; 
            display: inline-block; 
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden; 
            text-overflow: ellipsis; 
        }
        .card-js .bi-eye {
            margin-right: 5px;
            color: #007bff; 
        }
        .card-js .bi-heart {
            margin-right: 5px;
            color: #e25555; 
            cursor: pointer; 
        }
        .card-js span {
            display: inline-block;
            margin-right: 10px;
        }
        .alert {
            margin-right: 525px; 
        }
    </style>  
</head>  
<body>  
    <div class="container my-4 main-content">  
        @if(Session::get('success'))  
            <div class="alert alert-success">  
                {{ Session::get('success') }}  
            </div>  
        @endif  
        @if($errors->any())  
            <div class="alert alert-danger">  
                <ul>  
                    @foreach($errors->all() as $error)  
                        <li>{{ $error }}</li>  
                    @endforeach  
                </ul>  
            </div>  
        @endif  

        <div class="search-container">  
            <select class="form-select w-50" id="searchDropdown">  
                <option selected>Pilih Daerah</option>  
            </select>  
            <button class="btn btn-secondary" id="searchButton">Cari</button>  
        </div>  

        <div id="reportsContainer" class="row row-cols-1 g-4">  
            @foreach ($reports as $report)
            <div class="card-js mb-3">
                <img src="{{ asset('storage/'.$report->image) }}" alt="Image for {{ $report->title }}" style="margin-bottom: 15px;">
                <div class="card-body card-body-left-margin">
                    <h6>
                        <a href="{{ route('report.show', $report->id) }}" class="text-description">
                            {{ $report->description }}
                        </a>
                    </h6>
                    <p>Email: {{ $report->user->email ?? 'Email tidak tersedia' }}</p>
                    <small>Dibuat pada: {{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</small> <br>
                    <form action="{{ route('report.vote', $report->id) }}" method="POST" style="display: inline;" id="voteForm{{ $report->id }}">
                        @csrf
                    </form>
                    <span>
                        <i class="bi bi-heart" onclick="document.getElementById('voteForm{{ $report->id }}').submit();"></i>
                        {{ $report->votes }} Votes
                    </span>
                    <span><i class="bi bi-eye"></i> {{ $report->viewers }} Viewers</span>        
                </div>
            </div>
            @endforeach
        </div>
    </div>  

    <div class="sidebar">  
        <div class="card">  
            <div class="card-header bg-warning text-dark fw-bold">  
                Informasi Pembuatan Pengaduan  
            </div>  
            <div class="card-body">  
                <ol>  
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>  
                    <li>Keseluruhan data pada pengaduan bernilai <b>BENAR</b> dan <b>DAPAT DIPERTANGGUNG JAWABKAN</b>.</li>  
                    <li>Seluruh bagian data perlu diisi.</li>  
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>  
                    <li>Periksa tanggapan Kami, pada <b>Dashboard</b> setelah Anda <b>Login</b>.</li>  
                    <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="#" class="text-primary">Ikuti Tautan</a>.</li>  
                </ol>  
            </div>  
        </div>  
        <button class="btn btn-primary" onclick="location.href='{{ route('report.create') }}'">  
            <i class="bi bi-pencil fs-3"></i>  
        </button>  
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>  
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>  
    <script>  
        $(document).ready(function () {  
            $.ajax({  
                url: 'https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json',  
                method: 'GET',  
                success: function (data) {  
                    const dropdown = $('#searchDropdown');  
                    data.forEach(function (provinsi) {  
                        dropdown.append(`<option value="${provinsi.name}">${provinsi.name}</option>`);  
                    });  
                },  
                error: function () {  
                    console.error('Error fetching provinces');  
                }  
            });  

            $('#searchButton').on('click', function () {  
                const provinceName = $('#searchDropdown').val();  

                if (provinceName === "Pilih Daerah") {  
                    alert('Pilih provinsi terlebih dahulu!');  
                    return;  
                }  

                $.ajax({  
                    url: '{{ route('report.search') }}',  
                    method: 'GET',  
                    data: { province_name: provinceName },  
                    success: function (data) {  
                        const reportsContainer = $('#reportsContainer');  
                        reportsContainer.empty();  

                        if (data.length === 0) {  
                            reportsContainer.append('<p class="text-center">Tidak ada laporan ditemukan untuk provinsi ini.</p>');  
                        } else {  
                            location.reload();  
                        }  
                    },  
                    error: function () {  
                        console.error('Error fetching reports');  
                        alert('Terjadi kesalahan saat memuat laporan. Coba lagi nanti.');  
                    }  
                });  
            });  
        });  
    </script>  
</body>  
</html>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-export {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            cursor: pointer;
            float: right;
        }
        .btn-export:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h2>Dashboard Pengaduan</h2>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <div class="mb-2">
                <a href="#" class="btn btn-export">Export Laporan</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Gambar & Pengirim</th>
                        <th>Lokasi & Tanggal</th>
                        <th>Deskripsi</th>
                        <th>Vote</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$report->image) }}" alt="Image" width="50" height="50" class="rounded-circle"> {{ $report->user->email }}
                        </td>


                        <td>
                            {{ $report->location }}
                            {{ \Carbon\Carbon::parse($report->created_at)->format('d F Y') }}
                        </td>

                        <td>{{ $report->description }}</td>

                        <td>{{ $report->votes }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#actionModal" 
                                    data-id="{{ $report->id }}">
                                Tindak Lanjut
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actionModalLabel">Tindak Lanjut</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('staff.report') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="report_id" id="modalReportId">
                        <div class="mb-3">
                            <label for="response" class="form-label">Tanggapan</label>
                            <select name="response" id="response" class="form-select" required>
                                <option value="">Pilih Tanggapan</option>
                                <option value="Tolak">Tolak</option>
                                <option value="Proses Penyelesaian/Perbaikan">Proses Penyelesaian/Perbaikan</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Buat</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    <!-- Script Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Isi data ke modal saat tombol diklik
        var actionModal = document.getElementById('actionModal');
        actionModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Tombol yang diklik
            var reportId = button.getAttribute('data-id'); // Ambil ID report
    
            // Isi hidden input di dalam modal
            document.getElementById('modalReportId').value = reportId;
        });
    </script>
</body>
</html>

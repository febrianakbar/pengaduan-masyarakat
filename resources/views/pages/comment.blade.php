<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 8px;
        }
        .card-body {
            background-color: #ffffff;
        }
        .container {
            max-width: 800px;
        }
        .comment-card {
            border-left: 4px solid #007bff;
        }
        .comment-date {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .form-control, .btn {
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4 text-center text-primary">Comment</h1>

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-uppercase font-weight-bold">Deskripsi</h5>
                <p class="card-text">{{ $report->description }}</p>
                <p><strong>Email Pengirim:</strong> {{ $report->user->email ?? 'Tidak tersedia' }}</p>
                <p><strong>Tanggal Dibuat:</strong> {{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y') }}</p>
            </div>
        </div>

        <div class="mb-4">
            <h5>Tambahkan Komentar</h5>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="Tambahkan komentar" required></textarea>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
        </div>

        <h5 class="mt-4">Komentar</h5>
        @if ($report->comments->isEmpty())
            <p class="text-muted">Belum ada komentar.</p>
        @else
            @foreach ($report->comments as $comment)
                <div class="card mb-2 comment-card">
                    <div class="card-body">
                        <small class="comment-date">Dibuat pada: {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</small>
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            @endforeach
        @endif

        <a href="{{ route('pages.report') }}" class="btn btn-secondary mt-4">Kembali ke Dashboard</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="mb-4">Detail Laporan</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Deskripsi</h5>
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

        <h5>Komentar</h5>
        @if ($report->comments->isEmpty())
            <p class="text-muted">Belum ada komentar.</p>
        @else
            @foreach ($report->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p>{{ $comment->content }}</p>
                        <small>Dibuat pada: {{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y') }}</small>
                    </div>
                </div>
            @endforeach
        @endif

        <a href="{{ route('pages.report') }}" class="btn btn-secondary mt-4">Kembali ke Dashboard</a>
    </div>
</body>
</html>

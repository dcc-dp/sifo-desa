<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | SIFO DESA</title>
    <!-- Google Fonts & Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        .error-card {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            max-width: 540px;
            width: 100%;
            padding: 45px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .error-card::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.25) 0%, rgba(59, 130, 246, 0) 70%);
            z-index: 0;
            pointer-events: none;
        }

        .error-icon-wrapper {
            position: relative;
            z-index: 1;
            width: 96px;
            height: 96px;
            background: rgba(59, 130, 246, 0.12);
            border: 2px solid rgba(59, 130, 246, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            color: #3b82f6;
            font-size: 2.6rem;
        }

        .error-code {
            font-size: 1.05rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: #3b82f6;
            text-transform: uppercase;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .error-title {
            font-size: 1.85rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }

        .error-desc {
            font-size: 0.95rem;
            color: #94a3b8;
            line-height: 1.6;
            margin-bottom: 32px;
            position: relative;
            z-index: 1;
        }

        .btn-group-custom {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }

        .btn-home {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
        }

        .btn-home:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.08);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="error-card">
        <div class="error-icon-wrapper">
            <i class="fas fa-compass"></i>
        </div>
        <div class="error-code">Error 404 Not Found</div>
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        <p class="error-desc">
            Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.
        </p>
        <div class="btn-group-custom">
            <a href="{{ url('/dashboard') }}" class="btn-home">
                <i class="fas fa-house me-2"></i> Ke Dashboard
            </a>
            <button onclick="window.history.back()" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </button>
        </div>
    </div>
</body>

</html>
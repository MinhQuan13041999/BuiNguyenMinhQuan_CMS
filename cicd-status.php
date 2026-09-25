<?php
/**
 * Trang Kiểm Tra Trạng Thái Triển Khai CI/CD Tự Động (CI/CD Status Dashboard)
 * Dùng để demo trực tiếp khi thuyết trình:
 * Mỗi lần push code lên GitHub, GitHub Actions sẽ tự động cập nhật trang này lên Hosting.
 */
header('Content-Type: text/html; charset=utf-8');

$app_version = "v1.1.0 - Production";
$build_time = date("d/m/Y H:i:s T");
$environment = (strpos($_SERVER['HTTP_HOST'] ?? '', 'localhost') !== false) ? 'Local Development (WAMP)' : 'Cloud Server (Live Production)';
$author = "Bùi Nguyên Minh Quân - 24211TT1178";
$status_badge = "DEPLOYED VIA GITHUB ACTIONS CI/CD";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống CI/CD Tự Động - Trạng Thái Triển Khai</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --primary: #3b82f6;
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            --success: #10b981;
            --success-glow: rgba(16, 185, 129, 0.25);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(139, 92, 246, 0.15) 0px, transparent 50%);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 680px;
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .badge-live {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(16, 185, 129, 0.12);
            color: var(--success);
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 0.825rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            border: 1px solid rgba(16, 185, 129, 0.3);
            box-shadow: 0 0 15px var(--success-glow);
        }

        .badge-pulse {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }

        h1 {
            font-size: 1.85rem;
            font-weight: 800;
            background: linear-gradient(to right, #ffffff, #cbd5e1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
        }

        p.subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin: 28px 0;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 16px 20px;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            border-color: rgba(59, 130, 246, 0.3);
            background: rgba(255, 255, 255, 0.05);
        }

        .stat-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .stat-value {
            font-size: 1.05rem;
            font-weight: 700;
            color: #f1f5f9;
            font-family: 'JetBrains Mono', monospace;
        }

        .pipeline-box {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 16px;
            padding: 20px;
            margin-top: 24px;
        }

        .pipeline-step {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 0.9rem;
        }

        .pipeline-step:last-child {
            margin-bottom: 0;
        }

        .step-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(59, 130, 246, 0.15);
            color: #60a5fa;
            font-size: 0.85rem;
            font-weight: 700;
        }

        .footer-note {
            text-align: center;
            margin-top: 28px;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .action-link {
            display: inline-block;
            margin-top: 20px;
            background: var(--primary-gradient);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.95rem;
            text-align: center;
            box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);
            transition: transform 0.2s ease;
        }

        .action-link:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>CI/CD Deployment Status</h1>
                <p class="subtitle">Hệ Thống Triển Khai Tự Động Lên Cloud Server</p>
            </div>
            <div class="badge-live">
                <span class="badge-pulse"></span>
                <span>ONLINE LIVE</span>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Phiên Bản Bản Build</div>
                <div class="stat-value" id="demo-version"><?php echo htmlspecialchars($app_version); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Môi Trường Chạy</div>
                <div class="stat-value"><?php echo htmlspecialchars($environment); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Thời Điểm Cập Nhật</div>
                <div class="stat-value"><?php echo htmlspecialchars($build_time); ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Tác Giả / Sinh Viên</div>
                <div class="stat-value"><?php echo htmlspecialchars($author); ?></div>
            </div>
        </div>

        <div class="pipeline-box">
            <div class="pipeline-step">
                <div class="step-icon">1</div>
                <div><strong>Continuous Integration (CI):</strong> Tự động kiểm tra cú pháp PHP 8.2 (Lint & Syntax Test).</div>
            </div>
            <div class="pipeline-step">
                <div class="step-icon">2</div>
                <div><strong>Continuous Deployment (CD):</strong> Tự động đồng bộ mã nguồn lên Cloud Hosting qua FTP/SFTP.</div>
            </div>
            <div class="pipeline-step">
                <div class="step-icon">3</div>
                <div><strong>Single Source of Truth:</strong> Thành viên nhóm chỉ cần truy cập URL này là thấy bản cập nhật mới ngay lập tức.</div>
            </div>
        </div>

        <div style="text-align: center;">
            <a href="index.php" class="action-link">👉 Truy Cập Trang Chủ WordPress CMS</a>
        </div>

        <div class="footer-note">
            Dự án: <strong>BuiNguyenMinhQuan_CMS</strong> • Tự động hóa hoàn toàn với <strong>GitHub Actions</strong>
        </div>
    </div>
</body>
</html>

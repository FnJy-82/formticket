<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Cloud Computing 2025') · Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue-600: #2563eb;
            --blue-700: #1d4ed8;
            --blue-50: #eff6ff;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg: #f1f5f9;
            --danger: #dc2626;
            --success: #16a34a;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; }
        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(900px 500px at 10% -10%, #dbeafe 0%, transparent 60%),
                radial-gradient(800px 500px at 100% 110%, #e0e7ff 0%, transparent 60%),
                var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            -webkit-font-smoothing: antialiased;
        }
        .card {
            width: 100%;
            max-width: 440px;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 20px 50px -12px rgba(15, 23, 42, .18), 0 2px 6px rgba(15, 23, 42, .06);
            overflow: hidden;
            animation: rise .45s ease both;
        }
        @keyframes rise { from { opacity: 0; transform: translateY(14px); } to { opacity: 1; transform: none; } }
        .card-head {
            background: linear-gradient(135deg, var(--blue-600), #4f46e5);
            color: #fff;
            padding: 30px 28px 26px;
            text-align: center;
            position: relative;
        }
        .card-head::after {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(260px 120px at 85% 0%, rgba(255,255,255,.22), transparent 70%);
            pointer-events: none;
        }
        .badge {
            width: 52px; height: 52px; border-radius: 14px; margin: 0 auto 14px;
            background: rgba(255,255,255,.18); display: grid; place-items: center;
            backdrop-filter: blur(4px);
        }
        .badge svg { width: 28px; height: 28px; }
        .card-head h1 { margin: 0; font-size: 22px; font-weight: 700; letter-spacing: -.01em; }
        .card-head p { margin: 6px 0 0; font-size: 13px; opacity: .85; }
        .card-body { padding: 26px 28px 30px; }

        .field { margin-bottom: 16px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #1e293b; }
        .control { position: relative; }
        input[type=text], input[type=email], input[type=password], input[type=date] {
            width: 100%; font: inherit; font-size: 14px; color: var(--ink);
            padding: 11px 13px; border: 1px solid var(--line); border-radius: 10px; background: #fff;
            transition: border-color .15s, box-shadow .15s;
        }
        input::placeholder { color: #94a3b8; }
        input:focus { outline: none; border-color: var(--blue-600); box-shadow: 0 0 0 4px rgba(37, 99, 235, .14); }
        input.invalid { border-color: var(--danger); }
        input.invalid:focus { box-shadow: 0 0 0 4px rgba(220, 38, 38, .12); }
        .error { color: var(--danger); font-size: 12.5px; margin-top: 6px; }
        .hint { color: var(--muted); font-size: 12px; margin-top: 6px; }

        .toggle {
            position: absolute; right: 8px; top: 50%; transform: translateY(-50%);
            border: 0; background: none; cursor: pointer; color: var(--muted);
            font: inherit; font-size: 12px; font-weight: 600; padding: 6px 8px; border-radius: 6px;
        }
        .toggle:hover { color: var(--blue-600); background: var(--blue-50); }
        .control.has-toggle input { padding-right: 58px; }

        .meter { display: flex; gap: 4px; margin-top: 8px; }
        .meter span { flex: 1; height: 4px; border-radius: 4px; background: var(--line); transition: background .2s; }
        .meter[data-level="1"] span:nth-child(-n+1) { background: #ef4444; }
        .meter[data-level="2"] span:nth-child(-n+2) { background: #f59e0b; }
        .meter[data-level="3"] span:nth-child(-n+3) { background: #84cc16; }
        .meter[data-level="4"] span:nth-child(-n+4) { background: var(--success); }

        .btn {
            width: 100%; margin-top: 6px; border: 0; cursor: pointer; font: inherit;
            font-size: 15px; font-weight: 600; color: #fff; padding: 13px 16px; border-radius: 10px;
            background: linear-gradient(135deg, var(--blue-600), var(--blue-700));
            box-shadow: 0 8px 18px -6px rgba(37, 99, 235, .55);
            transition: transform .12s, box-shadow .12s, filter .12s;
        }
        .btn:hover { transform: translateY(-1px); filter: brightness(1.05); }
        .btn:active { transform: translateY(0); }
        .btn[disabled] { opacity: .7; cursor: progress; transform: none; }
        .btn-link {
            display: inline-block; text-decoration: none; text-align: center;
        }

        .alert {
            border-radius: 10px; padding: 11px 13px; font-size: 13px; margin-bottom: 18px;
            background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;
        }

        .status { text-align: center; }
        .status .icon {
            width: 64px; height: 64px; border-radius: 50%; margin: 4px auto 16px;
            display: grid; place-items: center; font-size: 30px;
        }
        .icon.ok { background: #dcfce7; color: var(--success); }
        .icon.warn { background: #fef3c7; color: #d97706; }
        .icon.bad { background: #fee2e2; color: var(--danger); }
        .icon.mail { background: var(--blue-50); color: var(--blue-600); }
        .status h2 { margin: 0 0 8px; font-size: 20px; letter-spacing: -.01em; }
        .status p { margin: 0 0 18px; color: var(--muted); font-size: 14px; line-height: 1.6; }
        .status strong { color: var(--ink); }

        .foot { text-align: center; font-size: 12px; color: var(--muted); margin-top: 18px; }
        .wrap { width: 100%; max-width: 440px; }

        @media (max-width: 480px) {
            .card-body { padding: 22px 20px 26px; }
            .card-head { padding: 26px 20px 22px; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <main class="card">
            <header class="card-head">
                <div class="badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 18a4.5 4.5 0 0 1-.6-8.96A6 6 0 0 1 18 8.5a4 4 0 0 1-.5 7.97"/>
                        <path d="M7 18h10.5"/>
                    </svg>
                </div>
                <h1>Cloud Computing 2025</h1>
                <p>@yield('subtitle', 'Registration Form')</p>
            </header>
            <div class="card-body">
                @yield('content')
            </div>
        </main>
        <div class="foot">&copy; {{ date('Y') }} Cloud Computing Class</div>
    </div>
    @stack('scripts')
</body>
</html>

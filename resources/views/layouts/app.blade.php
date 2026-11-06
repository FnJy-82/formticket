<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('concert.name')) · Tickets</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --violet: #7c3aed;
            --violet-dark: #6d28d9;
            --pink: #db2777;
            --night: #1e1b4b;
            --ink: #0f172a;
            --muted: #64748b;
            --line: #e2e8f0;
            --bg: #0f0a24;
            --danger: #dc2626;
            --success: #16a34a;
        }
        * { box-sizing: border-box; }
        html, body { margin: 0; }
        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
            color: var(--ink);
            background:
                radial-gradient(700px 420px at 15% -5%, rgba(124, 58, 237, .55), transparent 65%),
                radial-gradient(650px 420px at 95% 105%, rgba(219, 39, 119, .45), transparent 65%),
                var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            -webkit-font-smoothing: antialiased;
        }
        .wrap { width: 100%; max-width: 460px; }
        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 30px 70px -15px rgba(0, 0, 0, .55);
            overflow: hidden;
            animation: rise .5s ease both;
        }
        @keyframes rise { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: none; } }

        .card-head {
            position: relative;
            color: #fff;
            text-align: center;
            padding: 30px 26px 26px;
            background: linear-gradient(135deg, var(--night) 0%, var(--violet) 55%, var(--pink) 120%);
            overflow: hidden;
        }
        .card-head::before, .card-head::after {
            content: ''; position: absolute; border-radius: 50%; pointer-events: none;
        }
        .card-head::before { width: 220px; height: 220px; right: -70px; top: -90px; background: rgba(255,255,255,.12); }
        .card-head::after { width: 150px; height: 150px; left: -50px; bottom: -80px; background: rgba(255,255,255,.08); }
        .badge {
            position: relative; z-index: 1;
            width: 54px; height: 54px; border-radius: 16px; margin: 0 auto 14px;
            background: rgba(255,255,255,.18); display: grid; place-items: center;
            backdrop-filter: blur(4px);
        }
        .badge svg { width: 28px; height: 28px; }
        .card-head h1 { position: relative; z-index: 1; margin: 0; font-size: 26px; font-weight: 800; letter-spacing: -.02em; }
        .card-head .tag { position: relative; z-index: 1; margin: 6px 0 0; font-size: 13px; opacity: .85; }
        .chips { position: relative; z-index: 1; display: flex; flex-wrap: wrap; gap: 8px; justify-content: center; margin-top: 16px; }
        .chip {
            font-size: 12px; font-weight: 500; padding: 6px 11px; border-radius: 999px;
            background: rgba(255,255,255,.16); border: 1px solid rgba(255,255,255,.22);
        }
        .card-body { padding: 26px 28px 30px; }

        .section-title { font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; color: var(--muted); margin: 0 0 14px; }
        .field { margin-bottom: 16px; }
        .row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #1e293b; }
        input[type=text], input[type=email], input[type=tel], input[type=date], select {
            width: 100%; font: inherit; font-size: 14px; color: var(--ink);
            padding: 11px 13px; border: 1px solid var(--line); border-radius: 10px; background: #fff;
            transition: border-color .15s, box-shadow .15s;
        }
        select {
            appearance: none; cursor: pointer; padding-right: 36px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat; background-position: right 12px center;
        }
        input::placeholder { color: #94a3b8; }
        input:focus, select:focus { outline: none; border-color: var(--violet); box-shadow: 0 0 0 4px rgba(124, 58, 237, .15); }
        .invalid { border-color: var(--danger) !important; }
        .error { color: var(--danger); font-size: 12.5px; margin-top: 6px; }
        .hint { color: var(--muted); font-size: 12px; margin-top: 6px; }

        .stepper { display: flex; align-items: center; border: 1px solid var(--line); border-radius: 10px; overflow: hidden; background: #fff; }
        .stepper button {
            width: 42px; height: 42px; border: 0; background: #f8fafc; cursor: pointer;
            font-size: 18px; font-weight: 600; color: var(--violet); transition: background .12s;
        }
        .stepper button:hover { background: #ede9fe; }
        .stepper input {
            flex: 1; min-width: 0; text-align: center; border: 0; border-radius: 0; padding: 11px 0;
            font-weight: 600; -moz-appearance: textfield;
        }
        .stepper input:focus { box-shadow: none; }
        .stepper input::-webkit-outer-spin-button, .stepper input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }

        .summary {
            display: flex; justify-content: space-between; align-items: center;
            background: linear-gradient(135deg, #f5f3ff, #fdf2f8);
            border: 1px solid #e9d5ff; border-radius: 12px; padding: 14px 16px; margin: 4px 0 16px;
        }
        .summary .lbl { font-size: 12px; color: var(--muted); }
        .summary .sub { font-size: 13px; font-weight: 600; margin-top: 2px; }
        .summary .total { font-size: 21px; font-weight: 800; color: var(--violet-dark); letter-spacing: -.01em; }

        .btn {
            width: 100%; border: 0; cursor: pointer; font: inherit; font-size: 15px; font-weight: 700; color: #fff;
            padding: 14px 16px; border-radius: 11px;
            background: linear-gradient(135deg, var(--violet), var(--pink));
            box-shadow: 0 10px 22px -8px rgba(124, 58, 237, .7);
            transition: transform .12s, filter .12s;
        }
        .btn:hover { transform: translateY(-1px); filter: brightness(1.06); }
        .btn:active { transform: none; }
        .btn[disabled] { opacity: .7; cursor: progress; transform: none; }
        .btn-link { display: inline-block; text-decoration: none; text-align: center; }

        .alert { border-radius: 10px; padding: 11px 13px; font-size: 13px; margin-bottom: 18px; background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .status { text-align: center; }
        .status .icon { width: 66px; height: 66px; border-radius: 50%; margin: 2px auto 16px; display: grid; place-items: center; font-size: 30px; }
        .icon.ok { background: #dcfce7; color: var(--success); }
        .icon.warn { background: #fef3c7; color: #d97706; }
        .icon.bad { background: #fee2e2; color: var(--danger); }
        .icon.mail { background: #ede9fe; color: var(--violet); }
        .status h2 { margin: 0 0 8px; font-size: 21px; letter-spacing: -.01em; }
        .status p { margin: 0 0 18px; color: var(--muted); font-size: 14px; line-height: 1.6; }
        .status strong { color: var(--ink); }

        .ticket {
            text-align: left; margin: 0 0 20px; border: 1px dashed #c4b5fd; border-radius: 14px;
            background: #faf5ff; padding: 16px 18px; font-size: 13.5px;
        }
        .ticket .code { font-size: 11px; letter-spacing: .08em; text-transform: uppercase; color: var(--muted); }
        .ticket .code b { display: block; font-size: 22px; letter-spacing: .06em; color: var(--violet-dark); margin-top: 2px; }
        .ticket dl { margin: 12px 0 0; display: grid; grid-template-columns: auto 1fr; gap: 6px 14px; }
        .ticket dt { color: var(--muted); }
        .ticket dd { margin: 0; font-weight: 600; text-align: right; }

        .foot { text-align: center; font-size: 12px; color: rgba(255,255,255,.55); margin-top: 18px; }

        @media (max-width: 480px) {
            .card-body { padding: 22px 20px 26px; }
            .card-head { padding: 26px 20px 22px; }
            .row { grid-template-columns: 1fr; gap: 0; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <main class="card">
            <header class="card-head">
                <div class="badge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9 18V5l12-2v13"/>
                        <circle cx="6" cy="18" r="3"/>
                        <circle cx="18" cy="16" r="3"/>
                    </svg>
                </div>
                <h1>{{ config('concert.name') }}</h1>
                <p class="tag">{{ config('concert.tagline') }}</p>
                <div class="chips">
                    <span class="chip">&#128197; {{ config('concert.date_label') }}</span>
                    <span class="chip">&#128205; {{ config('concert.venue') }}</span>
                </div>
            </header>
            <div class="card-body">
                @yield('content')
            </div>
        </main>
        <div class="foot">&copy; {{ date('Y') }} {{ config('concert.name') }} · Official ticket registration</div>
    </div>
    @stack('scripts')
</body>
</html>

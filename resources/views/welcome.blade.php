<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Klinik UKOM - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            line-height: 1.6;
            color: #1f2937;
            overflow-x: hidden;
        }

        /* Background Animasi */
        .gradient-bg {
            background: linear-gradient(-45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(80px);
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Partikel */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10%,90% { opacity: 1; }
            100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
        }

        /* Header */
        .header {
            position: relative;
            z-index: 100;
            padding: 1.2rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.15);
        }
        .logo {
            font-size: 1.7rem;
            font-weight: 700;
            color: #e11d48;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .logo-icon {
            width: 30px;
            height: 30px;
            fill: #e11d48;
        }

        /* Navigation */
        .nav-links {
            display: flex;
            gap: 1rem;
        }
        .nav-link {
            padding: 0.7rem 1.4rem;
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .nav-link:hover {
            color: #e11d48;
            border-color: #e11d48;
            transform: translateY(-2px);
        }
        .nav-link.primary {
            background: linear-gradient(135deg, #e11d48, #be185d);
            color: white;
        }
        .nav-link.primary:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 10px 25px rgba(225, 29, 72, 0.3);
        }

        /* Main Content */
        .main-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 100px);
            text-align: center;
            padding: 2rem;
        }
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #e11d48, #7c3aed, #2563eb);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease 0.2s both;
        }
        .hero-subtitle {
            font-size: 1.3rem;
            color: #4b5563;
            max-width: 650px;
            margin-bottom: 3rem;
            animation: fadeInUp 1s ease 0.4s both;
        }

        /* Tombol CTA */
        .cta-section {
            animation: fadeInUp 1s ease 0.8s both;
        }
        .cta-button {
            padding: 1rem 2rem;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            background: linear-gradient(135deg, #e11d48, #be185d);
            color: white;
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(225, 29, 72, 0.4);
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Dark Mode */
        @media (prefers-color-scheme: dark) {
            .gradient-bg::before { background: rgba(17, 24, 39, 0.9); }
            body { color: #f3f4f6; }
        }
    </style>
</head>
<body>
    <div class="gradient-bg">
        <div class="particles"></div>

        <header class="header">
            <a href="/" class="logo">
                <svg class="logo-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2a10 10 0 00-7.07 17.07L12 22l7.07-2.93A10 10 0 0012 2zm1 14h-2v-2H9v-2h2V8h2v4h2v2h-2v2z"/></svg>
                Klinik UKOM
            </a>

            @if (Route::has('login'))
                <nav class="nav-links">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="nav-link primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link primary">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="main-content">
            <h1 class="hero-title">Selamat Datang di Admin Klinik Uji Kompetensi</h1>
            <p class="hero-subtitle">Kelola data ujian kompetensi bidan dengan mudah, cepat, dan terorganisir.</p>

            <section class="cta-section">
                <a href="{{ url('/dashboard') }}" class="cta-button">Masuk Dashboard</a>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const particlesContainer = document.querySelector('.particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                const size = Math.random() * 6 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 15 + 10) + 's';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particlesContainer.appendChild(particle);
            }
        });
    </script>
</body>
</html>

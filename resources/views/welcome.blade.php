<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel - Build Something Amazing</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Inter', system-ui, -apple-system, sans-serif;
                line-height: 1.6;
                color: #1f2937;
                overflow-x: hidden;
            }
            
            /* Animated gradient background */
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
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(100px);
            }
            
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            
            /* Floating particles */
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
                0% {
                    transform: translateY(100vh) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100px) rotate(360deg);
                    opacity: 0;
                }
            }
            
            /* Header */
            .header {
                position: relative;
                z-index: 100;
                padding: 1.5rem 2rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.1);
            }
            
            .logo {
                font-size: 1.8rem;
                font-weight: 700;
                color: #e11d48;
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }
            
            .nav-links {
                display: flex;
                gap: 1rem;
            }
            
            .nav-link {
                padding: 0.75rem 1.5rem;
                text-decoration: none;
                color: #374151;
                font-weight: 500;
                border-radius: 50px;
                transition: all 0.3s ease;
                border: 2px solid transparent;
                position: relative;
                overflow: hidden;
            }
            
            .nav-link:hover {
                color: #e11d48;
                border-color: #e11d48;
                transform: translateY(-2px);
            }
            
            .nav-link.primary {
                background: linear-gradient(135deg, #e11d48, #be185d);
                color: white;
                border: none;
            }
            
            .nav-link.primary:hover {
                color: white;
                transform: translateY(-2px) scale(1.05);
                box-shadow: 0 10px 25px rgba(225, 29, 72, 0.3);
            }
            
            /* Main content */
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
                font-size: 4rem;
                font-weight: 800;
                background: linear-gradient(135deg, #e11d48, #7c3aed, #2563eb);
                background-clip: text;
                -webkit-background-clip: text;
                color: transparent;
                margin-bottom: 1rem;
                animation: fadeInUp 1s ease 0.2s both;
            }
            
            .hero-subtitle {
                font-size: 1.5rem;
                color: #6b7280;
                margin-bottom: 3rem;
                max-width: 600px;
                animation: fadeInUp 1s ease 0.4s both;
            }
            
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            /* Feature cards */
            .features {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 2rem;
            }
            
            .feature-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border-radius: 20px;
                padding: 2rem;
                text-align: left;
                border: 1px solid rgba(255, 255, 255, 0.3);
                transition: all 0.3s ease;
                animation: fadeInUp 1s ease 0.6s both;
            }
            
            .feature-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
                border-color: #e11d48;
            }
            
            .feature-icon {
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #e11d48, #7c3aed);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                font-size: 1.5rem;
            }
            
            .feature-title {
                font-size: 1.3rem;
                font-weight: 600;
                color: #1f2937;
                margin-bottom: 1rem;
            }
            
            .feature-description {
                color: #6b7280;
                line-height: 1.7;
            }
            
            /* CTA Section */
            .cta-section {
                margin-top: 4rem;
                animation: fadeInUp 1s ease 0.8s both;
            }
            
            .cta-buttons {
                display: flex;
                gap: 1rem;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .cta-button {
                padding: 1rem 2rem;
                border: none;
                border-radius: 50px;
                font-size: 1.1rem;
                font-weight: 600;
                text-decoration: none;
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                cursor: pointer;
            }
            
            .cta-button.primary {
                background: linear-gradient(135deg, #e11d48, #be185d);
                color: white;
            }
            
            .cta-button.primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 35px rgba(225, 29, 72, 0.4);
            }
            
            .cta-button.secondary {
                background: transparent;
                color: #374151;
                border: 2px solid #d1d5db;
            }
            
            .cta-button.secondary:hover {
                border-color: #e11d48;
                color: #e11d48;
                transform: translateY(-3px);
            }
            
            /* Interactive elements */
            .interactive-element {
                position: absolute;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                background: linear-gradient(45deg, rgba(225, 29, 72, 0.1), rgba(124, 58, 237, 0.1));
                animation: pulse 4s ease-in-out infinite;
                z-index: 1;
            }
            
            .interactive-element:nth-child(1) {
                top: 10%;
                left: 10%;
                animation-delay: 0s;
            }
            
            .interactive-element:nth-child(2) {
                bottom: 10%;
                right: 10%;
                animation-delay: 2s;
            }
            
            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                    opacity: 0.7;
                }
                50% {
                    transform: scale(1.2);
                    opacity: 0.3;
                }
            }
            
            /* Responsive design */
            @media (max-width: 768px) {
                .header {
                    padding: 1rem;
                }
                
                .nav-links {
                    flex-direction: column;
                    gap: 0.5rem;
                }
                
                .hero-title {
                    font-size: 2.5rem;
                }
                
                .hero-subtitle {
                    font-size: 1.2rem;
                }
                
                .features {
                    grid-template-columns: 1fr;
                    padding: 0 1rem;
                }
                
                .cta-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .interactive-element {
                    width: 100px;
                    height: 100px;
                }
            }
            
            /* Dark mode support */
            @media (prefers-color-scheme: dark) {
                .gradient-bg::before {
                    background: rgba(17, 24, 39, 0.9);
                }
                
                body {
                    color: #f3f4f6;
                }
                
                .feature-card {
                    background: rgba(31, 41, 55, 0.9);
                    color: #f3f4f6;
                }
                
                .feature-title {
                    color: #f3f4f6;
                }
                
                .nav-link {
                    color: #d1d5db;
                }
                
                .nav-link:hover {
                    color: #e11d48;
                }
            }
        </style>
    </head>
    <body>
        <div class="gradient-bg">
            <!-- Floating particles -->
            <div class="particles"></div>
            
            <!-- Interactive elements -->
            <div class="interactive-element"></div>
            <div class="interactive-element"></div>
            
            <!-- Header -->
            <header class="header">
                <a href="/" class="logo">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    </svg>
                    Laravel
                </a>
                
                @if (Route::has('login'))
                    <nav class="nav-links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link primary">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link primary">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>
            
            <!-- Main content -->
            <main class="main-content">
                <h1 class="hero-title">Build Something Amazing</h1>
                <p class="hero-subtitle">
                    Laravel makes web artisans productive. Start building exceptional applications with the most expressive and elegant PHP framework.
                </p>
                
                <!-- Feature cards -->
                <section class="features">
                    <div class="feature-card">
                        <div class="feature-icon">📚</div>
                        <h3 class="feature-title">Rich Documentation</h3>
                        <p class="feature-description">
                            Comprehensive documentation and video tutorials to get you started quickly and master advanced concepts.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">🚀</div>
                        <h3 class="feature-title">Powerful Features</h3>
                        <p class="feature-description">
                            Built-in ORM, authentication, routing, sessions, and caching. Everything you need to build modern web applications.
                        </p>
                    </div>
                    
                    <div class="feature-card">
                        <div class="feature-icon">🌟</div>
                        <h3 class="feature-title">Vibrant Ecosystem</h3>
                        <p class="feature-description">
                            Join a thriving community of developers and access hundreds of packages to extend your application.
                        </p>
                    </div>
                </section>
                
                <!-- CTA Section -->
                <section class="cta-section">
                    <div class="cta-buttons">
                        <a href="https://laravel.com/docs" target="_blank" class="cta-button primary">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Get Started
                        </a>
                        <a href="https://laracasts.com" target="_blank" class="cta-button secondary">
                            <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18l8-4V2L5 6v12z"/>
                            </svg>
                            Watch Tutorials
                        </a>
                    </div>
                </section>
            </main>
        </div>
        
        <script>
            // Create floating particles
            function createParticles() {
                const particlesContainer = document.querySelector('.particles');
                const particleCount = 50;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    
                    // Random size and position
                    const size = Math.random() * 6 + 2;
                    particle.style.width = size + 'px';
                    particle.style.height = size + 'px';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDuration = (Math.random() * 15 + 10) + 's';
                    particle.style.animationDelay = Math.random() * 15 + 's';
                    
                    particlesContainer.appendChild(particle);
                }
            }
            
            // Mouse interaction with gradient
            function initMouseInteraction() {
                const gradientBg = document.querySelector('.gradient-bg');
                let mouseX = 0;
                let mouseY = 0;
                
                document.addEventListener('mousemove', (e) => {
                    mouseX = (e.clientX / window.innerWidth) * 100;
                    mouseY = (e.clientY / window.innerHeight) * 100;
                    
                    gradientBg.style.background = `
                        radial-gradient(circle at ${mouseX}% ${mouseY}%, rgba(225, 29, 72, 0.3) 0%, transparent 50%),
                        linear-gradient(-45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4)
                    `;
                });
            }
            
            // Smooth scroll for anchor links
            function initSmoothScroll() {
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });
            }
            
            // Initialize everything when DOM is loaded
            document.addEventListener('DOMContentLoaded', () => {
                createParticles();
                initMouseInteraction();
                initSmoothScroll();
                
                // Add entrance animations to elements
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }
                    });
                }, observerOptions);
                
                // Observe all feature cards
                document.querySelectorAll('.feature-card').forEach(card => {
                    observer.observe(card);
                });
            });
        </script>
    </body>
</html>
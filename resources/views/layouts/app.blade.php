<!DOCTYPE html>
<html lang="cs" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Martin Beck — Fotograf. Portréty, příběhy, emoce zachycené v jedinečných fotografiích.">
    <title>@yield('title', 'Martin Beck — Fotograf')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'playfair': ['Playfair Display', 'serif'],
                        'inter': ['Inter', 'sans-serif'],
                        'cormorant': ['Cormorant Garamond', 'serif'],
                    },
                    colors: {
                        'dark': '#0a0a0a',
                        'dark-2': '#111111',
                        'dark-3': '#1a1a1a',
                        'dark-4': '#222222',
                        'accent': '#c9a96e',
                        'accent-light': '#e8d5b0',
                        'accent-dark': '#9a7a45',
                        'muted': '#6b6b6b',
                        'light': '#f5f5f0',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out forwards',
                        'slide-up': 'slideUp 0.8s ease-out forwards',
                        'slide-in-left': 'slideInLeft 0.8s ease-out forwards',
                        'kenburns': 'kenburns 20s ease-out infinite alternate',
                    },
                    keyframes: {
                        fadeIn: { '0%': { opacity: '0' }, '100%': { opacity: '1' } },
                        slideUp: { '0%': { opacity: '0', transform: 'translateY(40px)' }, '100%': { opacity: '1', transform: 'translateY(0)' } },
                        slideInLeft: { '0%': { opacity: '0', transform: 'translateX(-40px)' }, '100%': { opacity: '1', transform: 'translateX(0)' } },
                        kenburns: { '0%': { transform: 'scale(1.05) translate(0,0)' }, '100%': { transform: 'scale(1.15) translate(-2%, -1%)' } },
                    }
                }
            }
        }
    </script>
    <style>
        * { box-sizing: border-box; }
        html { font-size: 16px; }
        body { background-color: #0a0a0a; color: #f5f5f0; font-family: 'Inter', sans-serif; overflow-x: hidden; }
        
        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: #c9a96e; border-radius: 2px; }

        /* Custom cursor */
        .custom-cursor { cursor: none; }
        #cursor { width: 12px; height: 12px; background: #c9a96e; border-radius: 50%; position: fixed; pointer-events: none; z-index: 9999; transform: translate(-50%, -50%); transition: width 0.2s, height 0.2s, opacity 0.2s; mix-blend-mode: difference; }
        #cursor-ring { width: 40px; height: 40px; border: 1px solid rgba(201,169,110,0.5); border-radius: 50%; position: fixed; pointer-events: none; z-index: 9998; transform: translate(-50%, -50%); transition: all 0.15s ease-out; }
        
        /* Loader */
        #page-loader { position: fixed; inset: 0; background: #0a0a0a; z-index: 99999; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 1.5rem; transition: opacity 0.8s ease, visibility 0.8s ease; }
        #page-loader.hidden { opacity: 0; visibility: hidden; }
        .loader-line { width: 200px; height: 1px; background: #222; position: relative; overflow: hidden; }
        .loader-line::after { content: ''; position: absolute; left: -100%; top: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, #c9a96e, transparent); animation: loaderSlide 1.5s ease-in-out infinite; }
        @keyframes loaderSlide { to { left: 200%; } }

        /* Nav */
        nav { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; transition: all 0.4s ease; }
        nav.scrolled { background: rgba(10,10,10,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(201,169,110,0.1); }
        .nav-link { position: relative; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: rgba(245,245,240,0.7); transition: color 0.3s; font-family: 'Inter', sans-serif; font-weight: 400; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 1px; background: #c9a96e; transition: width 0.3s ease; }
        .nav-link:hover { color: #c9a96e; }
        .nav-link:hover::after { width: 100%; }
        .nav-link.active { color: #c9a96e; }
        .nav-link.active::after { width: 100%; }

        /* Mobile menu */
        #mobile-menu { position: fixed; inset: 0; background: rgba(10,10,10,0.98); z-index: 900; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 2.5rem; transform: translateX(100%); transition: transform 0.5s cubic-bezier(0.77,0,0.175,1); }
        #mobile-menu.open { transform: translateX(0); }
        .mobile-nav-link { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: rgba(245,245,240,0.6); transition: color 0.3s; }
        .mobile-nav-link:hover { color: #c9a96e; }
        
        /* Section reveal */
        .reveal { opacity: 0; transform: translateY(50px); transition: opacity 0.9s ease, transform 0.9s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-50px); transition: opacity 0.9s ease, transform 0.9s ease; }
        .reveal-left.visible { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(50px); transition: opacity 0.9s ease, transform 0.9s ease; }
        .reveal-right.visible { opacity: 1; transform: translateX(0); }

        /* Photo hover */
        .photo-card { overflow: hidden; }
        .photo-card img { transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94); }
        .photo-card:hover img { transform: scale(1.08); }
        .photo-overlay { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 50%); opacity: 0; transition: opacity 0.4s ease; }
        .photo-card:hover .photo-overlay { opacity: 1; }

        /* Gold divider */
        .gold-line { width: 60px; height: 1px; background: linear-gradient(90deg, transparent, #c9a96e, transparent); }
        .gold-line-full { height: 1px; background: linear-gradient(90deg, transparent, rgba(201,169,110,0.3), transparent); }

        /* Button styles */
        .btn-primary { display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.9rem 2.5rem; background: #c9a96e; color: #0a0a0a; font-family: 'Inter', sans-serif; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; transition: all 0.3s ease; border: 1px solid #c9a96e; }
        .btn-primary:hover { background: transparent; color: #c9a96e; }
        .btn-outline { display: inline-flex; align-items: center; gap: 0.75rem; padding: 0.9rem 2.5rem; background: transparent; color: #c9a96e; font-family: 'Inter', sans-serif; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; transition: all 0.3s ease; border: 1px solid rgba(201,169,110,0.4); }
        .btn-outline:hover { background: #c9a96e; color: #0a0a0a; border-color: #c9a96e; }

        /* Cart badge */
        .cart-badge { position: absolute; top: -8px; right: -8px; width: 18px; height: 18px; background: #c9a96e; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 700; color: #0a0a0a; }
    </style>
    @yield('head')
</head>
<body class="custom-cursor">

    <!-- Custom cursor -->
    <div id="cursor"></div>
    <div id="cursor-ring"></div>

    <!-- Page loader -->
    <div id="page-loader">
        <div style="font-family: 'Playfair Display', serif; font-size: 1.8rem; color: #c9a96e; letter-spacing: 0.3em; font-style: italic;">Martin Beck</div>
        <div class="loader-line"></div>
        <div style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #6b6b6b;">Photography</div>
    </div>

    <!-- Navigation -->
    <nav id="main-nav" class="px-6 md:px-12 lg:px-20">
        <div class="flex items-center justify-between h-20 md:h-24">
            <!-- Logo -->
            <a href="/" class="flex flex-col leading-none">
                <span style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #f5f5f0; letter-spacing: 0.05em; font-style: italic;">Martin Beck</span>
                <span style="font-size: 0.55rem; letter-spacing: 0.4em; text-transform: uppercase; color: #c9a96e; margin-top: 2px;">Photography</span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden md:flex items-center gap-10">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/portfolio" class="nav-link {{ request()->is('portfolio*') ? 'active' : '' }}">Portfolio</a>
                <a href="/galerie" class="nav-link {{ request()->is('galerie*') ? 'active' : '' }}">Galerie</a>
                <a href="/eshop" class="nav-link {{ request()->is('eshop*') ? 'active' : '' }}">E-shop</a>
                <a href="/kontakt" class="nav-link {{ request()->is('kontakt*') ? 'active' : '' }}">Kontakt</a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center gap-6">
                <!-- Cart -->
                <a href="/kosik" class="relative" style="color: rgba(245,245,240,0.7); transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='rgba(245,245,240,0.7)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                    @if(session('cart') && count(session('cart')) > 0)
                    <span class="cart-badge">{{ count(session('cart')) }}</span>
                    @endif
                </a>

                <!-- Hamburger -->
                <button id="menu-toggle" class="md:hidden flex flex-col gap-1.5" style="color: #f5f5f0; background: none; border: none; cursor: pointer; padding: 4px;" aria-label="Menu">
                    <span class="menu-bar" style="width: 24px; height: 1px; background: currentColor; display: block; transition: all 0.3s;"></span>
                    <span class="menu-bar" style="width: 16px; height: 1px; background: currentColor; display: block; transition: all 0.3s;"></span>
                    <span class="menu-bar" style="width: 24px; height: 1px; background: currentColor; display: block; transition: all 0.3s;"></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div id="mobile-menu">
        <button id="menu-close" style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; color: rgba(245,245,240,0.5); cursor: pointer;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <a href="/" class="mobile-nav-link">Home</a>
        <a href="/portfolio" class="mobile-nav-link">Portfolio</a>
        <a href="/galerie" class="mobile-nav-link">Galerie</a>
        <a href="/eshop" class="mobile-nav-link">E-shop</a>
        <a href="/kontakt" class="mobile-nav-link">Kontakt</a>
        <div style="display: flex; gap: 2rem; margin-top: 2rem;">
            <a href="https://instagram.com" target="_blank" style="color: #6b6b6b; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
            </a>
            <a href="https://facebook.com" target="_blank" style="color: #6b6b6b; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: #0d0d0d; border-top: 1px solid rgba(201,169,110,0.1);">
        <!-- Footer top -->
        <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 py-16 md:py-24">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 md:gap-8">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <div class="mb-6">
                        <div style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #f5f5f0; font-style: italic; letter-spacing: 0.05em;">Martin Beck</div>
                        <div style="font-size: 0.6rem; letter-spacing: 0.4em; text-transform: uppercase; color: #c9a96e; margin-top: 4px;">Photography</div>
                    </div>
                    <p style="color: #6b6b6b; font-size: 0.85rem; line-height: 1.8; max-width: 260px;">Zachycuji příběhy skrze objektiv. Každá fotografie je unikátní pohled na svět a jeho obyvatele.</p>
                    <div style="display: flex; gap: 1.25rem; margin-top: 1.5rem;">
                        <a href="#" style="color: #6b6b6b; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" style="color: #6b6b6b; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" style="color: #6b6b6b; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.77 1.52V6.75a4.85 4.85 0 01-1-.06z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Navigation -->
                <div>
                    <h4 style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.5rem;">Navigace</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="/" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Domů</a></li>
                        <li><a href="/portfolio" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Portfolio</a></li>
                        <li><a href="/galerie" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Galerie</a></li>
                        <li><a href="/eshop" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">E-shop</a></li>
                        <li><a href="/kontakt" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Kontakt</a></li>
                    </ul>
                </div>

                <!-- Portfolio categories -->
                <div>
                    <h4 style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.5rem;">Portfolio</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="/portfolio#portret" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Portréty</a></li>
                        <li><a href="/portfolio#celebrity" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Celebrity</a></li>
                        <li><a href="/portfolio#sport" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Sportovci</a></li>
                        <li><a href="/portfolio#kultura" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Kultura</a></li>
                        <li><a href="/portfolio#politika" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">Politika</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.5rem;">Kontakt</h4>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem;">
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5" style="flex-shrink:0; margin-top:2px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                            <a href="mailto:info@martinbeck.com" style="color: #6b6b6b; font-size: 0.85rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#6b6b6b'">info@martinbeck.com</a>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5" style="flex-shrink:0; margin-top:2px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <span style="color: #6b6b6b; font-size: 0.85rem;">+420 123 456 789</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5" style="flex-shrink:0; margin-top:2px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            <span style="color: #6b6b6b; font-size: 0.85rem;">Praha, Česká republika</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer bottom -->
        <div style="border-top: 1px solid rgba(255,255,255,0.05); padding: 1.5rem 0;">
            <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 flex flex-col md:flex-row items-center justify-between gap-3">
                <p style="color: #3a3a3a; font-size: 0.75rem; letter-spacing: 0.05em;">© {{ date('Y') }} Martin Beck Photography. Všechna práva vyhrazena.</p>
                <p style="color: #3a3a3a; font-size: 0.75rem;">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" style="color: #c9a96e; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">LaraCopilot</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Page loader
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('page-loader').classList.add('hidden');
            }, 1200);
        });

        // Custom cursor
        const cursor = document.getElementById('cursor');
        const cursorRing = document.getElementById('cursor-ring');
        let mouseX = 0, mouseY = 0;
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX; mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top = mouseY + 'px';
            setTimeout(() => {
                cursorRing.style.left = mouseX + 'px';
                cursorRing.style.top = mouseY + 'px';
            }, 80);
        });
        document.querySelectorAll('a, button, .photo-card').forEach(el => {
            el.addEventListener('mouseenter', () => { cursor.style.width = '6px'; cursor.style.height = '6px'; cursorRing.style.width = '60px'; cursorRing.style.height = '60px'; cursorRing.style.borderColor = 'rgba(201,169,110,0.8)'; });
            el.addEventListener('mouseleave', () => { cursor.style.width = '12px'; cursor.style.height = '12px'; cursorRing.style.width = '40px'; cursorRing.style.height = '40px'; cursorRing.style.borderColor = 'rgba(201,169,110,0.5)'; });
        });

        // Nav scroll effect
        const nav = document.getElementById('main-nav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Mobile menu
        const toggle = document.getElementById('menu-toggle');
        const closeBtn = document.getElementById('menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        toggle.addEventListener('click', () => mobileMenu.classList.add('open'));
        closeBtn.addEventListener('click', () => mobileMenu.classList.remove('open'));
        mobileMenu.querySelectorAll('a').forEach(a => a.addEventListener('click', () => mobileMenu.classList.remove('open')));

        // Scroll reveal
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
    </script>
    @yield('scripts')
</body>
</html>
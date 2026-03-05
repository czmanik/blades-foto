@extends('layouts.app')

@section('title', 'Martin Beck — Fotograf | Praha')

@section('head')
<style>
    /* Hero */
    .hero-section { height: 100vh; min-height: 700px; position: relative; display: flex; align-items: center; overflow: hidden; }
    .hero-bg { position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=1920&q=80') center/cover no-repeat; animation: kenburns 20s ease-out infinite alternate; }
    .hero-overlay { position: absolute; inset: 0; background: linear-gradient(135deg, rgba(10,10,10,0.85) 0%, rgba(10,10,10,0.4) 50%, rgba(10,10,10,0.7) 100%); }
    .hero-content { position: relative; z-index: 2; }
    
    /* Split text reveal */
    .split-char { display: inline-block; opacity: 0; transform: translateY(60px); animation: charReveal 0.6s ease forwards; }
    @keyframes charReveal { to { opacity: 1; transform: translateY(0); } }
    
    /* Scrolling gallery strip */
    .gallery-strip { display: flex; gap: 1rem; animation: stripScroll 30s linear infinite; width: max-content; }
    .gallery-strip-wrapper { overflow: hidden; }
    @keyframes stripScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
    .gallery-strip-wrapper:hover .gallery-strip { animation-play-state: paused; }

    /* Stats */
    .stat-number { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-style: italic; color: #c9a96e; line-height: 1; }

    /* Project grid */
    .project-grid { display: grid; grid-template-columns: repeat(12, 1fr); grid-template-rows: auto; gap: 12px; }
    .project-item-1 { grid-column: 1 / 8; grid-row: 1 / 3; }
    .project-item-2 { grid-column: 8 / 13; grid-row: 1 / 2; }
    .project-item-3 { grid-column: 8 / 13; grid-row: 2 / 3; }
    .project-item-4 { grid-column: 1 / 5; grid-row: 3 / 4; }
    .project-item-5 { grid-column: 5 / 9; grid-row: 3 / 4; }
    .project-item-6 { grid-column: 9 / 13; grid-row: 3 / 4; }
    @media (max-width: 768px) {
        .project-grid { grid-template-columns: 1fr 1fr; grid-template-rows: auto; }
        .project-item-1, .project-item-2, .project-item-3, .project-item-4, .project-item-5, .project-item-6 { grid-column: auto; grid-row: auto; }
    }
    @media (max-width: 480px) {
        .project-grid { grid-template-columns: 1fr; }
    }

    /* Testimonial */
    .testimonial-card { border: 1px solid rgba(201,169,110,0.15); padding: 2.5rem; position: relative; transition: border-color 0.3s; }
    .testimonial-card:hover { border-color: rgba(201,169,110,0.4); }
    .testimonial-card::before { content: '\201C'; font-family: 'Playfair Display', serif; font-size: 6rem; color: rgba(201,169,110,0.15); position: absolute; top: -1rem; left: 1.5rem; line-height: 1; }

    /* Process steps */
    .process-step { position: relative; padding-left: 4rem; }
    .step-number { position: absolute; left: 0; top: 0; font-family: 'Cormorant Garamond', serif; font-size: 3rem; font-style: italic; color: rgba(201,169,110,0.2); line-height: 1; font-weight: 300; }
    .step-line { position: absolute; left: 1.2rem; top: 3.5rem; bottom: -2rem; width: 1px; background: linear-gradient(to bottom, rgba(201,169,110,0.3), transparent); }
</style>
@endsection

@section('content')

<!-- ===== HERO SECTION ===== -->
<section class="hero-section">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    
    <!-- Vertical text left -->
    <div style="position: absolute; left: 2rem; top: 50%; transform: translateY(-50%) rotate(-90deg); transform-origin: center; font-size: 0.6rem; letter-spacing: 0.4em; text-transform: uppercase; color: rgba(245,245,240,0.3); white-space: nowrap; display: none;" class="lg:block">
        Praha — Česká republika
    </div>

    <!-- Scroll indicator right -->
    <div style="position: absolute; right: 2.5rem; bottom: 3rem; display: flex; flex-direction: column; align-items: center; gap: 0.75rem;" class="hidden md:flex">
        <div style="font-size: 0.55rem; letter-spacing: 0.3em; text-transform: uppercase; color: rgba(245,245,240,0.4); writing-mode: vertical-rl;">Scroll</div>
        <div style="width: 1px; height: 60px; background: linear-gradient(to bottom, rgba(201,169,110,0.6), transparent);"></div>
    </div>

    <div class="hero-content max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="padding-top: 6rem;">
        <div class="max-w-3xl">
            <!-- Eyebrow -->
            <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem; opacity: 0; animation: fadeIn 0.8s 0.3s forwards;">
                <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.4em; text-transform: uppercase; color: #c9a96e;">Profesionální fotograf</span>
            </div>

            <!-- Main heading -->
            <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(3rem, 8vw, 7rem); font-weight: 400; line-height: 1.05; color: #f5f5f0; margin-bottom: 1.5rem;">
                <span style="display: block; opacity: 0; animation: slideUp 0.9s 0.5s forwards;">Každý příběh</span>
                <span style="display: block; font-style: italic; color: #c9a96e; opacity: 0; animation: slideUp 0.9s 0.7s forwards;">zaslouží</span>
                <span style="display: block; opacity: 0; animation: slideUp 0.9s 0.9s forwards;">být zachycen</span>
            </h1>

            <!-- Subtext -->
            <p style="color: rgba(245,245,240,0.6); font-size: 1.05rem; line-height: 1.8; max-width: 480px; margin-bottom: 3rem; opacity: 0; animation: fadeIn 0.8s 1.1s forwards;">
                Specializuji se na portréty osobností ze světa politiky, kultury a sportu. Každá fotografie je přesně načasovaný okamžik pravdy.
            </p>

            <!-- CTA Buttons -->
            <div style="display: flex; flex-wrap: wrap; gap: 1rem; opacity: 0; animation: fadeIn 0.8s 1.3s forwards;">
                <a href="/portfolio" class="btn-primary">
                    <span>Zobrazit Portfolio</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>
                <a href="/kontakt" class="btn-outline">Spolupráce</a>
            </div>
        </div>

        <!-- Hero image counter -->
        <div style="position: absolute; bottom: 3rem; left: 50%; transform: translateX(-50%); display: flex; gap: 0.5rem; opacity: 0; animation: fadeIn 0.8s 1.5s forwards;">
            <div style="width: 30px; height: 1px; background: #c9a96e; margin-top: 0.45rem;"></div>
            <span style="font-size: 0.75rem; color: rgba(245,245,240,0.4);">01 / 06</span>
        </div>
    </div>
</section>

<!-- ===== SCROLLING GALLERY STRIP ===== -->
<section style="padding: 4rem 0; overflow: hidden; background: #111111; border-top: 1px solid rgba(201,169,110,0.05); border-bottom: 1px solid rgba(201,169,110,0.05);">
    <div class="gallery-strip-wrapper">
        <div class="gallery-strip">
            @php
            $stripImages = [
                'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1520813792240-56fc4a3765a7?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=280&fit=crop',
                'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400&h=280&fit=crop',
            ];
            @endphp
            @foreach(array_merge($stripImages, $stripImages) as $img)
            <div style="width: 280px; height: 180px; flex-shrink: 0; overflow: hidden; position: relative;">
                <img src="{{ $img }}" alt="Portfolio" style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(30%); transition: filter 0.5s;" onmouseover="this.style.filter='grayscale(0)'" onmouseout="this.style.filter='grayscale(30%)'">
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== ABOUT / INTRO SECTION ===== -->
<section style="padding: 8rem 0;" class="reveal">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Image -->
            <div class="reveal-left" style="position: relative;">
                <div class="photo-card" style="position: relative; aspect-ratio: 4/5;">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800&h=1000&fit=crop" alt="Martin Beck" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="photo-overlay"></div>
                </div>
                <!-- Floating badge -->
                <div style="position: absolute; bottom: 2rem; right: -1.5rem; background: #0a0a0a; border: 1px solid rgba(201,169,110,0.3); padding: 1.5rem 2rem; z-index: 2;" class="hidden md:block">
                    <div class="stat-number">15+</div>
                    <div style="font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: #6b6b6b; margin-top: 0.25rem;">Let zkušeností</div>
                </div>
                <!-- Decorative border -->
                <div style="position: absolute; top: -1rem; left: -1rem; right: 2rem; bottom: 2rem; border: 1px solid rgba(201,169,110,0.2); pointer-events: none; z-index: -1;"></div>
            </div>

            <!-- Right: Content -->
            <div class="reveal-right">
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="gold-line"></div>
                    <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">O mně</span>
                </div>

                <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 400; line-height: 1.15; color: #f5f5f0; margin-bottom: 1.5rem;">
                    Zachycuji osobnosti<br>
                    <em style="font-style: italic; color: #c9a96e;">v jejich pravé podstatě</em>
                </h2>

                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.9; margin-bottom: 1.5rem;">
                    Jsem fotograf specializující se na portréty veřejně známých osobností. Za více než 15 let praxe jsem spolupracoval s politiky, herci, hudebníky, sportovci i kulturními osobnostmi.
                </p>

                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.9; margin-bottom: 2.5rem;">
                    Moje fotografie nejsou jen záznamy — jsou to příběhy. Snažím se zachytit ten jedinečný okamžik, kdy člověk ukáže, kdo skutečně je.
                </p>

                <!-- Stats row -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; padding: 2rem 0; border-top: 1px solid rgba(201,169,110,0.1); border-bottom: 1px solid rgba(201,169,110,0.1); margin-bottom: 2.5rem;">
                    <div>
                        <div class="stat-number">500+</div>
                        <div style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; color: #6b6b6b; margin-top: 0.25rem;">Osobností</div>
                    </div>
                    <div>
                        <div class="stat-number">50+</div>
                        <div style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; color: #6b6b6b; margin-top: 0.25rem;">Projektů</div>
                    </div>
                    <div>
                        <div class="stat-number">20+</div>
                        <div style="font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase; color: #6b6b6b; margin-top: 0.25rem;">Ocenění</div>
                    </div>
                </div>

                <a href="/portfolio" class="btn-primary">Prozkoumat Portfolio</a>
            </div>
        </div>
    </div>
</section>

<!-- ===== FEATURED PROJECTS GRID ===== -->
<section style="padding: 8rem 0; background: #080808;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <!-- Header -->
        <div class="reveal" style="display: flex; flex-wrap: wrap; align-items: flex-end; justify-content: space-between; gap: 2rem; margin-bottom: 4rem;">
            <div>
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
                    <div class="gold-line"></div>
                    <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Vybrané projekty</span>
                </div>
                <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 400; color: #f5f5f0; line-height: 1.15;">
                    Fotoprojekty<br><em style="color: #c9a96e; font-style: italic;">& série</em>
                </h2>
            </div>
            <a href="/portfolio" style="color: #c9a96e; font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 0.75rem; border-bottom: 1px solid rgba(201,169,110,0.3); padding-bottom: 0.25rem; transition: gap 0.3s;" onmouseover="this.style.gap='1.25rem'" onmouseout="this.style.gap='0.75rem'">
                Všechny projekty
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
            </a>
        </div>

        <!-- Asymmetric Grid -->
        <div class="reveal project-grid">
            <!-- Large item -->
            <div class="project-item-1 photo-card" style="position: relative; cursor: pointer; min-height: 500px;">
                <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=900&h=700&fit=crop" alt="Portréty 2024" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; z-index: 2; transform: translateY(10px); transition: transform 0.4s;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.5rem;">Politika</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.8rem; color: #f5f5f0; font-weight: 400; margin-bottom: 0.5rem;">Tváře české politiky</h3>
                    <p style="color: rgba(245,245,240,0.6); font-size: 0.85rem;">48 fotografií</p>
                </div>
            </div>
            <!-- Small item 2 -->
            <div class="project-item-2 photo-card" style="position: relative; cursor: pointer; min-height: 240px;">
                <img src="https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=600&h=350&fit=crop" alt="Kultura" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.25rem;">Kultura</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #f5f5f0; font-weight: 400;">Divadelní osobnosti</h3>
                </div>
            </div>
            <!-- Small item 3 -->
            <div class="project-item-3 photo-card" style="position: relative; cursor: pointer; min-height: 240px;">
                <img src="https://images.unsplash.com/photo-1489980557514-251d61e3eeb6?w=600&h=350&fit=crop" alt="Hudba" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.25rem;">Hudba</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #f5f5f0; font-weight: 400;">Čeští hudebníci</h3>
                </div>
            </div>
            <!-- Bottom small -->
            <div class="project-item-4 photo-card" style="position: relative; cursor: pointer; min-height: 280px;">
                <img src="https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=500&h=350&fit=crop" alt="Sport" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.25rem;">Sport</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; color: #f5f5f0; font-weight: 400;">Olympionici</h3>
                </div>
            </div>
            <div class="project-item-5 photo-card" style="position: relative; cursor: pointer; min-height: 280px;">
                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=350&fit=crop" alt="Biznis" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.25rem;">Byznys</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; color: #f5f5f0; font-weight: 400;">Lídři byznysu</h3>
                </div>
            </div>
            <div class="project-item-6 photo-card" style="position: relative; cursor: pointer; min-height: 280px;">
                <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=500&h=350&fit=crop" alt="Film" style="width: 100%; height: 100%; object-fit: cover;">
                <div class="photo-overlay"></div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1.5rem; z-index: 2;">
                    <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.25rem;">Film</div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; color: #f5f5f0; font-weight: 400;">Filmové tváře</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== PROCESS SECTION ===== -->
<section style="padding: 8rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
            <!-- Left -->
            <div class="reveal-left">
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="gold-line"></div>
                    <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Jak pracuji</span>
                </div>
                <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 400; line-height: 1.15; color: #f5f5f0; margin-bottom: 2rem;">
                    Proces vytvoření<br><em style="color: #c9a96e;">dokonalé fotografie</em>
                </h2>
                <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.9; margin-bottom: 3rem;">
                    Každá spolupráce je jiná, ale vždy vychází z důkladné přípravy a vzájemného porozumění. Cílem je zachytit to, co je na člověku jedinečné.
                </p>
                <a href="/kontakt" class="btn-outline">Začít spolupráci</a>
            </div>

            <!-- Right: Steps -->
            <div class="reveal-right" style="display: flex; flex-direction: column; gap: 3rem;">
                @php
                $steps = [
                    ['num' => '01', 'title' => 'Úvodní konzultace', 'desc' => 'Probereme vaši vizi, záměr fotografií a kontext. Chci znát váš příběh předtím, než zvednu fotoaparát.'],
                    ['num' => '02', 'title' => 'Příprava a scénář', 'desc' => 'Navrhuji lokaci, světlo a atmosféru. Každé focení má svůj dramaturzický záměr.'],
                    ['num' => '03', 'title' => 'Fotografická session', 'desc' => 'Pracuji v klidné, přirozené atmosféře. Nejlepší portréty vznikají, když se člověk cítí uvolněně.'],
                    ['num' => '04', 'title' => 'Zpracování a výběr', 'desc' => 'Pečlivě vybírám a retuším výsledné fotografie. Každý snímek prochází mojí osobní pečetí kvality.'],
                ];
                @endphp
                @foreach($steps as $i => $step)
                <div class="process-step">
                    <div class="step-number">{{ $step['num'] }}</div>
                    @if(!$loop->last)<div class="step-line"></div>@endif
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #f5f5f0; margin-bottom: 0.5rem; font-weight: 500;">{{ $step['title'] }}</h3>
                    <p style="color: #6b6b6b; font-size: 0.875rem; line-height: 1.8;">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== SHOP TEASER ===== -->
<section style="padding: 8rem 0; background: #0d0d0d; position: relative; overflow: hidden;">
    <!-- BG pattern -->
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
    
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20" style="position: relative;">
        <div class="reveal" style="text-align: center; max-width: 700px; margin: 0 auto 5rem;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="gold-line"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">E-shop</span>
                <div class="gold-line"></div>
            </div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 400; color: #f5f5f0; margin-bottom: 1.5rem; line-height: 1.15;">
                Vlastněte umění<br><em style="color: #c9a96e;">na svých stěnách</em>
            </h2>
            <p style="color: #6b6b6b; font-size: 0.95rem; line-height: 1.9;">Limitované tisky mých fotografií na prémiových materiálech. Každý výtisk je signovaný a číslovaný.</p>
        </div>

        <!-- Product preview cards -->
        <div class="reveal" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 1.5rem;" class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
            @php
            $shopItems = [
                ['img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&h=600&fit=crop', 'name' => 'Portrét I.', 'size' => '60×90 cm', 'price' => '3 200 Kč', 'tag' => 'Limitovaná edice'],
                ['img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=500&h=600&fit=crop', 'name' => 'Moment II.', 'size' => '40×60 cm', 'price' => '1 900 Kč', 'tag' => 'Bestseller'],
                ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=600&fit=crop', 'name' => 'Charakter III.', 'size' => '80×120 cm', 'price' => '5 800 Kč', 'tag' => 'Výjimečný tisk'],
            ];
            @endphp
            @foreach($shopItems as $item)
            <div style="position: relative; cursor: pointer; group;" class="photo-card">
                <div style="position: relative; overflow: hidden; aspect-ratio: 5/6;">
                    <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                    <div class="photo-overlay"></div>
                    <!-- Tag -->
                    <div style="position: absolute; top: 1rem; left: 1rem; background: rgba(201,169,110,0.9); color: #0a0a0a; font-size: 0.6rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.3rem 0.75rem;">{{ $item['tag'] }}</div>
                    <!-- Quick add -->
                    <div style="position: absolute; bottom: 1rem; left: 1rem; right: 1rem; opacity: 0; transform: translateY(10px); transition: all 0.3s;" class="shop-quick-add">
                        <a href="/eshop" style="display: block; text-align: center; background: rgba(201,169,110,0.95); color: #0a0a0a; padding: 0.7rem; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none;">Do košíku</a>
                    </div>
                </div>
                <div style="padding: 1.25rem 0;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.05rem; color: #f5f5f0; margin-bottom: 0.25rem;">{{ $item['name'] }}</h3>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #6b6b6b; font-size: 0.8rem;">{{ $item['size'] }}</span>
                        <span style="color: #c9a96e; font-size: 0.95rem; font-weight: 500;">{{ $item['price'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>

        <div class="reveal" style="text-align: center; margin-top: 4rem;">
            <a href="/eshop" class="btn-primary">Prozkoumat E-shop</a>
        </div>
    </div>
</section>

<!-- ===== TESTIMONIALS ===== -->
<section style="padding: 8rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="reveal" style="text-align: center; margin-bottom: 5rem;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="gold-line"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Reference</span>
                <div class="gold-line"></div>
            </div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 400; color: #f5f5f0;">Co říkají osobnosti</h2>
        </div>

        <div class="reveal" style="display: grid; grid-template-columns: repeat(1, 1fr); gap: 2rem;" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
            @php
            $testimonials = [
                ['quote' => 'Martin dokázal zachytit přesně to, co jsem chtěla vyjádřit. Fotografie jsou neuvěřitelně silné a autentické.', 'name' => 'Jana Dvořáková', 'role' => 'Herečka, Národní divadlo'],
                ['quote' => 'Profesionalita na nejvyšší úrovni. Pracovní atmosféra byla uvolněná a výsledky překonaly moje očekávání.', 'name' => 'Petr Novák', 'role' => 'Olympijský vítěz, atletika'],
                ['quote' => 'Spolupráce s Martinem je vždy inspirativní. Má dar vidět v člověku to nejlepší a zachytit to na věčnost.', 'name' => 'Marie Horáková', 'role' => 'Senátorka ČR'],
            ];
            @endphp
            @foreach($testimonials as $t)
            <div class="testimonial-card">
                <p style="color: rgba(245,245,240,0.7); font-size: 0.9rem; line-height: 1.9; margin-bottom: 2rem; font-style: italic;">{{ $t['quote'] }}</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #c9a96e, #9a7a45); display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #0a0a0a;">{{ substr($t['name'], 0, 1) }}</div>
                    <div>
                        <div style="font-size: 0.85rem; color: #f5f5f0; font-weight: 500;">{{ $t['name'] }}</div>
                        <div style="font-size: 0.75rem; color: #c9a96e;">{{ $t['role'] }}</div>
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</section>

<!-- ===== CTA BANNER ===== -->
<section style="position: relative; padding: 10rem 0; overflow: hidden;">
    <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=1920&q=80') center/cover no-repeat; filter: grayscale(40%);"></div>
    <div style="position: absolute; inset: 0; background: rgba(10,10,10,0.85);"></div>
    <div class="reveal" style="position: relative; text-align: center; max-width: 700px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
            <div class="gold-line"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Kontakt</span>
            <div class="gold-line"></div>
        </div>
        <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 5vw, 4rem); font-weight: 400; color: #f5f5f0; margin-bottom: 1.5rem; line-height: 1.1;">
            Máte zájem<br><em style="color: #c9a96e;">o spolupráci?</em>
        </h2>
        <p style="color: rgba(245,245,240,0.6); font-size: 1rem; line-height: 1.8; margin-bottom: 3rem;">Rád se s vámi setkám a promluvíme o vašem projektu. Každý příběh si zaslouží být zaznamenán.</p>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
            <a href="/kontakt" class="btn-primary">Kontaktovat mě</a>
            <a href="tel:+420123456789" class="btn-outline">+420 123 456 789</a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Shop card hover effect
    document.querySelectorAll('.photo-card').forEach(card => {
        const quickAdd = card.querySelector('.shop-quick-add');
        if (quickAdd) {
            card.addEventListener('mouseenter', () => { quickAdd.style.opacity = '1'; quickAdd.style.transform = 'translateY(0)'; });
            card.addEventListener('mouseleave', () => { quickAdd.style.opacity = '0'; quickAdd.style.transform = 'translateY(10px)'; });
        }
    });
</script>
@endsection
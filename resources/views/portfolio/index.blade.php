@extends('layouts.app')

@section('title', 'Portfolio — Martin Beck Photography')

@section('head')
<style>
    .portfolio-hero { height: 65vh; min-height: 500px; position: relative; display: flex; align-items: flex-end; overflow: hidden; }
    .filter-btn { padding: 0.5rem 1.5rem; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; border: 1px solid rgba(201,169,110,0.2); color: #6b6b6b; cursor: pointer; transition: all 0.3s; background: transparent; white-space: nowrap; }
    .filter-btn.active, .filter-btn:hover { border-color: #c9a96e; color: #c9a96e; }
    
    /* Masonry-like grid */
    .portfolio-masonry { columns: 3; column-gap: 12px; }
    .masonry-item { break-inside: avoid; margin-bottom: 12px; }
    @media (max-width: 900px) { .portfolio-masonry { columns: 2; } }
    @media (max-width: 480px) { .portfolio-masonry { columns: 1; } }
    
    /* Project card -->
    .project-card { position: relative; overflow: hidden; cursor: pointer; }
    .project-card img { width: 100%; display: block; transition: transform 0.8s cubic-bezier(0.25,0.46,0.45,0.94); }
    .project-card:hover img { transform: scale(1.06); }
    .project-info { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 40%, transparent 70%); opacity: 0; transition: opacity 0.4s; display: flex; flex-direction: column; justify-content: flex-end; padding: 1.5rem; }
    .project-card:hover .project-info { opacity: 1; }
    
    /* Lightbox */
    #lightbox { position: fixed; inset: 0; background: rgba(0,0,0,0.97); z-index: 9000; display: none; align-items: center; justify-content: center; }
    #lightbox.open { display: flex; }
    #lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="portfolio-hero">
    <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1552058544-f2b08422138a?w=1920&q=80') center/cover no-repeat;"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,10,1) 0%, rgba(10,10,10,0.3) 60%, rgba(10,10,10,0.6) 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 4rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Moje práce</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 400; color: #f5f5f0; line-height: 1.05;">Portfolio<br><em style="color: #c9a96e;">& Projekty</em></h1>
    </div>
</div>

<!-- Filters -->
<div style="position: sticky; top: 96px; z-index: 100; background: rgba(10,10,10,0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(201,169,110,0.1); padding: 1rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: flex; gap: 0.75rem; overflow-x: auto; padding-bottom: 0.25rem;">
            <button class="filter-btn active" data-filter="all">Vše</button>
            <button class="filter-btn" data-filter="politika">Politika</button>
            <button class="filter-btn" data-filter="kultura">Kultura</button>
            <button class="filter-btn" data-filter="sport">Sport</button>
            <button class="filter-btn" data-filter="hudba">Hudba</button>
            <button class="filter-btn" data-filter="film">Film</button>
            <button class="filter-btn" data-filter="byznys">Byznys</button>
        </div>
    </div>
</div>

<!-- Portfolio Grid -->
<section style="padding: 5rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="portfolio-masonry" id="portfolio-grid">
            @php
            $projects = [
                ['img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&h=800&fit=crop', 'name' => 'Tváře české politiky', 'count' => 48, 'cat' => 'politika', 'height' => 'tall'],
                ['img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&h=450&fit=crop', 'name' => 'Divadelní osobnosti', 'count' => 32, 'cat' => 'kultura', 'height' => 'normal'],
                ['img' => 'https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=600&h=600&fit=crop', 'name' => 'Olympijský tým 2024', 'count' => 61, 'cat' => 'sport', 'height' => 'normal'],
                ['img' => 'https://images.unsplash.com/photo-1489980557514-251d61e3eeb6?w=600&h=750&fit=crop', 'name' => 'Čeští hudebníci', 'count' => 29, 'cat' => 'hudba', 'height' => 'tall'],
                ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=500&fit=crop', 'name' => 'Lídři byznysu', 'count' => 44, 'cat' => 'byznys', 'height' => 'normal'],
                ['img' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=600&h=700&fit=crop', 'name' => 'Filmové hvězdy', 'count' => 55, 'cat' => 'film', 'height' => 'tall'],
                ['img' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=600&h=450&fit=crop', 'name' => 'Sportovní legendy', 'count' => 38, 'cat' => 'sport', 'height' => 'normal'],
                ['img' => 'https://images.unsplash.com/photo-1520813792240-56fc4a3765a7?w=600&h=550&fit=crop', 'name' => 'Senát České republiky', 'count' => 26, 'cat' => 'politika', 'height' => 'normal'],
                ['img' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=600&h=800&fit=crop', 'name' => 'Operní pěvci', 'count' => 18, 'cat' => 'kultura', 'height' => 'tall'],
            ];
            @endphp
            @foreach($projects as $p)
            <div class="masonry-item project-card reveal" data-cat="{{ $p['cat'] }}">
                <a href="/portfolio/{{ Str::slug($p['name']) }}" style="display: block; position: relative; overflow: hidden;">
                    <img src="{{ $p['img'] }}" alt="{{ $p['name'] }}" loading="lazy" style="width: 100%; display: block;">
                    <div class="project-info">
                        <div style="font-size: 0.6rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.4rem;">{{ ucfirst($p['cat']) }}</div>
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 1.15rem; color: #f5f5f0; margin-bottom: 0.25rem; font-weight: 400;">{{ $p['name'] }}</h3>
                        <div style="display: flex; align-items: center; gap: 0.5rem; color: rgba(245,245,240,0.5); font-size: 0.75rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            {{ $p['count'] }} fotografií
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Load more -->
        <div class="reveal" style="text-align: center; margin-top: 4rem;">
            <button class="btn-outline">Načíst další projekty</button>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.masonry-item');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const filter = btn.dataset.filter;
            items.forEach(item => {
                if (filter === 'all' || item.dataset.cat === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeIn 0.5s ease forwards';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
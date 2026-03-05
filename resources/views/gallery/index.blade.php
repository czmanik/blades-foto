@extends('layouts.app')

@section('title', 'Galerie — Martin Beck Photography')

@section('head')
<style>
    .gallery-hero { height: 55vh; min-height: 400px; position: relative; display: flex; align-items: flex-end; overflow: hidden; }
    
    /* Gallery grid -->
    .gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 6px; }
    @media (max-width: 1024px) { .gallery-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 640px) { .gallery-grid { grid-template-columns: repeat(2, 1fr); } }
    .gallery-item { position: relative; overflow: hidden; aspect-ratio: 1; cursor: pointer; }
    .gallery-item.wide { grid-column: span 2; aspect-ratio: 2/1; }
    .gallery-item.tall { grid-row: span 2; aspect-ratio: 1/2; }
    .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease, filter 0.4s; filter: grayscale(20%); }
    .gallery-item:hover img { transform: scale(1.08); filter: grayscale(0); }
    .gallery-overlay { position: absolute; inset: 0; background: rgba(201,169,110,0.15); opacity: 0; transition: opacity 0.3s; display: flex; align-items: center; justify-content: center; }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .expand-icon { width: 48px; height: 48px; border: 1px solid rgba(245,245,240,0.6); display: flex; align-items: center; justify-content: center; color: #f5f5f0; }
    
    /* Lightbox */
    #lightbox { position: fixed; inset: 0; background: rgba(0,0,0,0.97); z-index: 9000; align-items: center; justify-content: center; display: none; }
    #lightbox.active { display: flex; }
    #lightbox-img { max-width: 90vw; max-height: 85vh; object-fit: contain; }
    #lightbox-close { position: absolute; top: 1.5rem; right: 1.5rem; color: rgba(245,245,240,0.5); cursor: pointer; background: none; border: none; }
    #lightbox-prev, #lightbox-next { position: absolute; top: 50%; transform: translateY(-50%); background: none; border: none; color: rgba(245,245,240,0.4); cursor: pointer; padding: 1rem; transition: color 0.3s; }
    #lightbox-prev:hover, #lightbox-next:hover { color: #c9a96e; }
    #lightbox-prev { left: 1.5rem; }
    #lightbox-next { right: 1.5rem; }
    #lightbox-caption { position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); text-align: center; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="gallery-hero">
    <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=1920&q=80') center/cover no-repeat;"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,10,1) 0%, rgba(10,10,10,0.3) 60%, rgba(10,10,10,0.6) 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 4rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Fotogalerie</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 400; color: #f5f5f0; line-height: 1.05;">Galerie<br><em style="color: #c9a96e;">fotografií</em></h1>
    </div>
</div>

<!-- Category tabs -->
<div style="background: #111; border-bottom: 1px solid rgba(201,169,110,0.1); padding: 1.25rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: flex; gap: 2rem; overflow-x: auto;">
            <a href="#" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; border-bottom: 1px solid #c9a96e; padding-bottom: 0.25rem; white-space: nowrap; text-decoration: none;">Všechny fotografie</a>
            <a href="#" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; white-space: nowrap; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">Politika</a>
            <a href="#" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; white-space: nowrap; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">Kultura</a>
            <a href="#" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; white-space: nowrap; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">Sport</a>
            <a href="#" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; white-space: nowrap; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">Hudba</a>
        </div>
    </div>
</div>

<!-- Gallery Grid -->
<section style="padding: 3rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="gallery-grid">
            @php
            $photos = [
                ['img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=600&h=600&fit=crop', 'name' => 'Portrét v Senátu', 'cat' => 'Politika', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=600&h=600&fit=crop', 'name' => 'Pohled umělce', 'cat' => 'Kultura', 'wide' => false, 'tall' => true],
                ['img' => 'https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=1200&h=600&fit=crop', 'name' => 'Vítězná chvíle', 'cat' => 'Sport', 'wide' => true, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1489980557514-251d61e3eeb6?w=600&h=600&fit=crop', 'name' => 'Za mikrofonem', 'cat' => 'Hudba', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=600&h=600&fit=crop', 'name' => 'Atletický mistr', 'cat' => 'Sport', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1520813792240-56fc4a3765a7?w=600&h=600&fit=crop', 'name' => 'V zákulisí', 'cat' => 'Kultura', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&h=600&fit=crop', 'name' => 'Obchodní vizionář', 'cat' => 'Byznys', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=600&h=600&fit=crop', 'name' => 'Filmová hvězda', 'cat' => 'Film', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=600&h=600&fit=crop', 'name' => 'Natura', 'cat' => 'Portrét', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=600&h=600&fit=crop', 'name' => 'Technologický lídr', 'cat' => 'Byznys', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1478145046317-39f10e56b5e9?w=600&h=600&fit=crop', 'name' => 'Literární osobnost', 'cat' => 'Kultura', 'wide' => false, 'tall' => false],
                ['img' => 'https://images.unsplash.com/photo-1547425260-76bcadfb4f2c?w=600&h=600&fit=crop', 'name' => 'Pohled do budoucna', 'cat' => 'Politika', 'wide' => false, 'tall' => false],
            ];
            @endphp
            @foreach($photos as $i => $photo)
            <div class="gallery-item {{ $photo['wide'] ? 'wide' : '' }} {{ $photo['tall'] ? 'tall' : '' }} reveal" data-index="{{ $i }}">
                <img src="{{ $photo['img'] }}" alt="{{ $photo['name'] }}" loading="lazy">
                <div class="gallery-overlay">
                    <div class="expand-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6" /></svg>
                    </div>
                </div>
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 1rem; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); transform: translateY(100%); transition: transform 0.4s;" class="photo-meta">
                    <div style="font-size: 0.85rem; color: #f5f5f0; font-family: 'Playfair Display', serif;">{{ $photo['name'] }}</div>
                    <div style="font-size: 0.65rem; color: #c9a96e; letter-spacing: 0.15em; text-transform: uppercase;">{{ $photo['cat'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox">
    <button id="lightbox-close">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
    </button>
    <button id="lightbox-prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
    </button>
    <img id="lightbox-img" src="" alt="">
    <button id="lightbox-next">
        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
    </button>
    <div id="lightbox-caption">
        <div id="lightbox-name" style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #f5f5f0;"></div>
        <div id="lightbox-cat" style="font-size: 0.65rem; color: #c9a96e; letter-spacing: 0.2em; text-transform: uppercase; margin-top: 0.25rem;"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const items = document.querySelectorAll('.gallery-item');
    const lb = document.getElementById('lightbox');
    const lbImg = document.getElementById('lightbox-img');
    const lbName = document.getElementById('lightbox-name');
    const lbCat = document.getElementById('lightbox-cat');
    let current = 0;
    const photos = [
        @foreach($photos as $p)
        { img: '{{ $p['img'] }}', name: '{{ $p['name'] }}', cat: '{{ $p['cat'] }}' },
        @endforeach
    ];
    function openLB(i) { current = i; lbImg.src = photos[i].img; lbName.textContent = photos[i].name; lbCat.textContent = photos[i].cat; lb.classList.add('active'); document.body.style.overflow = 'hidden'; }
    items.forEach((item, i) => item.addEventListener('click', () => openLB(i)));
    document.getElementById('lightbox-close').addEventListener('click', () => { lb.classList.remove('active'); document.body.style.overflow = ''; });
    document.getElementById('lightbox-prev').addEventListener('click', () => openLB((current - 1 + photos.length) % photos.length));
    document.getElementById('lightbox-next').addEventListener('click', () => openLB((current + 1) % photos.length));
    document.addEventListener('keydown', e => { if (!lb.classList.contains('active')) return; if (e.key === 'Escape') { lb.classList.remove('active'); document.body.style.overflow = ''; } if (e.key === 'ArrowLeft') openLB((current - 1 + photos.length) % photos.length); if (e.key === 'ArrowRight') openLB((current + 1) % photos.length); });
    
    // Photo meta hover
    items.forEach(item => {
        const meta = item.querySelector('.photo-meta');
        if (meta) { item.addEventListener('mouseenter', () => meta.style.transform = 'translateY(0)'); item.addEventListener('mouseleave', () => meta.style.transform = 'translateY(100%)'); }
    });
</script>
@endsection
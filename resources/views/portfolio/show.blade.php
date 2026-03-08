@extends('layouts.app')

@section('title', $photo->title . ' — Portfolio | Martin Beck')

@section('head')
<style>
    .portfolio-detail-hero { min-height: 90vh; position: relative; display: flex; align-items: center; justify-content: center; background: #070707; padding: 6rem 0; overflow: hidden; }
    .hero-bg-blur { position: absolute; inset: 0; filter: blur(100px); opacity: 0.15; transform: scale(1.2); }

    .featured-photo-wrap { max-width: 85vw; max-height: 80vh; position: relative; box-shadow: 0 80px 150px -40px rgba(0,0,0,0.8); border: 1px solid rgba(201,169,110,0.1); background: #000; }
    .featured-photo-wrap img { display: block; max-width: 100%; max-height: 80vh; object-fit: contain; transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    .featured-photo-wrap:hover img { transform: scale(1.02); }

    .photo-info-panel { padding: 8rem 0; border-bottom: 1px solid rgba(201,169,110,0.1); background: linear-gradient(to bottom, #0a0a0a, #070707); }
    .photo-specs { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; margin-top: 3rem; }
    @media (max-width: 768px) { .photo-specs { grid-template-columns: 1fr; gap: 1.5rem; } }

    .spec-label { font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.5rem; display: block; }
    .spec-value { font-family: 'Cormorant Garamond', serif; font-size: 1.25rem; color: #f5f5f0; font-style: italic; }

    .next-prev-nav { display: flex; justify-content: space-between; padding: 4rem 0; }
</style>
@endsection

@section('content')

<!-- Hero: The Photo -->
<div class="portfolio-detail-hero">
    <div class="hero-bg-blur" style="background: url('{{ $photo->url }}') center/cover;"></div>
    <div class="featured-photo-wrap reveal">
        <img src="{{ $photo->url }}" alt="{{ $photo->title }}">

        <!-- Floating Info Overlay -->
        <div style="position: absolute; bottom: 2rem; right: 2rem; background: rgba(10,10,10,0.8); backdrop-filter: blur(10px); padding: 1.25rem 2.5rem; border: 1px solid rgba(201,169,110,0.2);" class="hidden md:block">
            <div style="font-size: 0.6rem; color: #c9a96e; letter-spacing: 0.3em; text-transform: uppercase; margin-bottom: 0.25rem;">Lokalita</div>
            <div style="font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #f5f5f0; font-style: italic;">{{ $photo->location ?? 'Praha, Česká republika' }}</div>
        </div>
    </div>
</div>

<!-- Info Panel -->
<section class="photo-info-panel">
    <div class="max-w-4xl mx-auto px-6">
        <div class="reveal">
            <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Příběh fotografie</span>
            </div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4rem); color: #f5f5f0; line-height: 1.1; margin-bottom: 2rem;">{{ $photo->title }}</h1>

            <div style="color: rgba(245,245,240,0.7); font-size: 1.15rem; line-height: 1.8;">
                {{ $photo->description ?? 'Tento snímek zachycuje neopakovatelný moment, kdy se světlo a stín prolnuly v dokonalé harmonii. Autor zde využívá techniky šerosvitu k zdůraznění hloubky a emocí portrétované osobnosti.' }}
            </div>

            <div class="photo-specs">
                <div>
                    <span class="spec-label">Kategorie</span>
                    <span class="spec-value">{{ $photo->category->name }}</span>
                </div>
                <div>
                    <span class="spec-label">Rok vzniku</span>
                    <span class="spec-value">2023</span>
                </div>
                <div>
                    <span class="spec-label">Technika</span>
                    <span class="spec-value">Digital / B&W</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related / Nav -->
<section style="padding: 6rem 0;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 4rem;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; color: #f5f5f0;">Další z této série</h2>
            <a href="{{ route('portfolio.index') }}" class="press-link">Zpět do portfolia</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
            @foreach($related as $r)
            <a href="{{ route('portfolio.show', $r->slug) }}" class="reveal" style="display: block; aspect-ratio: 1/1; overflow: hidden; border: 1px solid rgba(255,255,255,0.05);">
                <img src="{{ $r->url }}" alt="{{ $r->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            </a>
            @endforeach
        </div>

        <div class="next-prev-nav">
             <!-- Simplified navigation -->
             <a href="{{ route('portfolio.index') }}" style="color: #6b6b6b; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; text-decoration: none; display: flex; align-items: center; gap: 1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Předchozí
             </a>
             <a href="{{ route('portfolio.index') }}" style="color: #6b6b6b; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; text-decoration: none; display: flex; align-items: center; gap: 1rem;">
                Následující
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
             </a>
        </div>
    </div>
</section>

<!-- Shop CTA -->
<section style="padding: 10rem 0; background: #050505; text-align: center; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.05) 1px, transparent 1px); background-size: 50px 50px;"></div>
    <div class="max-w-2xl mx-auto px-6 reveal" style="position: relative;">
        <div class="gold-line" style="margin: 0 auto 2.5rem;"></div>
        <h3 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1.5rem; color: #f5f5f0; line-height: 1.2;">Zaujala vás tato<br><em style="color: #c9a96e;">fotografie?</em></h3>
        <p style="color: #6b6b6b; margin-bottom: 3rem; font-size: 1.1rem; line-height: 1.8;">Tento snímek je k dispozici jako limitovaný autorský tisk na galerijním papíře Hahnemühle v mém e-shopu.</p>
        <div style="display: flex; gap: 1rem; justify-content: center;">
            <a href="{{ route('shop.index') }}" class="btn-primary">Přejít do E-shopu</a>
            <a href="{{ route('contact.index') }}" class="btn-outline">Poptat jiný rozměr</a>
        </div>
    </div>
</section>

@endsection
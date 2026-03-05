@extends('layouts.app')

@section('title', $photo->title . ' — Portfolio | Martin Beck')

@section('head')
<style>
    .portfolio-detail-hero { min-height: 80vh; position: relative; display: flex; align-items: center; justify-content: center; background: #0a0a0a; padding: 6rem 0; }

    .featured-photo-wrap { max-width: 90vw; max-height: 85vh; position: relative; box-shadow: 0 50px 100px -20px rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.05); }
    .featured-photo-wrap img { display: block; max-width: 100%; max-height: 85vh; object-fit: contain; }

    .photo-info-panel { padding: 5rem 0; border-bottom: 1px solid rgba(201,169,110,0.1); }
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
    <div class="featured-photo-wrap reveal">
        <img src="{{ $photo->url }}" alt="{{ $photo->title }}">

        <!-- Floating Info Overlay (Optional) -->
        <div style="position: absolute; bottom: -2rem; right: 0; background: #0a0a0a; padding: 1rem 2rem; border: 1px solid rgba(201,169,110,0.2);">
            <div style="font-size: 0.7rem; color: #c9a96e; letter-spacing: 0.1em; text-transform: uppercase;">{{ $photo->location ?? 'Location Unknown' }}</div>
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
            <a href="/portfolio" class="press-link">Zpět do portfolia</a>
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
             <a href="/portfolio" style="color: #6b6b6b; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; text-decoration: none; display: flex; align-items: center; gap: 1rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                Předchozí
             </a>
             <a href="/portfolio" style="color: #6b6b6b; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.2em; text-decoration: none; display: flex; align-items: center; gap: 1rem;">
                Následující
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
             </a>
        </div>
    </div>
</section>

<!-- Shop CTA -->
<section style="padding: 8rem 0; background: #0d0d0d; text-align: center;">
    <div class="max-w-2xl mx-auto px-6 reveal">
        <h3 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; margin-bottom: 1.5rem;">Líbí se vám tento snímek?</h3>
        <p style="color: #6b6b6b; margin-bottom: 2.5rem;">Tento a další snímky jsou k dispozici jako limitované autorské tisky v mém e-shopu.</p>
        <a href="/eshop" class="btn-primary">Koupit tisk</a>
    </div>
</section>

@endsection
@extends('layouts.app')

@section('title', 'Napsali o mně — Martin Beck Photography')

@section('head')
<style>
    .press-hero { height: 45vh; min-height: 350px; position: relative; display: flex; align-items: flex-end; overflow: hidden; background: #0d0d0d; }

    .press-item { padding: 4rem 0; border-bottom: 1px solid rgba(201,169,110,0.1); display: grid; grid-template-columns: 1fr 2fr; gap: 4rem; align-items: center; }
    @media (max-width: 900px) { .press-item { grid-template-columns: 1fr; gap: 2rem; } }

    .press-meta { display: flex; flex-direction: column; gap: 0.5rem; }
    .press-source { font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; font-weight: 600; }
    .press-date { font-size: 0.75rem; color: #6b6b6b; font-family: 'Cormorant Garamond', serif; font-style: italic; }

    .press-quote { font-family: 'Playfair Display', serif; font-size: 1.8rem; color: #f5f5f0; line-height: 1.4; font-style: italic; margin-bottom: 1.5rem; }
    .press-link { display: inline-flex; align-items: center; gap: 0.75rem; color: #c9a96e; text-decoration: none; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; border-bottom: 1px solid rgba(201,169,110,0.3); padding-bottom: 0.25rem; transition: all 0.3s; }
    .press-link:hover { gap: 1.25rem; border-color: #c9a96e; }

    .press-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 6rem; }
    @media (max-width: 768px) { .press-grid { grid-template-columns: 1fr; } }
    .press-snippet-card { background: rgba(255,255,255,0.02); border: 1px solid rgba(201,169,110,0.05); padding: 2.5rem; transition: border-color 0.3s; }
    .press-snippet-card:hover { border-color: rgba(201,169,110,0.3); }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="press-hero">
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.05) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 4rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Výběr z médií a kritik</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4.5rem); color: #f5f5f0; line-height: 1.1; font-weight: 400;">Napsali <em style="color: #c9a96e; font-style: italic;">o mně</em></h1>
    </div>
</div>

<section style="padding: 5rem 0 10rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">

        <!-- Main items -->
        <div class="press-item reveal">
            <div class="press-meta">
                <span class="press-source">Reflex / Art</span>
                <span class="press-date">Leden 2024</span>
                <div style="margin-top: 2rem; width: 80px; height: 1px; background: rgba(201,169,110,0.3);"></div>
            </div>
            <div>
                <blockquote class="press-quote">"Martin Beck nefotí politiky jako figury na šachovnici, ale jako lidské bytosti v jejich nejslabších i nejsilnějších momentech. Jeho nová série 'Tváře české politiky' je vizuálním svědomím naší doby."</blockquote>
                <a href="#" class="press-link">Číst celou recenzi</a>
            </div>
        </div>

        <div class="press-item reveal">
            <div class="press-meta">
                <span class="press-source">Časopis FOTO</span>
                <span class="press-date">Duben 2023</span>
                <div style="margin-top: 2rem; width: 80px; height: 1px; background: rgba(201,169,110,0.3);"></div>
            </div>
            <div>
                <blockquote class="press-quote">"Mistr šerosvitu 21. století. Beckova práce se světlem v divadelních portrétech připomíná renesanční malby, které ožívají v digitálním věku s neuvěřitelnou hloubkou a ostrostí."</blockquote>
                <a href="#" class="press-link">Rozhovor s autorem</a>
            </div>
        </div>

        <div class="press-item reveal">
            <div class="press-meta">
                <span class="press-source">Lidové Noviny</span>
                <span class="press-date">Září 2022</span>
                <div style="margin-top: 2rem; width: 80px; height: 1px; background: rgba(201,169,110,0.3);"></div>
            </div>
            <div>
                <blockquote class="press-quote">"Výstava v Národním divadle dokazuje, že Martin Beck patří ke špičce české portrétní fotografie. Dokáže zachytit 'to něco', co herci skrývají za svými maskami."</blockquote>
                <a href="#" class="press-link">Kritika výstavy</a>
            </div>
        </div>

        <!-- Snippet Grid -->
        <div class="press-grid">
            <div class="press-snippet-card reveal">
                <div class="press-source" style="margin-bottom: 1.5rem;">Hospodářské Noviny</div>
                <p style="color: rgba(245,245,240,0.6); font-size: 0.9rem; line-height: 1.7; font-style: italic;">"Investice do limitovaných tisků Martina Becka se začíná vyplácet nejen sběratelům umění, ale i lidem, kteří chtějí mít doma skutečnou kvalitu s duší."</p>
            </div>
            <div class="press-snippet-card reveal">
                <div class="press-source" style="margin-bottom: 1.5rem;">Reportér Magazín</div>
                <p style="color: rgba(245,245,240,0.6); font-size: 0.9rem; line-height: 1.7; font-style: italic;">"Rozhovor o tom, jak se fotí mocní. Beck odkrývá, že nejtěžší je získat si důvěru a nechat objekt zapomenout na přítomnost objektivu."</p>
            </div>
            <div class="press-snippet-card reveal">
                <div class="press-source" style="margin-bottom: 1.5rem;">Český Rozhlas Vltava</div>
                <p style="color: rgba(245,245,240,0.6); font-size: 0.9rem; line-height: 1.7; font-style: italic;">"Audio-esej o tichu ve fotografii Martina Becka. O tom, jak černobílá škála dokáže mluvit hlasitěji než tisíc barev."</p>
            </div>
        </div>

    </div>
</section>

@endsection
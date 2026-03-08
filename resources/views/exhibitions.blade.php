@extends('layouts.app')

@section('title', 'Výstavy — Martin Beck Photography')

@section('head')
<style>
    .exhibitions-hero { height: 50vh; min-height: 400px; position: relative; display: flex; align-items: flex-end; overflow: hidden; background: #0d0d0d; }

    .exhibition-card { position: relative; padding-left: 5rem; margin-bottom: 6rem; border-left: 1px solid rgba(201,169,110,0.2); }
    .exhibition-year { position: absolute; left: -3.5rem; top: 0; font-family: 'Cormorant Garamond', serif; font-size: 2.5rem; font-style: italic; color: #c9a96e; background: #0a0a0a; padding: 0 1rem; line-height: 1; }

    .exhibition-img-wrap { aspect-ratio: 3/2; overflow: hidden; margin-top: 2rem; border: 1px solid rgba(201,169,110,0.1); }
    .exhibition-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s; }
    .exhibition-card:hover .exhibition-img-wrap img { transform: scale(1.05); }

    .status-badge { display: inline-block; padding: 0.25rem 0.75rem; background: rgba(201,169,110,0.1); border: 1px solid rgba(201,169,110,0.3); color: #c9a96e; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1rem; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="exhibitions-hero">
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.05) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 5rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Historie a současnost</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 5vw, 4.5rem); color: #f5f5f0; line-height: 1.1; font-weight: 400;">Samostatné <em style="color: #c9a96e; font-style: italic;">výstavy</em></h1>
    </div>
</div>

<section style="padding: 8rem 0;">
    <div class="max-w-4xl mx-auto px-6 md:px-12">

        <!-- Current/Upcoming -->
        <div class="exhibition-card reveal">
            <span class="exhibition-year">2024</span>
            <div class="status-badge">Právě probíhá</div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #f5f5f0; line-height: 1.2; margin-bottom: 1rem;">Tváře české politiky</h2>
            <div style="font-size: 0.85rem; color: #6b6b6b; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1.5rem;">Galerie Mánes, Praha | 1. 10. – 30. 11. 2024</div>
            <p style="color: rgba(245,245,240,0.7); font-size: 1.05rem; line-height: 1.8;">Retrospektivní výstava portrétů zachycujících klíčové postavy porevoluční politické scény. Výstava se zaměřuje na "lidský rozměr" moci skrze intimní černobílé portréty.</p>

            <div class="exhibition-img-wrap">
                <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=1000&q=80" alt="Výstava Mánes">
            </div>
        </div>

        <!-- Past -->
        <div class="exhibition-card reveal">
            <span class="exhibition-year">2022</span>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #f5f5f0; line-height: 1.2; margin-bottom: 1rem;">Divadlo vteřin</h2>
            <div style="font-size: 0.85rem; color: #6b6b6b; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1.5rem;">Národní divadlo, Praha | Červen 2022</div>
            <p style="color: rgba(245,245,240,0.7); font-size: 1rem; line-height: 1.8;">Série fotografií z divadelního zákulisí, zachycující herce v momentě těsně před vstupem na scénu. Syrové emoce a napětí v šerosvitu divadelních chodeb.</p>

            <div class="exhibition-img-wrap">
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=1000&q=80" alt="Výstava ND">
            </div>
        </div>

        <div class="exhibition-card reveal">
            <span class="exhibition-year">2019</span>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #f5f5f0; line-height: 1.2; margin-bottom: 1rem;">Barvy vítězství</h2>
            <div style="font-size: 0.85rem; color: #6b6b6b; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1.5rem;">Olympijský dům, Praha | Září 2019</div>
            <p style="color: rgba(245,245,240,0.7); font-size: 1rem; line-height: 1.8;">Dokumentace cesty českých olympioniků za medailemi. Dynamické sportovní záběry střídané s portréty vyčerpání i euforie po závodě.</p>

            <div class="exhibition-img-wrap">
                <img src="https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=1000&q=80" alt="Výstava Sport">
            </div>
        </div>

        <div class="exhibition-card reveal">
            <span class="exhibition-year">2016</span>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 2.2rem; color: #f5f5f0; line-height: 1.2; margin-bottom: 1rem;">Ozvěny ticha</h2>
            <div style="font-size: 0.85rem; color: #6b6b6b; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1.5rem;">Krajinná galerie, Šumava | Léto 2016</div>
            <p style="color: rgba(245,245,240,0.7); font-size: 1rem; line-height: 1.8;">Krajinná série zaměřená na opuštěná místa českého pohraničí. Rozlehlé horizonty a melancholie mizející architektury.</p>
        </div>

    </div>
</section>

<!-- Call to action -->
<section style="padding: 10rem 0; background: #0d0d0d; border-top: 1px solid rgba(201,169,110,0.1); text-align: center;">
    <div class="max-w-3xl mx-auto px-6 reveal">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 2rem;">Máte zájem o výstavu?</h2>
        <p style="color: #6b6b6b; margin-bottom: 3rem; line-height: 1.8;">Pokud reprezentujete galerii nebo kulturní instituci a máte zájem o spolupráci na výstavním projektu, neváhejte mě kontaktovat.</p>
        <a href="{{ route('contact.index') }}" class="btn-primary">Napsat mi</a>
    </div>
</section>

@endsection
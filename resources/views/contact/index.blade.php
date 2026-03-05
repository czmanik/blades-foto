@extends('layouts.app')

@section('title', 'Kontakt — Martin Beck Photography')

@section('head')
<style>
    .contact-hero { height: 50vh; min-height: 380px; position: relative; display: flex; align-items: flex-end; overflow: hidden; }
    .input-field { width: 100%; background: transparent; border: none; border-bottom: 1px solid rgba(201,169,110,0.2); padding: 0.75rem 0; color: #f5f5f0; font-family: 'Inter', sans-serif; font-size: 0.9rem; outline: none; transition: border-color 0.3s; }
    .input-field:focus { border-bottom-color: #c9a96e; }
    .input-field::placeholder { color: #6b6b6b; font-size: 0.85rem; }
    .input-label { font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.5rem; display: block; }
    .service-card { border: 1px solid rgba(201,169,110,0.1); padding: 2rem; cursor: pointer; transition: all 0.3s; }
    .service-card:hover, .service-card.selected { border-color: #c9a96e; background: rgba(201,169,110,0.05); }
    textarea.input-field { resize: none; min-height: 120px; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="contact-hero">
    <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=1920&q=80') center/cover no-repeat; filter: grayscale(30%);"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,10,1) 0%, rgba(10,10,10,0.2) 60%, rgba(10,10,10,0.6) 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 4rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Pojďme spolupracovat</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 400; color: #f5f5f0; line-height: 1.05;">Kontakt<br><em style="color: #c9a96e;">& spolupráce</em></h1>
    </div>
</div>

<!-- Main content -->
<section style="padding: 6rem 0 10rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 8rem; align-items: start;" class="contact-grid">

            <!-- Left: Info -->
            <div class="reveal-left">
                <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 2rem;">
                    <div class="gold-line"></div>
                    <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Kde mě najdete</span>
                </div>
                <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 400; color: #f5f5f0; margin-bottom: 1.5rem; line-height: 1.2;">Rád se s vámi<br><em style="color: #c9a96e;">setkám osobně</em></h2>
                <p style="color: #6b6b6b; font-size: 0.9rem; line-height: 1.9; margin-bottom: 3rem;">Ateliér i exteriérová focení realizuji především v Praze a okolí. Pro větší projekty cestuji po celé ČR i v zahraničí.</p>

                <!-- Contact items -->
                <div style="display: flex; flex-direction: column; gap: 2rem; margin-bottom: 3rem;">
                    @php
                    $contacts = [
                        ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />', 'label' => 'E-mail', 'value' => 'info@martinbeck.com', 'href' => 'mailto:info@martinbeck.com'],
                        ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />', 'label' => 'Telefon', 'value' => '+420 123 456 789', 'href' => 'tel:+420123456789'],
                        ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />', 'label' => 'Ateliér', 'value' => 'Vinohradská 25, Praha 2', 'href' => '#'],
                        ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />', 'label' => 'Pracovní doba', 'value' => 'Po–Pá 9:00–18:00', 'href' => null],
                    ];
                    @endphp
                    @foreach($contacts as $c)
                    <div style="display: flex; align-items: flex-start; gap: 1.25rem;">
                        <div style="width: 44px; height: 44px; border: 1px solid rgba(201,169,110,0.2); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5">{!! $c['icon'] !!}</svg>
                        </div>
                        <div>
                            <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; margin-bottom: 0.25rem;">{{ $c['label'] }}</div>
                            @if($c['href'])
                            <a href="{{ $c['href'] }}" style="color: #f5f5f0; font-size: 0.9rem; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#f5f5f0'">{{ $c['value'] }}</a>
                            @else
                            <span style="color: #f5f5f0; font-size: 0.9rem;">{{ $c['value'] }}</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Social -->
                <div>
                    <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; margin-bottom: 1rem;">Sledujte mě</div>
                    <div style="display: flex; gap: 1rem;">
                        <a href="#" style="width: 40px; height: 40px; border: 1px solid rgba(201,169,110,0.2); display: flex; align-items: center; justify-content: center; color: #6b6b6b; transition: all 0.3s;" onmouseover="this.style.borderColor='#c9a96e'; this.style.color='#c9a96e';" onmouseout="this.style.borderColor='rgba(201,169,110,0.2)'; this.style.color='#6b6b6b';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" style="width: 40px; height: 40px; border: 1px solid rgba(201,169,110,0.2); display: flex; align-items: center; justify-content: center; color: #6b6b6b; transition: all 0.3s;" onmouseover="this.style.borderColor='#c9a96e'; this.style.color='#c9a96e';" onmouseout="this.style.borderColor='rgba(201,169,110,0.2)'; this.style.color='#6b6b6b';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="reveal-right">
                @if(session('success'))
                <div style="background: rgba(201,169,110,0.1); border: 1px solid rgba(201,169,110,0.3); padding: 1.25rem 1.5rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <span style="color: #c9a96e; font-size: 0.9rem;">{{ session('success') }}</span>
                </div>
                @endif

                <!-- Service selector -->
                <div style="margin-bottom: 3rem;">
                    <label class="input-label">Typ spolupráce</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; margin-top: 0.75rem;">
                        @foreach(['Portrétní focení', 'Komerční fotografie', 'Koupě tisku', 'Jiné'] as $service)
                        <div class="service-card" onclick="this.classList.toggle('selected')">
                            <div style="font-size: 0.85rem; color: #f5f5f0;">{{ $service }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <form action="/kontakt" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <label class="input-label" for="name">Jméno</label>
                            <input type="text" id="name" name="name" class="input-field" placeholder="Jan Novák" required value="{{ old('name') }}">
                            @error('name')<span style="color: #e55; font-size: 0.75rem;">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="input-label" for="email">E-mail</label>
                            <input type="email" id="email" name="email" class="input-field" placeholder="jan@example.com" required value="{{ old('email') }}">
                            @error('email')<span style="color: #e55; font-size: 0.75rem;">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div>
                        <label class="input-label" for="phone">Telefon <span style="color: #6b6b6b; text-transform: none; letter-spacing: 0;">(volitelné)</span></label>
                        <input type="tel" id="phone" name="phone" class="input-field" placeholder="+420 123 456 789" value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label class="input-label" for="subject">Předmět</label>
                        <input type="text" id="subject" name="subject" class="input-field" placeholder="Zájem o portrétní focení" required value="{{ old('subject') }}">
                    </div>
                    <div>
                        <label class="input-label" for="message">Zpráva</label>
                        <textarea id="message" name="message" class="input-field" placeholder="Napište mi o vašem projektu, záměru, termínu..." required style="min-height: 140px;">{{ old('message') }}</textarea>
                        @error('message')<span style="color: #e55; font-size: 0.75rem;">{{ $message }}</span>@enderror
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <input type="checkbox" id="gdpr" name="gdpr" required style="accent-color: #c9a96e; width: 16px; height: 16px;">
                        <label for="gdpr" style="font-size: 0.8rem; color: #6b6b6b;">Souhlasím se <a href="#" style="color: #c9a96e; text-decoration: none;">zpracováním osobních údajů</a></label>
                    </div>
                    <button type="submit" class="btn-primary" style="align-self: flex-start;">
                        Odeslat zprávu
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<style>
@media (max-width: 900px) {
    .contact-grid { grid-template-columns: 1fr !important; gap: 4rem !important; }
}
</style>
@endsection
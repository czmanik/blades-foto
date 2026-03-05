@extends('layouts.app')
@section('title', '500 — Chyba serveru')
@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; padding: 2rem; position: relative; overflow: hidden;">
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.04) 1px, transparent 1px); background-size: 40px 40px;"></div>
    <div style="position: relative;">
        <div style="font-family: 'Cormorant Garamond', serif; font-size: clamp(8rem, 20vw, 16rem); color: rgba(201,169,110,0.06); line-height: 0.85; font-weight: 300; letter-spacing: -0.05em; user-select: none;">500</div>
        <div style="margin-top: -3rem; position: relative;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div class="gold-line"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Chyba serveru</span>
                <div class="gold-line"></div>
            </div>
            <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(1.5rem, 4vw, 2.5rem); color: #f5f5f0; margin-bottom: 1rem; font-weight: 400;">Technická chyba</h1>
            <p style="color: #6b6b6b; font-size: 0.9rem; max-width: 400px; margin: 0 auto 2.5rem; line-height: 1.8;">Na serveru nastala neočekávaná chyba. Pracujeme na jejím odstranění. Zkuste to prosím za chvíli.</p>
            <a href="/" class="btn-primary">Zpět na domovskou stránku</a>
        </div>
    </div>
</div>
@endsection
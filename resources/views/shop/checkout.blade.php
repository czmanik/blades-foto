@extends('layouts.app')

@section('title', 'Pokladna — Martin Beck Photography')

@section('head')
<style>
    .checkout-grid { display: grid; grid-template-columns: 1fr 400px; gap: 4rem; align-items: start; }
    @media (max-width: 1024px) { .checkout-grid { grid-template-columns: 1fr; gap: 3rem; } }

    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: #6b6b6b; margin-bottom: 0.5rem; }
    .form-control { width: 100%; padding: 1rem; background: #111; border: 1px solid rgba(201,169,110,0.2); color: #f5f5f0; outline: none; transition: border-color 0.3s; }
    .form-control:focus { border-color: #c9a96e; }

    .summary-box { background: #0d0d0d; border: 1px solid rgba(201,169,110,0.1); padding: 2.5rem; position: sticky; top: 120px; }
    .summary-item { display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.9rem; }
</style>
@endsection

@section('content')

<div style="padding: 12rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <h1 style="font-family: 'Playfair Display', serif; font-size: 3rem; color: #f5f5f0; margin-bottom: 4rem;">Pokladna</h1>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="checkout-grid">
                <!-- Left: Form -->
                <div>
                    <h2 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #c9a96e; margin-bottom: 2rem;">Osobní údaje</h2>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">Jméno a příjmení</label>
                            <input type="text" name="name" class="form-control" required placeholder="Jan Novák">
                        </div>
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control" required placeholder="jan@priklad.cz">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Telefon</label>
                        <input type="text" name="phone" class="form-control" required placeholder="+420 777 000 000">
                    </div>

                    <h2 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: #c9a96e; margin-top: 3rem; margin-bottom: 2rem;">Doručovací adresa</h2>

                    <div class="form-group">
                        <label class="form-label">Ulice a č.p.</label>
                        <input type="text" name="address" class="form-control" required placeholder="Vodičkova 123">
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="form-label">Město</label>
                            <input type="text" name="city" class="form-control" required placeholder="Praha">
                        </div>
                        <div class="form-group">
                            <label class="form-label">PSČ</label>
                            <input type="text" name="zip" class="form-control" required placeholder="110 00">
                        </div>
                    </div>
                </div>

                <!-- Right: Summary -->
                <aside>
                    <div class="summary-box">
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; margin-bottom: 1.5rem;">Shrnutí objednávky</h3>

                        <div style="margin-bottom: 2rem; border-bottom: 1px solid rgba(201,169,110,0.1); padding-bottom: 1.5rem;">
                            @foreach($cart as $item)
                            <div class="summary-item">
                                <span style="color: #6b6b6b;">{{ $item['name'] }} ({{ $item['quantity'] }}×)</span>
                                <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Kč</span>
                            </div>
                            @endforeach
                        </div>

                        <div class="summary-item">
                            <span style="color: #6b6b6b;">Doprava</span>
                            <span>Zdarma</span>
                        </div>

                        <div class="summary-item" style="font-size: 1.25rem; font-weight: 600; color: #f5f5f0; margin-top: 2rem;">
                            <span>Celkem</span>
                            <span style="color: #c9a96e;">{{ number_format($total, 0, ',', ' ') }} Kč</span>
                        </div>

                        <button type="submit" class="btn-primary w-full mt-8" style="justify-content: center; width: 100%;">
                            Odeslat objednávku
                        </button>

                        <div style="margin-top: 1.5rem; display: flex; items-center; gap: 0.5rem; justify-content: center; font-size: 0.7rem; color: #444; text-transform: uppercase; letter-spacing: 0.1em;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Zabezpečená platba
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
</div>

@endsection

@extends('layouts.app')

@section('title', 'Košík — Martin Beck E-shop')

@section('head')
<style>
    .cart-hero { height: 35vh; min-height: 280px; position: relative; display: flex; align-items: flex-end; overflow: hidden; background: #0d0d0d; }
    .cart-item { display: grid; grid-template-columns: 100px 1fr auto; gap: 1.5rem; align-items: center; padding: 1.5rem 0; border-bottom: 1px solid rgba(201,169,110,0.08); }
    @media (max-width: 600px) { .cart-item { grid-template-columns: 80px 1fr; } }
    .qty-btn { width: 32px; height: 32px; border: 1px solid rgba(201,169,110,0.2); background: transparent; color: #c9a96e; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; font-size: 1rem; }
    .qty-btn:hover { border-color: #c9a96e; background: rgba(201,169,110,0.1); }
    .qty-input { width: 44px; height: 32px; background: transparent; border: 1px solid rgba(201,169,110,0.2); text-align: center; color: #f5f5f0; font-size: 0.9rem; }
    .remove-btn { background: none; border: none; color: #6b6b6b; cursor: pointer; transition: color 0.3s; padding: 0.25rem; }
    .remove-btn:hover { color: #e55; }
    .order-summary { background: #111; border: 1px solid rgba(201,169,110,0.1); padding: 2rem; position: sticky; top: 140px; }
    .summary-row { display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(201,169,110,0.05); font-size: 0.875rem; }
    .summary-row:last-of-type { border-bottom: none; }
    .promo-input { flex: 1; background: transparent; border: 1px solid rgba(201,169,110,0.2); color: #f5f5f0; padding: 0.6rem 1rem; font-size: 0.85rem; outline: none; }
    .promo-input:focus { border-color: #c9a96e; }
    .promo-btn { padding: 0.6rem 1.25rem; background: transparent; border: 1px solid rgba(201,169,110,0.3); color: #c9a96e; font-size: 0.7rem; letter-spacing: 0.15em; cursor: pointer; transition: all 0.3s; }
    .promo-btn:hover { background: #c9a96e; color: #0a0a0a; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="cart-hero">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);"></div>
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.03) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 3.5rem;">
        <nav style="font-size: 0.75rem; color: #6b6b6b; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
            <a href="/" style="color: #6b6b6b; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">Domů</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            <a href="/eshop" style="color: #6b6b6b; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='#6b6b6b'">E-shop</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
            <span style="color: #c9a96e;">Košík</span>
        </nav>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 5vw, 4rem); font-weight: 400; color: #f5f5f0;">Váš košík</h1>
    </div>
</div>

<!-- Cart content -->
<section style="padding: 5rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        @php
        $cartItems = [
            ['img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=200&h=200&fit=crop', 'name' => 'Politický portrét I.', 'size' => '60×90 cm', 'material' => 'Fine Art papír', 'edition' => '12/25', 'price' => 3200, 'qty' => 1],
            ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop', 'name' => 'Vůdce mysli', 'size' => '40×60 cm', 'material' => 'Hliníková deska', 'edition' => null, 'price' => 2100, 'qty' => 2],
        ];
        $subtotal = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cartItems));
        $shipping = $subtotal >= 2000 ? 0 : 290;
        $total = $subtotal + $shipping;
        @endphp

        @if(count($cartItems) > 0)
        <div style="display: grid; grid-template-columns: 1fr 360px; gap: 4rem; align-items: start;" class="cart-layout">

            <!-- Cart items -->
            <div>
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid rgba(201,169,110,0.1);">
                    <span style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #6b6b6b;">{{ count($cartItems) }} položky v košíku</span>
                    <a href="/eshop" style="font-size: 0.75rem; color: #c9a96e; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" /></svg>
                        Pokračovat v nákupu
                    </a>
                </div>

                @foreach($cartItems as $item)
                <div class="cart-item">
                    <!-- Image -->
                    <div style="overflow: hidden; aspect-ratio: 1;">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <!-- Details -->
                    <div>
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #f5f5f0; margin-bottom: 0.4rem;">{{ $item['name'] }}</h3>
                        <div style="font-size: 0.78rem; color: #6b6b6b; margin-bottom: 0.25rem;">Formát: {{ $item['size'] }}</div>
                        <div style="font-size: 0.78rem; color: #6b6b6b; margin-bottom: 0.25rem;">Materiál: {{ $item['material'] }}</div>
                        @if($item['edition'])<div style="font-size: 0.7rem; color: #c9a96e; letter-spacing: 0.1em;">Edice: {{ $item['edition'] }}</div>@endif
                        <!-- Mobile qty -->
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;" class="md:hidden">
                            <button class="qty-btn">−</button>
                            <input type="number" class="qty-input" value="{{ $item['qty'] }}" min="1">
                            <button class="qty-btn">+</button>
                            <span style="color: #c9a96e; font-size: 0.95rem; margin-left: 1rem;">{{ number_format($item['price'] * $item['qty'], 0, ',', ' ') }} Kč</span>
                        </div>
                    </div>
                    <!-- Price + qty (desktop) -->
                    <div style="text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 1rem;" class="hidden md:flex">
                        <span style="color: #c9a96e; font-size: 1rem; font-weight: 500;">{{ number_format($item['price'] * $item['qty'], 0, ',', ' ') }} Kč</span>
                        <div style="display: flex; align-items: center; gap: 0.4rem;">
                            <button class="qty-btn">−</button>
                            <input type="number" class="qty-input" value="{{ $item['qty'] }}" min="1">
                            <button class="qty-btn">+</button>
                        </div>
                        <button class="remove-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                    </div>
                </div>
                @endforeach

                <!-- Trust badges -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(201,169,110,0.08);">
                    @foreach(['🔒 Bezpečná platba', '📦 Balení zdarma', '✅ Certifikát pravosti'] as $badge)
                    <div style="text-align: center; font-size: 0.78rem; color: #6b6b6b;">{{ $badge }}</div>
                    @endforeach
                </div>
            </div>

            <!-- Order summary -->
            <div class="order-summary">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #f5f5f0; margin-bottom: 1.5rem; font-weight: 400;">Shrnutí objednávky</h2>

                <div class="summary-row">
                    <span style="color: #6b6b6b;">Mezisoučet</span>
                    <span style="color: #f5f5f0;">{{ number_format($subtotal, 0, ',', ' ') }} Kč</span>
                </div>
                <div class="summary-row">
                    <span style="color: #6b6b6b;">Doprava</span>
                    <span style="color: {{ $shipping === 0 ? '#4ade80' : '#f5f5f0' }};">{{ $shipping === 0 ? 'Zdarma' : number_format($shipping, 0, ',', ' ') . ' Kč' }}</span>
                </div>
                @if($shipping === 0)
                <div style="font-size: 0.75rem; color: #4ade80; padding-bottom: 0.75rem;">✓ Objednávka nad 2 000 Kč — doprava zdarma</div>
                @endif
                <div class="summary-row" style="border-bottom: none; padding-top: 1rem; margin-top: 0.5rem; border-top: 1px solid rgba(201,169,110,0.2);">
                    <span style="color: #f5f5f0; font-weight: 500;">Celkem</span>
                    <span style="color: #c9a96e; font-size: 1.2rem; font-weight: 500;">{{ number_format($total, 0, ',', ' ') }} Kč</span>
                </div>

                <!-- Promo code -->
                <div style="margin: 1.5rem 0;">
                    <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; margin-bottom: 0.75rem;">Slevový kód</div>
                    <div style="display: flex; gap: 0;">
                        <input type="text" class="promo-input" placeholder="Zadejte kód">
                        <button class="promo-btn">Použít</button>
                    </div>
                </div>

                <a href="/objednavka" class="btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem; display: flex;">
                    Přejít k pokladně
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                </a>

                <!-- Payment methods -->
                <div style="margin-top: 1.5rem; text-align: center;">
                    <div style="font-size: 0.65rem; color: #6b6b6b; margin-bottom: 0.75rem;">Přijímáme platby</div>
                    <div style="display: flex; justify-content: center; gap: 0.75rem; flex-wrap: wrap;">
                        @foreach(['Visa', 'Mastercard', 'Apple Pay', 'PayPal', 'Bankovní převod'] as $pm)
                        <span style="font-size: 0.65rem; color: #6b6b6b; border: 1px solid rgba(255,255,255,0.08); padding: 0.25rem 0.6rem;">{{ $pm }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        @else
        <!-- Empty cart -->
        <div style="text-align: center; padding: 8rem 0;">
            <div style="width: 80px; height: 80px; border: 1px solid rgba(201,169,110,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="rgba(201,169,110,0.4)" stroke-width="1"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" /></svg>
            </div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.8rem; color: #f5f5f0; margin-bottom: 1rem;">Košík je prázdný</h2>
            <p style="color: #6b6b6b; font-size: 0.9rem; margin-bottom: 2rem;">Přidejte si oblíbené fotografie do košíku.</p>
            <a href="/eshop" class="btn-primary">Prozkoumat E-shop</a>
        </div>
        @endif
    </div>
</section>

@endsection

@section('scripts')
<style>
@media (max-width: 900px) {
    .cart-layout { grid-template-columns: 1fr !important; }
}
</style>
@endsection
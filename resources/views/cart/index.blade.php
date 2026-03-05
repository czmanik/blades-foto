@extends('layouts.app')

@section('title', 'Košík — Martin Beck E-shop')

@section('head')
<style>
    .cart-hero { height: 35vh; min-height: 280px; position: relative; display: flex; align-items: flex-end; overflow: hidden; background: #0d0d0d; }
    .cart-item { display: grid; grid-template-columns: 100px 1fr auto; gap: 1.5rem; align-items: center; padding: 1.5rem 0; border-bottom: 1px solid rgba(201,169,110,0.08); }
    @media (max-width: 600px) { .cart-item { grid-template-columns: 80px 1fr; } }
    .qty-btn { width: 32px; height: 32px; border: 1px solid rgba(201,169,110,0.2); background: transparent; color: #c9a96e; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s; font-size: 1rem; }
    .qty-btn:hover { border-color: #c9a96e; background: rgba(201,169,110,0.1); }
    .qty-display { width: 44px; height: 32px; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(201,169,110,0.2); text-align: center; color: #f5f5f0; font-size: 0.9rem; }
    .remove-btn { background: none; border: none; color: #6b6b6b; cursor: pointer; transition: color 0.3s; padding: 0.25rem; }
    .remove-btn:hover { color: #e55; }
    .order-summary { background: #111; border: 1px solid rgba(201,169,110,0.1); padding: 2rem; position: sticky; top: 140px; }
    .summary-row { display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid rgba(201,169,110,0.05); font-size: 0.875rem; }
</style>
@endsection

@section('content')

<div class="cart-hero">
    <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #0d0d0d 0%, #1a1a1a 100%);"></div>
    <div style="position: absolute; inset: 0; background-image: radial-gradient(rgba(201,169,110,0.03) 1px, transparent 1px); background-size: 30px 30px;"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 3.5rem;">
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2rem, 5vw, 4rem); font-weight: 400; color: #f5f5f0;">Váš košík</h1>
    </div>
</div>

<section style="padding: 5rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        @if(count($cart) > 0)
        <div style="display: grid; grid-template-columns: 1fr 360px; gap: 4rem; align-items: start;">
            <!-- Cart items -->
            <div>
                @foreach($cart as $id => $item)
                <div class="cart-item">
                    <div style="overflow: hidden; aspect-ratio: 1; background: #111;">
                        <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=200&h=200&fit=crop" alt="{{ $item['name'] }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.5;">
                    </div>
                    <div>
                        <h3 style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #f5f5f0; margin-bottom: 0.4rem;">{{ $item['name'] }}</h3>
                        <div style="font-size: 0.95rem; color: #c9a96e;">{{ number_format($item['price'], 0, ',', ' ') }} Kč</div>
                    </div>
                    <div style="text-align: right; display: flex; flex-direction: column; align-items: flex-end; gap: 1rem;">
                        <span style="color: #c9a96e; font-size: 1rem; font-weight: 500;">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} Kč</span>
                        <div style="display: flex; align-items: center; gap: 0.4rem;">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
                                <button type="submit" class="qty-btn" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>−</button>
                            </form>
                            <span class="qty-display">{{ $item['quantity'] }}</span>
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                <button type="submit" class="qty-btn">+</button>
                            </form>
                        </div>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Summary -->
            <div class="order-summary">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: #f5f5f0; margin-bottom: 1.5rem; font-weight: 400;">Shrnutí</h2>
                <div class="summary-row">
                    <span style="color: #6b6b6b;">Mezisoučet</span>
                    <span style="color: #f5f5f0;">{{ number_format($total, 0, ',', ' ') }} Kč</span>
                </div>
                <div class="summary-row">
                    <span style="color: #6b6b6b;">Doprava</span>
                    <span style="color: #f5f5f0;">{{ $shipping === 0 ? 'Zdarma' : number_format($shipping, 0, ',', ' ') . ' Kč' }}</span>
                </div>
                <div class="summary-row" style="border-bottom: none; padding-top: 1rem; margin-top: 1rem; border-top: 1px solid rgba(201,169,110,0.2);">
                    <span style="color: #f5f5f0; font-weight: 500;">Celkem</span>
                    <span style="color: #c9a96e; font-size: 1.2rem; font-weight: 500;">{{ number_format($total + $shipping, 0, ',', ' ') }} Kč</span>
                </div>
                <a href="{{ route('checkout.index') }}" class="btn-primary" style="width: 100%; justify-content: center; margin-top: 2rem; display: flex;">
                    Přejít k pokladně
                </a>
            </div>
        </div>
        @else
        <div style="text-align: center; padding: 8rem 0;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.8rem; color: #f5f5f0; margin-bottom: 1rem;">Košík je prázdný</h2>
            <a href="/eshop" class="btn-primary">Prozkoumat E-shop</a>
        </div>
        @endif
    </div>
</section>

@endsection

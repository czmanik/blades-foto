@extends('layouts.app')

@section('title', 'E-shop — Fotografické tisky | Martin Beck')

@section('head')
<style>
    .shop-hero { height: 55vh; min-height: 420px; position: relative; display: flex; align-items: flex-end; overflow: hidden; }
    
    /* Product card */
    .product-card { background: #111; border: 1px solid rgba(201,169,110,0.08); transition: border-color 0.4s, transform 0.4s; height: 100%; display: flex; flex-direction: column; }
    .product-card:hover { border-color: rgba(201,169,110,0.3); transform: translateY(-4px); }
    .product-img-wrap { position: relative; overflow: hidden; aspect-ratio: 4/5; }
    .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; filter: grayscale(10%); }
    .product-card:hover .product-img-wrap img { transform: scale(1.05); filter: grayscale(0); }
    
    /* Product actions */
    .product-actions { position: absolute; bottom: 0; left: 0; right: 0; transform: translateY(100%); transition: transform 0.4s ease; background: rgba(10,10,10,0.95); padding: 1rem; }
    .product-card:hover .product-actions { transform: translateY(0); }
    .add-to-cart-btn { width: 100%; padding: 0.75rem; background: #c9a96e; color: #0a0a0a; border: none; cursor: pointer; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; transition: background 0.3s; }
    .add-to-cart-btn:hover { background: #b8965e; }
    
    /* Sidebar filter */
    .sidebar-section { border-bottom: 1px solid rgba(201,169,110,0.08); padding-bottom: 2rem; margin-bottom: 2rem; }
</style>
@endsection

@section('content')

<!-- Hero -->
<div class="shop-hero">
    <div style="position: absolute; inset: 0; background: url('https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=1920&q=80') center/cover no-repeat;"></div>
    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(10,10,10,1) 0%, rgba(10,10,10,0.2) 60%, rgba(10,10,10,0.5) 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20 w-full" style="position: relative; padding-bottom: 4rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1rem;">
            <div style="width: 40px; height: 1px; background: #c9a96e;"></div>
            <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Fotografické tisky</span>
        </div>
        <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 6vw, 5rem); font-weight: 400; color: #f5f5f0; line-height: 1.05;">E-shop<br><em style="color: #c9a96e;">& tisky</em></h1>
        <p style="color: rgba(245,245,240,0.6); margin-top: 1rem; max-width: 500px; line-height: 1.8;">Limitované fotografické tisky na prémiových materiálech. Každý výtisk je signovaný a opatřen certifikátem pravosti.</p>
    </div>
</div>

<!-- Main shop area -->
<section style="padding: 5rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: grid; grid-template-columns: 260px 1fr; gap: 4rem; align-items: start;" class="lg:grid-cols-shop">

            <!-- SIDEBAR -->
            <aside style="position: sticky; top: 140px;" class="hidden lg:block">
                <div class="sidebar-section">
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Kategorie</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <a href="{{ route('shop.index') }}" style="font-size: 0.85rem; color: {{ !request('kategorie') ? '#c9a96e' : '#6b6b6b' }};">Všechny produkty</a>
                        @foreach($categories as $category)
                        <a href="{{ route('shop.index', ['kategorie' => $category->slug]) }}"
                           style="font-size: 0.85rem; color: {{ request('kategorie') == $category->slug ? '#c9a96e' : '#6b6b6b' }};">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- PRODUCT GRID -->
            <div>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;" class="grid-cols-products">
                    @forelse($products as $product)
                    <div class="product-card reveal">
                        <div class="product-img-wrap">
                            <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=500&h=650&fit=crop' }}" alt="{{ $product->name }}">

                            <div class="product-actions">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                                    <input type="hidden" name="product_price" value="{{ $product->price }}">
                                    <button type="submit" class="add-to-cart-btn">Přidat do košíku</button>
                                </form>
                            </div>
                        </div>
                        <div style="padding: 1.25rem; flex-grow: 1; display: flex; flex-direction: column;">
                            <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.4rem;">{{ $product->category->name }}</div>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #f5f5f0; margin-bottom: 0.75rem; font-weight: 400;">{{ $product->name }}</h3>
                            <div style="margin-top: auto; display: flex; align-items: center; justify-content: space-between;">
                                <div style="font-size: 1rem; color: #c9a96e; font-weight: 500;">{{ number_format($product->price, 0, ',', ' ') }} Kč</div>
                                <a href="{{ route('shop.show', $product->id) }}" style="color: rgba(201,169,110,0.4); transition: color 0.3s;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='rgba(201,169,110,0.4)'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: span 3; text-align: center; padding: 4rem 0;">
                        <p style="color: #6b6b6b;">V této kategorii zatím nejsou žádné produkty.</p>
                    </div>
                    @endforelse
                </div>

                <div style="margin-top: 4rem;">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<style>
@media (max-width: 1023px) {
    div[style*="grid-template-columns: 260px"] { grid-template-columns: 1fr !important; }
    aside { display: none !important; }
}
@media (max-width: 768px) {
    div.grid-cols-products { grid-template-columns: repeat(2,1fr) !important; }
}
@media (max-width: 480px) {
    div.grid-cols-products { grid-template-columns: 1fr !important; }
}
</style>
@endsection

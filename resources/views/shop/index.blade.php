@extends('layouts.app')

@section('title', 'E-shop — Fotografické tisky | Martin Beck')

@section('head')
<style>
    .shop-hero { height: 55vh; min-height: 420px; position: relative; display: flex; align-items: flex-end; overflow: hidden; }
    
    /* Product card */
    .product-card { background: #111; border: 1px solid rgba(201,169,110,0.08); transition: border-color 0.4s, transform 0.4s; }
    .product-card:hover { border-color: rgba(201,169,110,0.3); transform: translateY(-4px); }
    .product-img-wrap { position: relative; overflow: hidden; aspect-ratio: 4/5; }
    .product-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.7s ease; filter: grayscale(10%); }
    .product-card:hover .product-img-wrap img { transform: scale(1.05); filter: grayscale(0); }
    .product-badge { position: absolute; top: 0.75rem; left: 0.75rem; font-size: 0.6rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; padding: 0.3rem 0.75rem; }
    .badge-limited { background: #c9a96e; color: #0a0a0a; }
    .badge-new { background: #f5f5f0; color: #0a0a0a; }
    .badge-sale { background: rgba(220,50,50,0.9); color: #fff; }
    
    /* Product actions -->
    .product-actions { position: absolute; bottom: 0; left: 0; right: 0; transform: translateY(100%); transition: transform 0.4s ease; background: rgba(10,10,10,0.95); padding: 1rem; }
    .product-card:hover .product-actions { transform: translateY(0); }
    .add-to-cart-btn { width: 100%; padding: 0.75rem; background: #c9a96e; color: #0a0a0a; border: none; cursor: pointer; font-size: 0.65rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; transition: background 0.3s; }
    .add-to-cart-btn:hover { background: #b8965e; }
    .wishlist-btn { position: absolute; top: 0.75rem; right: 0.75rem; width: 36px; height: 36px; background: rgba(0,0,0,0.6); border: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; color: rgba(245,245,240,0.5); }
    .wishlist-btn:hover { border-color: #c9a96e; color: #c9a96e; }
    
    /* Size selector */
    .size-chip { padding: 0.25rem 0.6rem; border: 1px solid rgba(201,169,110,0.2); font-size: 0.65rem; color: #6b6b6b; cursor: pointer; transition: all 0.2s; }
    .size-chip:hover, .size-chip.active { border-color: #c9a96e; color: #c9a96e; }
    
    /* Sidebar filter */
    .sidebar-section { border-bottom: 1px solid rgba(201,169,110,0.08); padding-bottom: 2rem; margin-bottom: 2rem; }
    .filter-checkbox { appearance: none; width: 16px; height: 16px; border: 1px solid rgba(201,169,110,0.3); background: transparent; cursor: pointer; flex-shrink: 0; margin-top: 2px; transition: all 0.2s; }
    .filter-checkbox:checked { background: #c9a96e; border-color: #c9a96e; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3E%3Cpath fill='%230a0a0a' d='M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z'/%3E%3C/svg%3E"); background-size: cover; }
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

<!-- USP bar -->
<div style="background: #111; border-bottom: 1px solid rgba(201,169,110,0.08);">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0; border-left: 1px solid rgba(201,169,110,0.08);" class="md:grid-cols-4">
            <div style="grid-template-columns: repeat(4,1fr); display: contents;">
            @php
            $usps = [
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />', 'title' => 'Certifikát pravosti', 'sub' => 'Každý tisk'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 3M21 7.5H7.5" />', 'title' => 'Doprava zdarma', 'sub' => 'Nad 2 000 Kč'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" /><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />', 'title' => 'Prémium papír', 'sub' => 'Archivní kvalita'],
                ['icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" />', 'title' => 'Limitovaná série', 'sub' => 'Číslované výtisky'],
            ];
            @endphp
            @foreach($usps as $u)
            <div style="padding: 1.25rem 1.5rem; border-right: 1px solid rgba(201,169,110,0.08); display: flex; align-items: center; gap: 1rem;">
                <div style="flex-shrink: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="#c9a96e" stroke-width="1.5">{!! $u['icon'] !!}</svg>
                </div>
                <div>
                    <div style="font-size: 0.8rem; color: #f5f5f0; font-weight: 500;">{{ $u['title'] }}</div>
                    <div style="font-size: 0.7rem; color: #6b6b6b;">{{ $u['sub'] }}</div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Main shop area -->
<section style="padding: 5rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div style="display: grid; grid-template-columns: 260px 1fr; gap: 4rem; align-items: start;" class="lg:grid-cols-shop">

            <!-- ===== SIDEBAR FILTERS ===== -->
            <aside style="position: sticky; top: 140px;" class="hidden lg:block">
                <!-- Sort -->
                <div class="sidebar-section">
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Seřadit</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach(['Doporučené', 'Nejnovější', 'Cena: nízká → vysoká', 'Cena: vysoká → nízká', 'Bestsellery'] as $s)
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                            <input type="radio" name="sort" style="accent-color: #c9a96e;" {{ $loop->first ? 'checked' : '' }}>
                            <span style="font-size: 0.85rem; color: #6b6b6b;">{{ $s }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Category -->
                <div class="sidebar-section">
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Kategorie</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach(['Portréty (24)', 'Politika (12)', 'Kultura (18)', 'Sport (9)', 'Limitované edice (6)', 'Black & White (15)'] as $cat)
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                            <input type="checkbox" class="filter-checkbox">
                            <span style="font-size: 0.85rem; color: #6b6b6b;">{{ $cat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <!-- Price range -->
                <div class="sidebar-section">
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Cena</h3>
                    <input type="range" min="500" max="15000" value="8000" style="width: 100%; accent-color: #c9a96e;">
                    <div style="display: flex; justify-content: space-between; font-size: 0.75rem; color: #6b6b6b; margin-top: 0.5rem;">
                        <span>500 Kč</span><span>15 000 Kč</span>
                    </div>
                </div>

                <!-- Size -->
                <div class="sidebar-section">
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Formát</h3>
                    <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                        @foreach(['20×30', '30×45', '40×60', '50×70', '60×90', '80×120'] as $size)
                        <span class="size-chip">{{ $size }}</span>
                        @endforeach
                    </div>
                </div>

                <!-- Material -->
                <div>
                    <h3 style="font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1.25rem;">Materiál</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        @foreach(['Fine Art papír', 'Hliníková deska', 'Plátno (Canvas)', 'Acrylic glass', 'Forex'] as $mat)
                        <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                            <input type="checkbox" class="filter-checkbox">
                            <span style="font-size: 0.85rem; color: #6b6b6b;">{{ $mat }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
            </aside>

            <!-- ===== PRODUCT GRID ===== -->
            <div>
                <!-- Toolbar -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
                    <div style="font-size: 0.85rem; color: #6b6b6b;">Zobrazeno <strong style="color: #f5f5f0;">24</strong> z 68 produktů</div>
                    <!-- Mobile filter toggle -->
                    <button style="display: flex; align-items: center; gap: 0.5rem; color: #c9a96e; background: none; border: 1px solid rgba(201,169,110,0.3); padding: 0.5rem 1rem; font-size: 0.7rem; letter-spacing: 0.1em; cursor: pointer;" class="lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" /></svg>
                        Filtry
                    </button>
                </div>

                <!-- Products -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;" class="grid-cols-products">
                    @php
                    $products = [
                        ['img' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=500&h=650&fit=crop', 'name' => 'Politický portrét I.', 'cat' => 'Politika', 'price' => '3 200', 'orig' => null, 'badge' => 'Limitovaná edice', 'badge_type' => 'limited', 'sizes' => ['40×60', '60×90'], 'edition' => '1/25'],
                        ['img' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=500&h=650&fit=crop', 'name' => 'Pohled do duše', 'cat' => 'Portréty', 'price' => '1 900', 'orig' => '2 400', 'badge' => 'Výprodej', 'badge_type' => 'sale', 'sizes' => ['30×45', '40×60', '50×70'], 'edition' => null],
                        ['img' => 'https://images.unsplash.com/photo-1542996966-2e31c00bae31?w=500&h=650&fit=crop', 'name' => 'Vítěz', 'cat' => 'Sport', 'price' => '2 600', 'orig' => null, 'badge' => 'Nové', 'badge_type' => 'new', 'sizes' => ['40×60', '60×90', '80×120'], 'edition' => '1/15'],
                        ['img' => 'https://images.unsplash.com/photo-1489980557514-251d61e3eeb6?w=500&h=650&fit=crop', 'name' => 'Hudební virtuos', 'cat' => 'Hudba', 'price' => '4 100', 'orig' => null, 'badge' => 'Limitovaná edice', 'badge_type' => 'limited', 'sizes' => ['50×70', '60×90'], 'edition' => '1/10'],
                        ['img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=500&h=650&fit=crop', 'name' => 'Vůdce mysli', 'cat' => 'Byznys', 'price' => '2 100', 'orig' => null, 'badge' => null, 'badge_type' => null, 'sizes' => ['30×45', '40×60'], 'edition' => null],
                        ['img' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=500&h=650&fit=crop', 'name' => 'Filmová legenda', 'cat' => 'Film', 'price' => '5 800', 'orig' => null, 'badge' => 'Limitovaná edice', 'badge_type' => 'limited', 'sizes' => ['60×90', '80×120'], 'edition' => '1/5'],
                        ['img' => 'https://images.unsplash.com/photo-1520813792240-56fc4a3765a7?w=500&h=650&fit=crop', 'name' => 'Za oponou', 'cat' => 'Kultura', 'price' => '1 600', 'orig' => null, 'badge' => null, 'badge_type' => null, 'sizes' => ['20×30', '30×45', '40×60'], 'edition' => null],
                        ['img' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?w=500&h=650&fit=crop', 'name' => 'Sprint ke slávě', 'cat' => 'Sport', 'price' => '3 400', 'orig' => '4 000', 'badge' => 'Výprodej', 'badge_type' => 'sale', 'sizes' => ['40×60', '60×90'], 'edition' => null],
                        ['img' => 'https://images.unsplash.com/photo-1552058544-f2b08422138a?w=500&h=650&fit=crop', 'name' => 'Přirozený okamžik', 'cat' => 'Portréty', 'price' => '1 200', 'orig' => null, 'badge' => 'Nové', 'badge_type' => 'new', 'sizes' => ['20×30', '30×45'], 'edition' => null],
                    ];
                    @endphp

                    @foreach($products as $product)
                    <div class="product-card reveal">
                        <div class="product-img-wrap">
                            <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" loading="lazy">
                            @if($product['badge'])
                            <div class="product-badge badge-{{ $product['badge_type'] }}">{{ $product['badge'] }}</div>
                            @endif
                            @if($product['edition'])
                            <div style="position: absolute; top: 0.75rem; right: 0.75rem; background: rgba(0,0,0,0.7); border: 1px solid rgba(201,169,110,0.3); color: #c9a96e; font-size: 0.6rem; letter-spacing: 0.1em; padding: 0.25rem 0.5rem;">{{ $product['edition'] }}</div>
                            @endif
                            <!-- Wishlist -->
                            <button class="wishlist-btn" title="Přidat do přání">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" /></svg>
                            </button>
                            <!-- Quick actions -->
                            <div class="product-actions">
                                <!-- Size chips -->
                                <div style="display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 0.75rem;">
                                    @foreach($product['sizes'] as $size)
                                    <span class="size-chip" style="font-size: 0.6rem; padding: 0.2rem 0.5rem;">{{ $size }}</span>
                                    @endforeach
                                </div>
                                <form action="/kosik/pridat" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_name" value="{{ $product['name'] }}">
                                    <input type="hidden" name="product_price" value="{{ str_replace(' ', '', $product['price']) }}">
                                    <button type="submit" class="add-to-cart-btn">Přidat do košíku</button>
                                </form>
                            </div>
                        </div>
                        <!-- Info -->
                        <div style="padding: 1.25rem;">
                            <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.4rem;">{{ $product['cat'] }}</div>
                            <h3 style="font-family: 'Playfair Display', serif; font-size: 1rem; color: #f5f5f0; margin-bottom: 0.75rem; font-weight: 400;">{{ $product['name'] }}</h3>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <div style="display: flex; align-items: baseline; gap: 0.5rem;">
                                    <span style="font-size: 1rem; color: #c9a96e; font-weight: 500;">{{ $product['price'] }} Kč</span>
                                    @if($product['orig'])
                                    <span style="font-size: 0.8rem; color: #6b6b6b; text-decoration: line-through;">{{ $product['orig'] }} Kč</span>
                                    @endif
                                </div>
                                <a href="/eshop/produkt" style="color: rgba(201,169,110,0.4); transition: color 0.3s; font-size: 0.75rem;" onmouseover="this.style.color='#c9a96e'" onmouseout="this.style.color='rgba(201,169,110,0.4)'" title="Zobrazit detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" /></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; margin-top: 4rem;">
                    <button style="width: 40px; height: 40px; border: 1px solid rgba(201,169,110,0.2); background: transparent; color: #6b6b6b; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.borderColor='#c9a96e'; this.style.color='#c9a96e';" onmouseout="this.style.borderColor='rgba(201,169,110,0.2)'; this.style.color='#6b6b6b';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" /></svg>
                    </button>
                    @foreach([1,2,3,4,5] as $page)
                    <button style="width: 40px; height: 40px; border: 1px solid {{ $page === 1 ? '#c9a96e' : 'rgba(201,169,110,0.2)' }}; background: {{ $page === 1 ? '#c9a96e' : 'transparent' }}; color: {{ $page === 1 ? '#0a0a0a' : '#6b6b6b' }}; cursor: pointer; font-size: 0.85rem; transition: all 0.3s;">{{ $page }}</button>
                    @endforeach
                    <button style="width: 40px; height: 40px; border: 1px solid rgba(201,169,110,0.2); background: transparent; color: #6b6b6b; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.borderColor='#c9a96e'; this.style.color='#c9a96e';" onmouseout="this.style.borderColor='rgba(201,169,110,0.2)'; this.style.color='#6b6b6b';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" /></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Print quality section -->
<section style="padding: 8rem 0; background: #0d0d0d; border-top: 1px solid rgba(201,169,110,0.08);">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">
        <div class="reveal" style="text-align: center; margin-bottom: 5rem;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1.5rem; margin-bottom: 2rem;">
                <div class="gold-line"></div>
                <span style="font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e;">Kvalita tisku</span>
                <div class="gold-line"></div>
            </div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3.5vw, 3rem); font-weight: 400; color: #f5f5f0;">Pouze prémiové materiály</h2>
        </div>
        <div class="reveal" style="display: grid; grid-template-columns: repeat(1,1fr); gap: 2rem;">
            <div style="display: grid; grid-template-columns: repeat(4,1fr); gap: 2rem;">
            @php
            $materials = [
                ['name' => 'Fine Art Papír', 'desc' => 'Bezdřevý papír s archivní trvanlivostí 100+ let. Ideální pro tradiční umělecké tisky.', 'spec' => '310 g/m²'],
                ['name' => 'Hliníková deska', 'desc' => 'Přímý tisk na anodizovaný hliník s výjimečnou brilancí barev a moderním vzhledem.', 'spec' => '2 mm Dibond'],
                ['name' => 'Acrylic Glass', 'desc' => 'Tisk pod průhledné akrylové sklo s hloubkou a sytostí barev jako z monitoru.', 'spec' => '4 mm Acryl'],
                ['name' => 'Canvas', 'desc' => 'Klasický plátěný tisk napnutý na dřevěném rámu. Galerie kvalita pro každý interiér.', 'spec' => '380 g/m²'],
            ];
            @endphp
            @foreach($materials as $m)
            <div style="border: 1px solid rgba(201,169,110,0.1); padding: 2rem; transition: border-color 0.3s;" onmouseover="this.style.borderColor='rgba(201,169,110,0.4)'" onmouseout="this.style.borderColor='rgba(201,169,110,0.1)'">
                <div style="font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; margin-bottom: 0.75rem;">{{ $m['spec'] }}</div>
                <h3 style="font-family: 'Playfair Display', serif; font-size: 1.1rem; color: #f5f5f0; margin-bottom: 0.75rem;">{{ $m['name'] }}</h3>
                <p style="color: #6b6b6b; font-size: 0.85rem; line-height: 1.8;">{{ $m['desc'] }}</p>
            </div>
            @endforeach
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
    div.grid-cols-products, div[style*="grid-template-columns: repeat(3, 1fr)"] { grid-template-columns: repeat(2,1fr) !important; }
}
@media (max-width: 480px) {
    div.grid-cols-products, div[style*="grid-template-columns: repeat(3, 1fr)"] { grid-template-columns: 1fr !important; }
}
</style>
@endsection
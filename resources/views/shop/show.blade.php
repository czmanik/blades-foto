@extends('layouts.app')

@section('title', $product->name . ' — E-shop | Martin Beck')

@section('head')
<style>
    .product-detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start; }
    @media (max-width: 1024px) { .product-detail-grid { grid-template-columns: 1fr; gap: 2rem; } }

    .product-gallery { position: sticky; top: 120px; }
    .main-img-wrap { aspect-ratio: 4/5; overflow: hidden; background: #111; border: 1px solid rgba(201,169,110,0.1); }
    .main-img-wrap img { width: 100%; height: 100%; object-fit: cover; }

    .price-tag { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: #c9a96e; margin: 1.5rem 0; }

    .option-group { margin-bottom: 2rem; }
    .option-label { font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: #6b6b6b; margin-bottom: 0.75rem; display: block; }

    .size-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; }
    .size-option { border: 1px solid rgba(201,169,110,0.2); padding: 1rem; text-align: center; cursor: pointer; transition: all 0.3s; }
    .size-option:hover { border-color: #c9a96e; }
    .size-option.active { background: #c9a96e; border-color: #c9a96e; color: #0a0a0a; }
    .size-name { display: block; font-size: 0.9rem; font-weight: 500; }
    .size-desc { display: block; font-size: 0.7rem; opacity: 0.7; margin-top: 0.25rem; }

    .add-cart-large { width: 100%; padding: 1.25rem; background: #c9a96e; color: #0a0a0a; border: none; font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 600; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 1rem; }
    .add-cart-large:hover { background: #f5f5f0; }

    .product-meta-box { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid rgba(201,169,110,0.1); }
    .meta-item { display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem; font-size: 0.85rem; color: #6b6b6b; }
    .meta-item svg { color: #c9a96e; flex-shrink: 0; }

    .related-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; }
    @media (max-width: 768px) { .related-grid { grid-template-columns: repeat(2, 1fr); } }
</style>
@endsection

@section('content')

<div style="padding: 12rem 0 8rem;">
    <div class="max-w-7xl mx-auto px-6 md:px-12 lg:px-20">

        <!-- Breadcrumbs -->
        <nav style="margin-bottom: 3rem; display: flex; gap: 0.75rem; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em;">
            <a href="/eshop" style="color: #6b6b6b;">E-shop</a>
            <span style="color: rgba(201,169,110,0.3);">/</span>
            <a href="/eshop?kategorie={{ $product->category->slug }}" style="color: #6b6b6b;">{{ $product->category->name }}</a>
            <span style="color: rgba(201,169,110,0.3);">/</span>
            <span style="color: #c9a96e;">{{ $product->name }}</span>
        </nav>

        <div class="product-detail-grid">
            <!-- Left: Image -->
            <div class="product-gallery">
                <div class="main-img-wrap reveal">
                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=1000&q=80' }}" alt="{{ $product->name }}">
                </div>
            </div>

            <!-- Right: Info -->
            <div class="product-info reveal">
                <div style="font-size: 0.7rem; letter-spacing: 0.3em; text-transform: uppercase; color: #c9a96e; margin-bottom: 1rem;">{{ $product->category->name }}</div>
                <h1 style="font-family: 'Playfair Display', serif; font-size: clamp(2.5rem, 4vw, 3.5rem); color: #f5f5f0; line-height: 1.1; margin-bottom: 1.5rem;">{{ $product->name }}</h1>

                <div style="color: rgba(245,245,240,0.7); line-height: 1.8; font-size: 1.05rem; margin-bottom: 2rem;">
                    {{ $product->description ?? 'Limitovaný umělecký tisk na prémiovém papíře s archivní kvalitou. Každý kus je individuálně kontrolován a signován autorem.' }}
                </div>

                <div class="price-tag">{{ number_format($product->price, 0, ',', ' ') }} Kč</div>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_name" value="{{ $product->name }}">
                    <input type="hidden" name="product_price" value="{{ $product->price }}">

                    <div class="option-group">
                        <span class="option-label">Vyberte rozměr (cm)</span>
                        <div class="size-grid">
                            <div class="size-option active">
                                <span class="size-name">30 × 45</span>
                                <span class="size-desc">Klasický formát</span>
                            </div>
                            <div class="size-option">
                                <span class="size-name">40 × 60</span>
                                <span class="size-desc">Populární volba</span>
                            </div>
                            <div class="size-option">
                                <span class="size-name">60 × 90</span>
                                <span class="size-desc">Velkoformát</span>
                            </div>
                        </div>
                    </div>

                    <div class="option-group">
                        <span class="option-label">Provedení</span>
                        <select style="width: 100%; padding: 1rem; background: #111; border: 1px solid rgba(201,169,110,0.2); color: #f5f5f0; outline: none;">
                            <option>Fine Art papír (310g)</option>
                            <option>Hliníková deska (Dibond)</option>
                            <option>Plátno na rámu</option>
                            <option>Akrylové sklo</option>
                        </select>
                    </div>

                    <button type="submit" class="add-cart-large">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        Přidat do košíku
                    </button>
                </form>

                <div class="product-meta-box">
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Certifikát pravosti součástí balení</span>
                    </div>
                    <div class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25c0-4.446-3.542-7.89-8.099-7.591A5.13 5.13 0 007.923 5.106a4.89 4.89 0 00-.532 2.332V14.25m12.75 4.5V14.25m0 0a2.25 2.25 0 00-2.25-2.25h-1.348c-.03 0-.06 0-.09.002m.125-3.328a3 3 0 00-3-3H12m0 0l-1.5 1.5M12 5.25l1.5-1.5" /></svg>
                        <span>Bezpečné doručení v tubusu nebo dřevěném boxu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related products -->
        @if($related->count() > 0)
        <div style="margin-top: 10rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 3rem;">
                <h2 style="font-family: 'Playfair Display', serif; font-size: 2rem; color: #f5f5f0;">Mohlo by vás zajímat</h2>
                <a href="/eshop" style="font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; color: #c9a96e; text-decoration: none; border-bottom: 1px solid rgba(201,169,110,0.3); padding-bottom: 0.25rem;">Zpět do obchodu</a>
            </div>
            <div class="related-grid">
                @foreach($related as $r)
                <a href="{{ route('shop.show', $r->id) }}" style="text-decoration: none; display: block;" class="reveal">
                    <div style="aspect-ratio: 4/5; overflow: hidden; margin-bottom: 1rem; border: 1px solid rgba(201,169,110,0.05);">
                        <img src="{{ $r->image ?? 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=500&q=80' }}" alt="{{ $r->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    </div>
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 0.95rem; color: #f5f5f0; margin-bottom: 0.25rem;">{{ $r->name }}</h3>
                    <div style="font-size: 0.85rem; color: #c9a96e;">{{ number_format($r->price, 0, ',', ' ') }} Kč</div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
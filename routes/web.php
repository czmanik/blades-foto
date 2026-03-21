<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/vystavy', [HomeController::class, 'exhibitions'])->name('exhibitions');
Route::get('/napsali-o-mne', [HomeController::class, 'press'])->name('press');

// Portfolio
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Galerie
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');

// E-shop
Route::get('/eshop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/eshop/produkt/{id}', [ShopController::class, 'show'])->name('shop.show');

// Kosik
Route::get('/kosik', [CartController::class, 'index'])->name('cart.index');
Route::post('/kosik/pridat', [CartController::class, 'add'])->name('cart.add');
Route::post('/kosik/odebrat/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/kosik/aktualizovat', [CartController::class, 'update'])->name('cart.update');

// Objednavka
Route::get('/objednavka', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/objednavka', [CheckoutController::class, 'process'])->name('checkout.process');

// Kontakt
Route::get('/kontakt', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontakt', [ContactController::class, 'send'])->name('contact.send');
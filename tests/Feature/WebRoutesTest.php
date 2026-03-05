<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;

class WebRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $category = Category::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'type' => 'portfolio'
        ]);

        // Seed some data for the tests
        Photo::create([
            'title' => 'Test Photo',
            'slug' => 'test-photo',
            'url' => 'https://example.com/photo.jpg',
            'description' => 'Test description',
            'category_id' => $category->id,
            'type' => 'portfolio'
        ]);

        Product::create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 1000,
            'image' => 'https://example.com/product.jpg',
            'description' => 'Test product description',
            'category_id' => $category->id
        ]);
    }

    public function test_homepage_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_portfolio_index_is_accessible()
    {
        $response = $this->get('/portfolio');
        $response->assertStatus(200);
    }

    public function test_portfolio_show_is_accessible()
    {
        $response = $this->get('/portfolio/test-photo');
        $response->assertStatus(200);
    }

    public function test_shop_index_is_accessible()
    {
        $response = $this->get('/eshop');
        $response->assertStatus(200);
    }

    public function test_shop_show_is_accessible()
    {
        $product = Product::first();
        $response = $this->get('/eshop/produkt/' . $product->id);
        $response->assertStatus(200);
    }

    public function test_cart_is_accessible()
    {
        $response = $this->get('/kosik');
        $response->assertStatus(200);
    }

    public function test_checkout_is_accessible_with_cart()
    {
        $product = Product::first();
        $cart = [
            $product->id => [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ]
        ];

        $response = $this->withSession(['cart' => $cart])->get('/objednavka');
        $response->assertStatus(200);
    }

    public function test_exhibitions_is_accessible()
    {
        $response = $this->get('/vystavy');
        $response->assertStatus(200);
    }

    public function test_press_is_accessible()
    {
        $response = $this->get('/napsali-o-mne');
        $response->assertStatus(200);
    }
}

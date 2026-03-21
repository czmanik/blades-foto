<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }

        // Categories
        $catPortfolio = Category::updateOrCreate(['slug' => 'portret'], ['name' => 'Portréty', 'type' => 'portfolio']);
        $catPolitika = Category::updateOrCreate(['slug' => 'politika'], ['name' => 'Politika', 'type' => 'portfolio']);
        $catKultura = Category::updateOrCreate(['slug' => 'kultura'], ['name' => 'Kultura', 'type' => 'portfolio']);

        $catPrints = Category::updateOrCreate(['slug' => 'limitovane-tisky'], ['name' => 'Limitované tisky', 'type' => 'shop']);
        $catWorkshops = Category::updateOrCreate(['slug' => 'workshopy'], ['name' => 'Workshopy', 'type' => 'shop']);

        // Photos
        $photos = [
            [
                'title' => 'Politický portrét I.',
                'slug' => 'politicky-portret-i',
                'url' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=1200&q=80',
                'category_id' => $catPolitika->id,
                'location' => 'Praha, Mánes',
            ],
            [
                'title' => 'Pohled do duše',
                'slug' => 'pohled-do-duse',
                'url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=1200&q=80',
                'category_id' => $catPortfolio->id,
                'location' => 'Studio, Londýn',
            ],
            [
                'title' => 'Za oponou',
                'slug' => 'za-oponou',
                'url' => 'https://images.unsplash.com/photo-1520813792240-56fc4a3765a7?w=1200&q=80',
                'category_id' => $catKultura->id,
                'location' => 'Národní divadlo',
            ],
        ];

        foreach ($photos as $p) {
            Photo::updateOrCreate(['slug' => $p['slug']], $p);
        }

        // Products
        $products = [
            [
                'name' => 'Politický portrét I. - Fine Art Print',
                'slug' => 'politicky-portret-i-fine-art-print',
                'category_id' => $catPrints->id,
                'price' => 3200,
                'description' => 'Limitovaný tisk (1/25) na papíře Hahnemühle Photo Rag.',
                'image' => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=800&q=80',
            ],
            [
                'name' => 'Workshop: Světlo v portrétu',
                'slug' => 'workshop-svetlo-v-portretu',
                'category_id' => $catWorkshops->id,
                'price' => 4500,
                'description' => 'Celodenní intenzivní workshop v pražském ateliéru.',
                'image' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?w=800&q=80',
            ],
        ];

        foreach ($products as $pr) {
            Product::updateOrCreate(['slug' => $pr['slug']], $pr);
        }
    }
}

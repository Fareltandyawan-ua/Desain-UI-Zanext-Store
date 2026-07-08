<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Zanext',
            'email' => 'admin@zanext.io',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Alex Carter',
            'email' => 'alex@zanext.io',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $products = [
            ['id' => 'zx-001', 'name' => 'Phantom Flux 01', 'brand' => 'ZANEXT', 'price' => 249, 'old_price' => 320, 'rating' => 4.9, 'image' => 'sneaker-1.jpg', 'tag' => 'New Drop', 'category' => 'Lifestyle'],
            ['id' => 'zx-002', 'name' => 'Apex Cloud Runner', 'brand' => 'AERO', 'price' => 189, 'old_price' => null, 'rating' => 4.7, 'image' => 'sneaker-2.jpg', 'tag' => 'Hot', 'category' => 'Running'],
            ['id' => 'zx-003', 'name' => 'Volt Mesh Pro', 'brand' => 'VOLT', 'price' => 219, 'old_price' => 260, 'rating' => 4.8, 'image' => 'sneaker-3.jpg', 'tag' => null, 'category' => 'Running'],
            ['id' => 'zx-004', 'name' => 'Onyx Bulk 2.0', 'brand' => 'ZANEXT', 'price' => 299, 'old_price' => null, 'rating' => 4.6, 'image' => 'sneaker-4.jpg', 'tag' => 'Limited', 'category' => 'Streetwear'],
            ['id' => 'zx-005', 'name' => 'Phantom Flux 02', 'brand' => 'ZANEXT', 'price' => 269, 'old_price' => null, 'rating' => 4.8, 'image' => 'sneaker-1.jpg', 'tag' => null, 'category' => 'Lifestyle'],
            ['id' => 'zx-006', 'name' => 'Cloud Runner X', 'brand' => 'AERO', 'price' => 179, 'old_price' => null, 'rating' => 4.5, 'image' => 'sneaker-2.jpg', 'tag' => null, 'category' => 'Running'],
            ['id' => 'zx-007', 'name' => 'Volt Carbon', 'brand' => 'VOLT', 'price' => 239, 'old_price' => null, 'rating' => 4.7, 'image' => 'sneaker-3.jpg', 'tag' => 'New', 'category' => 'Training'],
            ['id' => 'zx-008', 'name' => 'Onyx Stealth', 'brand' => 'ZANEXT', 'price' => 329, 'old_price' => null, 'rating' => 4.9, 'image' => 'sneaker-4.jpg', 'tag' => 'Limited', 'category' => 'Streetwear'],
        ];

        foreach ($products as $p) {
            $p['description'] = 'Crafted for the future of motion. ' . $p['name'] . ' combines engineered comfort with bold futuristic design — built for the streets, refined for the runway.';
            Product::create($p);
        }

        $articles = [
            ['id' => '1', 'title' => 'The Rise of Techwear in 2026', 'excerpt' => 'How utilitarian aesthetics took over the streetwear scene this year.', 'image' => 'article-1.jpg', 'category' => 'Culture', 'date' => 'May 10, 2026', 'author' => 'Alex Chen'],
            ['id' => '2', 'title' => 'Inside the Phantom Flux Lab', 'excerpt' => 'An exclusive look at how ZANEXT engineered its most ambitious silhouette.', 'image' => 'article-2.jpg', 'category' => 'Design', 'date' => 'May 03, 2026', 'author' => 'Mira Tan'],
            ['id' => '3', 'title' => 'Streets to Runway: A Hypebeast Story', 'excerpt' => 'From back alleys to fashion week — the cultural pipeline of street style.', 'image' => 'article-3.jpg', 'category' => 'Stories', 'date' => 'Apr 28, 2026', 'author' => 'Devon Ray'],
        ];

        foreach ($articles as $a) {
            $a['content'] = "<p>" . $a['excerpt'] . "</p><p>This is a full article body. The future of streetwear has never looked sharper. Every piece tells a story, every stitch a statement. ZANEXT continues to push the boundary between fashion and function.</p>";
            Article::create($a);
        }

        $transactions = [
            ['id' => 'TXN-2841', 'product' => 'Phantom Flux 01', 'date' => 'May 11, 2026', 'amount' => 249, 'status' => 'Delivered'],
            ['id' => 'TXN-2839', 'product' => 'Apex Cloud Runner', 'date' => 'May 09, 2026', 'amount' => 189, 'status' => 'Shipped'],
            ['id' => 'TXN-2832', 'product' => 'Volt Mesh Pro', 'date' => 'May 02, 2026', 'amount' => 219, 'status' => 'Processing'],
            ['id' => 'TXN-2818', 'product' => 'Onyx Bulk 2.0', 'date' => 'Apr 24, 2026', 'amount' => 299, 'status' => 'Delivered'],
        ];

        foreach ($transactions as $t) {
            Transaction::create($t);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        $user1 = User::create([
            'name' => 'محمد علي',
            'email' => 'mohammad@example.com',
            'password' => bcrypt('كلمةالسر123'),
        ]);
        $user2 = User::create([
            'name' => 'سارة أحمد',
            'email' => 'sara@example.com',
            'password' => bcrypt('كلمةالسر456'),
        ]);
        $user3 = User::create([
            'name' => 'خالد يوسف',
            'email' => 'khaled@example.com',
            'password' => bcrypt('كلمةالسر789'),
        ]);

        // Profiles
        Profile::create([
            'user_id' => $user1->id,
            'name' => 'محمد علي',
            'email' => 'mohammad@example.com',
            'phone' => '0501234567',
            'role' => 'admin',
            'active' => true,
        ]);
        Profile::create([
            'user_id' => $user2->id,
            'name' => 'سارة أحمد',
            'email' => 'sara@example.com',
            'phone' => '0559876543',
            'role' => 'user',
            'active' => true,
        ]);
        Profile::create([
            'user_id' => $user3->id,
            'name' => 'خالد يوسف',
            'email' => 'khaled@example.com',
            'phone' => '0541122334',
            'role' => 'user',
            'active' => false,
        ]);

        // Categories
        $cat1 = Category::create(['name' => 'تقنية', 'description' => 'كل ما يتعلق بالتقنية']);
        $cat2 = Category::create(['name' => 'صحة', 'description' => 'مواضيع الصحة والعافية']);
        $cat3 = Category::create(['name' => 'تعليم', 'description' => 'التعليم والمدارس']);
        $cat4 = Category::create(['name' => 'رياضة', 'description' => 'أخبار الرياضة']);

        // Posts
        $post1 = Post::create([
            'title' => 'مقدمة في لارافيل',
            'content' => 'لارافيل هو إطار عمل قوي لبناء تطبيقات الويب.',
            'user_id' => $user1->id,
        ]);
        $post2 = Post::create([
            'title' => 'نصائح غذائية صحية',
            'content' => 'تناول غذاء متوازن مهم لصحة جيدة.',
            'user_id' => $user2->id,
        ]);
        $post3 = Post::create([
            'title' => 'منصات التعليم الإلكتروني',
            'content' => 'التعليم الإلكتروني غير طريقة التعلم.',
            'user_id' => $user3->id,
        ]);
        $post4 = Post::create([
            'title' => 'أفضل 10 رياضات في 2026',
            'content' => 'هذه أشهر الرياضات في العالم هذا العام.',
            'user_id' => $user1->id,
        ]);

        // Pivot: Attach categories to posts
        $post1->categories()->attach([$cat1->id, $cat3->id]); // تقنية، تعليم
        $post2->categories()->attach([$cat2->id]); // صحة
        $post3->categories()->attach([$cat1->id, $cat3->id]); // تقنية، تعليم
        $post4->categories()->attach([$cat4->id, $cat1->id]); // رياضة، تقنية

        // Products
        $product1 = Product::create([
            'name' => 'لابتوب ديل',
            'price' => 3500.00,
            'description' => 'لابتوب ديل عالي الأداء',
            'image' => 'laptop.jpg',
            'status' => 'available',
        ]);
        $product2 = Product::create([
            'name' => 'هاتف سامسونج',
            'price' => 2000.00,
            'description' => 'هاتف سامسونج جالاكسي',
            'image' => 'phone.jpg',
            'status' => 'available',
        ]);
        $product3 = Product::create([
            'name' => 'ماوس لاسلكي',
            'price' => 150.00,
            'description' => 'ماوس لاسلكي مريح',
            'image' => 'mouse.jpg',
            'status' => 'available',
        ]);
        $product4 = Product::create([
            'name' => 'لوحة مفاتيح ميكانيكية',
            'price' => 450.00,
            'description' => 'لوحة مفاتيح ميكانيكية RGB',
            'image' => 'keyboard.jpg',
            'status' => 'available',
        ]);
        $product5 = Product::create([
            'name' => 'شاشة 27 بوصة',
            'price' => 1200.00,
            'description' => 'شاشة 4K للألعاب',
            'image' => 'monitor.jpg',
            'status' => 'out_of_stock',
        ]);

        // Orders
        $order1 = Order::create([
            'user_id' => $user1->id,
            'status' => 'pending',
            'total_amount' => 0,
        ]);
        $order1->products()->attach([
            $product1->id => ['quantity' => 1, 'price' => $product1->price],
            $product3->id => ['quantity' => 2, 'price' => $product3->price],
        ]);
        $order1->update(['total_amount' => (1 * $product1->price) + (2 * $product3->price)]);

        $order2 = Order::create([
            'user_id' => $user2->id,
            'status' => 'completed',
            'total_amount' => 0,
        ]);
        $order2->products()->attach([
            $product2->id => ['quantity' => 1, 'price' => $product2->price],
            $product4->id => ['quantity' => 1, 'price' => $product4->price],
        ]);
        $order2->update(['total_amount' => (1 * $product2->price) + (1 * $product4->price)]);

        $order3 = Order::create([
            'user_id' => $user3->id,
            'status' => 'pending',
            'total_amount' => 0,
        ]);
        $order3->products()->attach([
            $product1->id => ['quantity' => 2, 'price' => $product1->price],
            $product2->id => ['quantity' => 1, 'price' => $product2->price],
            $product3->id => ['quantity' => 3, 'price' => $product3->price],
        ]);
        $order3->update(['total_amount' => (2 * $product1->price) + (1 * $product2->price) + (3 * $product3->price)]);
    }
}

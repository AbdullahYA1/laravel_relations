<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Post;

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
    }
}

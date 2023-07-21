<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'phone' => '12345678',
        //     'password' => '12345678'
        // ]);
        // Category::factory()->create([
        //     'name' => "Yangon",
        //     'image' => "123.png"
        // ]);
        // Tag::factory()->create([
        //     'name' => "Hot News",
        //     'image' => "123.png"
        // ]);
        Post::factory()->create([
            "title" => "abc news",
            "content" => "လူကြိုက်များပြီး ရောင်းအားကောင်းနေဆဲဖြစ်တဲ့ iPhone 11 မှကြိုက်တယ်ဆိုရင်!
                         ဓာတ်ပုံလှလှလေးတွေ ရိုက်ဖို့အတွက် Dual-camera System နဲ့အတူ Ultra Wide, 
                         Portrait Mode နဲ့ Night Mode တို့ ပါဝင်တဲ့ iPhone 11 က Water and 
                         Dust Resistant လည်းဖြစ်တယ်နော်။
                         လှပတဲ့ Design နဲ့ သင့်တင့်တဲ့ဈေးနှုန်းတို့ကြောင့် အခုချိန်ထိလူကြိုက်များပြီး
                          ရောင်းအားကောင်းနေဆဲဖြစ်တဲ့ iPhone 11 လေးကိုမှ ဝယ်ယူဖို့ စောင့်ဆိုင်းနေတယ်ဆိုရင်တော့ Stock ရှိတုန်း mDrive ကို လှမ်းခဲ့လိုက်တော့နော်",
            "image" => "123.png",
            "user_id" => User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '12345678',
                'password' => '12345678'
            ]),
            "tag_id" => Tag::factory()->create([
                'name' => "Hot News",
                'image' => "123.png"
            ]),
            "category_id" => Category::factory()->create([
                'name' => "Yangon",
                'image' => "123.png"
            ])

        ]);
    }
}

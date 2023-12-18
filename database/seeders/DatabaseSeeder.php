<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Currency;
use App\Models\User;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('amct12345'),
        ]);

        $sizes = [
            ['name' => '20'],
            ['name' => '30'],
            ['name' => '50'],
            ['name' => '40'],
            ['name' => '60'],
        ];

        $colors = [
            [
                'english_name' => 'Red',
                'myanmar_name' => 'အနီ',
            ],
            [
                'english_name' => 'White',
                'myanmar_name' => 'အဖြူ',
            ],
            [
                'english_name' => 'Black',
                'myanmar_name' => 'အနက်',
            ],
            [
                'english_name' => 'Blue',
                'myanmar_name' => 'အပြာ',
            ],
        ];

        ProductSize::insert($sizes);

        ProductColor::insert($colors);

        $this->call([
            CustomerSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
        ]);

        Currency::create([
            'kyats' => '476.1905',
        ]);

    }
}

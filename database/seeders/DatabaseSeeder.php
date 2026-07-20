<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Users ──
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@pos.com',
            'password' => Hash::make('123456'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Kasir',
            'email'    => 'kasir@pos.com',
            'password' => Hash::make('123456'),
            'role'     => 'kasir',
        ]);

        // ── Categories ──
        $minuman  = Category::create(['name' => 'Minuman']);
        $makanan  = Category::create(['name' => 'Makanan']);
        $snack    = Category::create(['name' => 'Snack']);

        // ── Products ──
        $products = [
            ['category_id' => $minuman->id,  'name' => 'Indomie Goreng',    'price' => 5000,  'stock' => 90],
            ['category_id' => $minuman->id,  'name' => 'Aqua 600ml',        'price' => 3000,  'stock' => 120],
            ['category_id' => $minuman->id,  'name' => 'Teh Pucuk 350ml',   'price' => 4000,  'stock' => 100],
            ['category_id' => $minuman->id,  'name' => 'Susu Ultra 250ml',  'price' => 5000,  'stock' => 80],
            ['category_id' => $makanan->id,  'name' => 'Roti Tawar',        'price' => 10000, 'stock' => 40],
            ['category_id' => $snack->id,    'name' => 'Chitato 55g',       'price' => 7000,  'stock' => 60],
            ['category_id' => $snack->id,    'name' => 'Oreo Original',     'price' => 6000,  'stock' => 75],
            ['category_id' => $makanan->id,  'name' => 'Mie Sedaap',        'price' => 3500,  'stock' => 110],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}

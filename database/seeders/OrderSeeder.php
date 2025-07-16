<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $products = ['Coffee Beans', 'Ground Coffee', 'Espresso', 'Instant Coffee'];
        
        $users = \App\Models\User::all(); // Use existing users

        foreach ($users as $user) {
            for ($i = 0; $i < 20; $i++) {
                $product = $products[array_rand($products)];
                $quantity = rand(1, 20);
                $pricePerUnit = rand(5, 15); // arbitrary price
                $totalPrice = $quantity * $pricePerUnit;

                Order::create([
                    'user_id' => $user->id,
                    'product' => $product,
                    'quantity' => $quantity,
                    'total_price' => $totalPrice,
                    'created_at' => now()->subDays(rand(0, 30)), // Random recent date
                ]);
            }
        }
    }
}

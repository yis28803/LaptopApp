<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Define the number of orders to generate
       $numberOfOrders = 10;

       // Loop through and insert random orders
       for ($i = 0; $i < $numberOfOrders; $i++) {
           DB::table('orders')->insert([
               'user_id' => rand(1, 4), // Assuming user IDs range from 1 to 10
               'fullname' => 'Customer ' . ($i + 1),
               'email' => 'customer' . ($i + 1) . '@example.com',
               'phone_number' => '0123456789',
               'address' => 'Address ' . ($i + 1),
               'note' => 'Note for order ' . ($i + 1),
               'status' => ['pending', 'processing', 'shipped', 'delivered', 'cancelled'][rand(0, 4)],
               'total_money' => rand(100, 10000) / 100, // Random decimal between 1.00 and 100.00
               'shipping_method' => ['Standard', 'Express'][rand(0, 1)],
               'shipping_address' => 'Shipping Address ' . ($i + 1),
               'shipping_date' => now()->addDays(rand(1, 30))->toDateString(), // Random date within the next 30 days
               'tracking_number' => 'ABC' . rand(1000, 9999),
               'payment_method' => ['Credit Card', 'PayPal'][rand(0, 1)],
               'active' => rand(0, 1),
           ]);
    }
}
}
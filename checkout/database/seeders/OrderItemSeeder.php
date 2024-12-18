<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderItems = DB::connection('old_mysql')->table('order_items')->get();
        foreach ($orderItems as $orderItem) {
            DB::table('order_items')->insert([
                'id' => $orderItem->id,
                'order_id' => $orderItem->order_id,
                'product_title' => $orderItem->product_title,
                'price' => $orderItem->price,
                'quantity' => $orderItem->quantity,
                'ambassador_revenue' => $orderItem->ambassador_revenue,
                'admin_revenue' => $orderItem->admin_revenue,
                'created_at' => $orderItem->created_at,
                'updated_at' => $orderItem->updated_at
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = DB::connection('old_mysql')->table('orders')->get();
        foreach ($orders as $order) {
            $orderItems = DB::connection('old_mysql')->table('order_items')->where('order_id', $order->id)->get();
            DB::table('orders')->insert([
                'id' => $order->id,
                'code' => $order->code,
                'user_id' => $order->user_id,
                'total' => $orderItems->sum(fn($item) => $item->ambassador_revenue),
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at
            ]);
        }
    }
}

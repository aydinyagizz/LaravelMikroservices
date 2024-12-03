<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linkProducts = DB::connection('old_mysql')->table('link_products')->get();
        foreach ($linkProducts as $linkProduct) {
            DB::table('link_products')->insert([
                'id' => $linkProduct->id,
                'link_id' => $linkProduct->link_id,
                'product_id' => $linkProduct->product_id
            ]);
        }
    }
}

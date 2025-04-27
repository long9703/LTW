<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Dữ liệu mẫu cho bảng products
        DB::table('products')->insert([
            [
                'name' => 'Sed Product',
                'category_id' => 1,  // Đảm bảo category_id hợp lệ
                'price' => 616.37,
                'discount' => 50.00,
                'image' => 'https://via.placeholder.com/640x480.png/0055aa?text=products+sed',
                'description' => 'Nostrum et error similique voluptates commodi...',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            [
                'name' => 'Facilis Product',
                'category_id' => 2,  // Đảm bảo category_id hợp lệ
                'price' => 967.16,
                'discount' => 20.00,
                'image' => 'https://via.placeholder.com/640x480.png/001144?text=products+facilis',
                'description' => 'Inventore eius illum accusantium animi dignissimos...',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'deleted_at' => null,
            ],
            // Thêm nhiều sản phẩm hơn nếu cần
        ]);
    }
}

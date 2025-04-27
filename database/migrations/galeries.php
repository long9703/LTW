<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('galeries', function (Blueprint $table) {
            $table->id(); // id tự tăng, primary key
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // khóa ngoại đến bảng `products`
            $table->string('thumbnail', 255)->nullable(); // chiều dài tối đa 255 ký tự cho URL
            $table->timestamps(); // Tạo cột created_at và updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeries');
    }
};

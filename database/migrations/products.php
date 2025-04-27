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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sản phẩm, không nullable
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Không nullable, xóa sản phẩm khi danh mục bị xóa
            $table->decimal('price', 10, 2)->nullable(); // Định dạng lại giá thành decimal
            $table->decimal('discount', 10, 2)->nullable(); // Sử dụng decimal cho discount, nếu giảm giá là số tiền cụ thể
            $table->string('image')->nullable(); // Hình ảnh sản phẩm
            $table->longText('description')->nullable(); // Mô tả sản phẩm
            $table->timestamps();
            $table->softDeletes(); // Tạo cột deleted_at để hỗ trợ soft delete
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

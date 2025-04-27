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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Tạo id tự tăng làm khóa chính
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Liên kết với bảng users, nullable
            $table->string('fullname')->nullable(); // Họ tên người đặt hàng
            $table->string('email')->nullable(); // Email người đặt hàng
            $table->string('phone_number')->nullable(); // Số điện thoại
            $table->string('address')->nullable(); // Địa chỉ giao hàng
            $table->string('note')->nullable(); // Ghi chú
            $table->dateTime('order_date')->nullable(); // Thời gian đặt hàng
            $table->integer('status')->nullable(); // Trạng thái đơn hàng
            $table->decimal('total_money', 10, 2)->nullable(); // Tổng tiền, sử dụng decimal
            $table->timestamps(); // Cột created_at, updated_at
            $table->softDeletes(); // Hỗ trợ xóa mềm
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

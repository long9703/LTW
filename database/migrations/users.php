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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tạo khóa chính tự tăng
            $table->string('fullname'); // Tên người dùng, không nullable nếu cần thiết
            $table->string('email')->unique(); // Đảm bảo email là duy nhất
            $table->string('phone_number')->nullable(); // Số điện thoại có thể nullable
            $table->string('address')->nullable(); // Địa chỉ có thể nullable
            $table->string('username')->unique(); // Đảm bảo username là duy nhất
            $table->string('password'); // Mật khẩu không nullable
            $table->unsignedBigInteger('role_id');
            $table->foreignId('role_id')->constrained('roles')->onDelete('set null'); // Khóa ngoại liên kết với bảng roles
            $table->timestamps(); // Tạo created_at và updated_at
            $table->softDeletes(); // Tạo deleted_at cho Soft Deletes
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

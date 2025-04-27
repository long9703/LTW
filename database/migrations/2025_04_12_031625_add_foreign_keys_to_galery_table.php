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
        Schema::table('galeries', function (Blueprint $table) {
           
            $table->foreign('product_id')
                ->references('id')->on('products') 
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galeries', function (Blueprint $table) {
            $table->dropForeign('galery_ibfk_1');
        });
    }
};

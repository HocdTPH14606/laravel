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
            $table->string('name'); 
            $table->string('image'); 
            $table->string('list_images'); 
            $table->string('sku');
            $table->float('price', 12, 2);
            $table->integer('quantity')->nullable(); 
            $table->string('detail'); 
            $table->integer('discount')->default(0);
            $table->integer('status')->default(1); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();  
        });
    }
//tên, (dang mục), ảnh, chi tiết, sku(mã từng sp), giá, số lượng, giảm giá,  status
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

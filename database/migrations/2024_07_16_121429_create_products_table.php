<?php

use App\Models\Category;
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
            $table->foreignIdFor(Category::class)->constrained()->index();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('img_thumb')->nullable();
            $table->decimal('price_regular', 10, 2);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->unsignedInteger('quantity');
            $table->text('overview')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();
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

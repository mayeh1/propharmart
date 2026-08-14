<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('products')->whereNotNull('image')->get(['id', 'image'])->each(function ($product) {
            DB::table('product_images')->insert([
                'product_id' => $product->id,
                'url' => $product->image,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable();
        });

        DB::table('product_images')->orderBy('sort_order')->get()->groupBy('product_id')->each(function ($images, $productId) {
            DB::table('products')->where('id', $productId)->update(['image' => $images->first()->url]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubCategory::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->float('selling_price');
            $table->float('regular_price')->nullable();
            $table->string('discount')->nullable();
            $table->string('main_image');
            $table->text('short_description');
            $table->longText('long_description')->nullable();
            $table->integer('total_clicked')->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->integer('quantity');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_drop_shop')->nullable()->comment('0: No,1: yes');
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

<?php

use App\Models\Food;
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
        Schema::create(Food::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Food::NAME);
            $table->float(Food::PRICE);
            $table->string(Food::TYPE);
            $table->integer(Food::DISCOUNT);
            $table->string(Food::IMAGE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};

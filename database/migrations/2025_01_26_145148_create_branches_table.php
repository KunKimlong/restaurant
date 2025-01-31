<?php

use App\Models\Branch;
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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string(Branch::NAME);
            $table->integer(Branch::NUMBER);
            $table->string(Branch::STREET)->nullable(true);;
            $table->string(Branch::VILLAGE)->nullable(true);
            $table->string(Branch::COMMUNE)->nullable(true);
            $table->string(Branch::DISTRICT)->nullable(true);
            $table->string(Branch::PROVINCE)->nullable(true);
            $table->string(Branch::IMAGE);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};

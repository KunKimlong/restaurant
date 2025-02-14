<?php

use App\Models\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Company::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Company::NAME);
            $table->string(Company::LOGO)->nullable();
            $table->text(Company::ADDRESS);
            $table->timestamps();
        });
        DB::transaction(function(){
            Company::create([
                Company::NAME => "Kimlong",
                Company::LOGO => "",
                Company::ADDRESS => "Songkat Tiek Tla, Khan Sen Sok, Phnom Penh city ",
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

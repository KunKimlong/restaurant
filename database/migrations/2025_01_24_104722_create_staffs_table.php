<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Staff;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string(Staff::FISRT_NAME);
            $table->string(Staff::LAST_NAME);
            $table->char(Staff::GENDER,7);
            $table->char(Staff::PHONE_NUMBER,10)->nullable(true);
            $table->text(Staff::ADDRESS)->nullable(true);
            $table->integer(Staff::POSITION_ID,false,true);
            $table->float(Staff::SALARY)->nullable(true);
            $table->date(Staff::JOIN_DATE)->nullable(true);
            $table->date(Staff::DATE_OF_BIRTH)->nullable(true);
            $table->string(Staff::ROLE)->comment("admin, manager, employee");
            $table->string(Staff::PROFILE)->nullable(true);
            $table->integer(Staff::BRANCH_ID)->nullable(true);
            $table->string(Staff::EMAIL)->unique();
            $table->string(Staff::PASSWORD);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};

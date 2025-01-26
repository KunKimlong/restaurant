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
            $table->char(Staff::PHONE_NUMBER,10);
            $table->text(Staff::ADDRESS);
            $table->integer(Staff::POSITION_ID,false,true);
            $table->float(Staff::SALARY);
            $table->date(Staff::JOIN_DATE);
            $table->date(Staff::DATE_OF_BIRTH);
            $table->string(Staff::ROLE)->comment("admin, manager, employee");
            $table->string(Staff::PROFILE);
            $table->integer(Staff::BRANCH_ID);
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

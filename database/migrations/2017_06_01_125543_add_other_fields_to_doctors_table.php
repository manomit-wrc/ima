<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherFieldsToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('address')->after('last_name');
            $table->string('sex',1)->nullable()->after('mobile');
            $table->string('city')->nullable()->after('password');
            $table->string('pincode')->nullable()->after('password');
            $table->string('avators')->nullable()->after('status');
            $table->date('dob')->nullable()->after('status');
            $table->string('license')->nullable()->after('status');
            $table->text('biography')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            //
        });
    }
}

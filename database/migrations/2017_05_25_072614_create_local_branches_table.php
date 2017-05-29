<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch_name');
            $table->string('branch_head');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->text('branch_address');
            $table->string('mobile_no');
            $table->string('phone_no');
            $table->string('email_id');
            $table->string('branch_image');
            $table->smallInteger('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_branches');
    }
}

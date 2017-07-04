<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaymentToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('payment')->nullable()->after('testimonial');
            $table->date('date_of_payment')->nullable()->after('payment');
            $table->text('certificate')->nullable()->after('date_of_payment');
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
            $table->dropColumn('payment');
            $table->dropColumn('date_of_payment');
            $table->dropColumn('certificate');
        });
    }
}

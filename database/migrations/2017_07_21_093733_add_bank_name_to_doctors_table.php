<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankNameToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->text('bank_name')->nullable()->after('avators');
            $table->text('branch_name')->nullable()->after('bank_name');
            $table->text('cheque_no')->nullable()->after('branch_name');
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
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('cheque_no');
        });
    }
}

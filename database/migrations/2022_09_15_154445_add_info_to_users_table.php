<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->after('description',function($table){
                $table->string('company_name')->nullable();
                $table->string('country')->nullable();
                $table->string('street_address')->nullable();
                $table->string('postcode_zip')->nullable();
                $table->string('town_city')->nullable();
                $table->string('phone')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_name','country','street_address','postcode_zip','town_city','phone']);
        });
    }
}

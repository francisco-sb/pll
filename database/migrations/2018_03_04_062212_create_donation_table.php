<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationTable extends Migration
{

    public function up()
    {
        Schema::create('donation', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->decimal('amount');
            // Constraints declaration

        });
    }

    public function down()
    {
        Schema::drop('donation');
    }
}

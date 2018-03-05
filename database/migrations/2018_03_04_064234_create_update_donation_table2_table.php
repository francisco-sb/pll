<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateDonationTable2Table extends Migration
{

    public function up()
    {
        Schema::table('donation', function(Blueprint $table) {
            $table->timestamps();
            // Schema declaration
            // Constraints declaration
        });
    }

    public function down()
    {
        Schema::drop('update_donation_table');
        Schema::drop('update_donation');
    }
}

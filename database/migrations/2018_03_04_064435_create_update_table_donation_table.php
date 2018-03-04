<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateTableDonationTable extends Migration
{

    public function up()
    {
        Schema::table('donation', function(Blueprint $table) {
            $table->softDeletes();
            // Schema declaration
            // Constraints declaration
        });
    }

    public function down()
    {
        
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if(!Schema::hasTable('contacts')){
            Schema::create('contacts', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->mediumText('contact');
                $table->string('contact_type')->nullable();
                $table->nullableMorphs('contactable');
                $table->timestamps();
            });
       }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
        
    }
    
}

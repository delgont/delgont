<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('menu_items')){
            Schema::create('menu_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('label');
                $table->text('url');
                $table->nullableMorphs('menuable_item');
                $table->unsignedBigInteger('menu_id');
                $table->timestamps();
                $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
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
        Schema::dropIfExists('icons');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('location_km');
            $table->integer('location_piket')->nullable()->comment('пикет');
            $table->decimal('lat', 17, 15)->comment('Широта');
            $table->decimal('lng', 17, 15)->comment('Долгота');
            $table->text('comment')->nullable();

            // Внешний ключ на сектор, которому принадлежит шкаф
            $table->foreignId('sector_id')->constrained()->onDelete('cascade')->comment('привязка к сектору');
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
        Schema::dropIfExists('cabinets');
    }
}

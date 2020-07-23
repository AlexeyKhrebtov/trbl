<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cameras', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('location_km');
            $table->integer('location_piket')->nullable()->comment('пикет');
            $table->decimal('lat', 17, 15)->comment('Широта');
            $table->decimal('lng', 17, 15)->comment('Долгота');
            $table->text('comment')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->string('login')->nullable();
            $table->string('password')->nullable();

            // Внешний ключ на шкаф, которому принадлежит камера
            $table->foreignId('cabinet_id')->constrained()->onDelete('cascade')->comment('привязка к шкафу');;

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
        Schema::dropIfExists('cameras');
    }
}

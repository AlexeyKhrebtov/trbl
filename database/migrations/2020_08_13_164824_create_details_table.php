<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название, модель конкретного оборудования');
            $table->foreignId('sheet_id')->constrained()->comment('Ссылка на ведомость')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->comment('Ссылка на оборудование');
            $table->foreignId('work_id')->constrained()->comment('Ссылка на тип работ');
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('details');
    }
}

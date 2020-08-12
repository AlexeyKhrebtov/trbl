<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unsigned()->comment('Номер дефектной ведомости');
            $table->date('date')->comment('Дата');
            $table->foreignId('sector_id')->constrained()->comment('Ссылка на участок ОПО');
            $table->tinyInteger('status')->unsigned()->comment('Статус ДФ, значени задается в модели');
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
        Schema::dropIfExists('sheets');
    }
}

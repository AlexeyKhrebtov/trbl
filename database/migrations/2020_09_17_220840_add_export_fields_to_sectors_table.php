<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExportFieldsToSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->string('inventory_number', 20)->nullable()->comment('Инвентарный номер');
            $table->string('object_location')->nullable()->comment('Местонахождение объекта');
            $table->string('region')->nullable()->comment('Регион');
            $table->string('route_part')->nullable()->comment('ПЧ');
            $table->string('fio')->nullable()->comment('ФИО ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sectors', function (Blueprint $table) {
            $table->dropColumn('inventory_number');
            $table->dropColumn('object_location');
            $table->dropColumn('region');
            $table->dropColumn('route_part');
            $table->dropColumn('fio');
        });
    }
}

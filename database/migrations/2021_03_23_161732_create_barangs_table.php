<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('NamaBarang', 100)->unique();
            $table->string('FotoBarang', 255);
            $table->decimal('HargaBeli', $precision = 18, $scale = 2);
            $table->decimal('HargaJual', $precision = 18, $scale = 2);
            $table->integer('Stok');
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
        Schema::dropIfExists('barangs');
    }
}

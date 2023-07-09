<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHewanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hewan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_usaha');
            $table->foreignId('jenis_id')->constrained('jenis');
            $table->integer('berat');
            $table->string('jk');
            $table->integer('usia');
            $table->string('status');
            $table->integer('harga');
            $table->foreignId('harga_id')->constrained('update_harga');
            $table->integer('quantity');
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
        Schema::dropIfExists('_hewan');
    }
}

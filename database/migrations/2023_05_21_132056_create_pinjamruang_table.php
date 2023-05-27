<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamruang', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->unsignedBigInteger('id_ruang');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggalmulai');
            $table->date('tanggalselesai');
            $table->string('keperluan', 100)->nullable;
            $table->string('email', 100)->nullable;
            $table->string('nohp', 100)->nullable;
            $table->timestamps();

            $table->foreign('id_ruang')->references('id')->on('ruang');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjamruang');
    }
};
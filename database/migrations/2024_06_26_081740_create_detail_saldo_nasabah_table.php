<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_saldo_nasabah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_saldo_nasabah');
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_penarikan_nasabah');
            $table->string('type_trans',255);
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_saldo_nasabah');
    }
};

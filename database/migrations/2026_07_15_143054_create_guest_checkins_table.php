<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('guest_checkins', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke ID tamu
        $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
        $table->integer('attended_count'); // Jumlah orang yang hadir saat check-in
        $table->unsignedBigInteger('checked_in_by'); // ID Usher yang bertugas
        $table->timestamp('checked_in_at')->nullable();
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
        Schema::dropIfExists('guest_checkins');
    }
}

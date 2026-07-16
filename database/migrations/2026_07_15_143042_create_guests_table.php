<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('guests', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->integer('invited_count')->default(1); // Kuota undangan
        $table->string('phone')->nullable();
        $table->string('category')->nullable();
        $table->string('table_number')->nullable();
        $table->text('notes')->nullable();
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
        Schema::dropIfExists('guests');
    }
}

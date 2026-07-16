<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouvenirTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('souvenir_tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
        $table->foreignId('guest_checkin_id')->constrained('guest_checkins')->onDelete('cascade');
        $table->string('ticket_code')->unique(); // Kode unik kupon/struk
        
        // Kolom status penukaran di meja souvenir (Meja Terpisah)
        $table->boolean('is_redeemed')->default(false);
        $table->unsignedBigInteger('redeemed_by')->nullable(); // Usher meja souvenir
        $table->timestamp('redeemed_at')->nullable();
        
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
        Schema::dropIfExists('souvenir_tickets');
    }
}

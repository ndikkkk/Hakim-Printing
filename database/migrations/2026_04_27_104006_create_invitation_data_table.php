<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('invitation_data', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->string('groom_name');
        $table->string('groom_father');
        $table->string('groom_mother');
        $table->string('bride_name');
        $table->string('bride_father');
        $table->string('bride_mother');
        $table->date('event_date');
        $table->string('event_time');
        $table->text('location_maps');
        $table->text('quotes')->nullable(); // Opsional
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitation_data');
    }
};
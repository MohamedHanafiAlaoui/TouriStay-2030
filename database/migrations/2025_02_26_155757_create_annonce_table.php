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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('prix', 10, 2);
            $table->foreignId('id_Propriétaire')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_Touriste')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('disponibilites')->default(true);
            $table->string('localisation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonce');
    }
};

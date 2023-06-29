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
        Schema::create('organisation_structure_organisation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organisation_id')->constrained('organisations');
            $table->foreignId('organisation_structure_id')->constrained('organisation_structures')->name('org_structure_foriegn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisation_structure_organisation');
    }
};

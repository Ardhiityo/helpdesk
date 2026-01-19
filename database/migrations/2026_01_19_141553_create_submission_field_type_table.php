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
        Schema::create('submission_field_type', function (Blueprint $table) {
            $table->string('new_value');
            $table->string('old_value');
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('field_type_id');
            $table->timestamps();

            $table->primary(['submission_id', 'field_type_id']);
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->foreign('field_type_id')->references('id')->on('field_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_field_type');
    }
};

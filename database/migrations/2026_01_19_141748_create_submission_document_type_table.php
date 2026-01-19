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
        Schema::create('submission_document_type', function (Blueprint $table) {
            $table->unsignedBigInteger('submission_id');
            $table->unsignedBigInteger('document_type_id');
            $table->string('file');
            $table->timestamps();

            $table->primary(['submission_id', 'document_type_id']);
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('cascade');
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_document_type');
    }
};

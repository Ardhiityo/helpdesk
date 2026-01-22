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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('file');
            $table->string('nim');
            $table->string('email');
            $table->string('study_program');
            $table->string('faculty');
            $table->enum('status', ['process', 'approved', 'rejected'])->default('process');
            $table->unsignedBigInteger('student_id');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};

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
        Schema::create('lessens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("academicSubject_id");
            $table->string("title");
            $table->timestamps();

            $table->index('academicSubject_id', 'lessen_academicsubject_idx');
            $table->foreign('academicSubject_id', 'lessen_academicsubject_fk')->on('academic_subjects')->references('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessens');
    }
};

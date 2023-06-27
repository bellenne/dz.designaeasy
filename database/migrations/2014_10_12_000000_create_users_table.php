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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('emails')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger("role_id")->default(1);
            $table->unsignedBigInteger("academicSubject_id")->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index("role_id", "users_role_idx");
            $table->index("academicSubject_id", "users_academicSubjects_idx");
            $table->foreign('role_id', 'users_role_fk')->on('user_roles')->references('id');
            $table->foreign('academicSubject_id', 'users_academicSubjects_fk')->on('academic_subjects')->references('id');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

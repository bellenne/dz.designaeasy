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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lessen_id");
            $table->string("title");
            $table->text("description");
            $table->string('example')->nullable();
            $table->string('example_type')->nullable();
            $table->string('resource')->nullable();

            $table->timestamps();

            $table->index('lessen_id', 'task_lessen_idx');
            $table->foreign('lessen_id', 'task_lessen_fk')->on('lessens')->references('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

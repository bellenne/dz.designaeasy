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
        Schema::create('finaly_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("task_id");
            $table->string("result");
            $table->timestamps();

            $table->index("user_id", "finalytasks_users_idx");
            $table->index("task_id", "finalytasks_tasks_idx");

            $table->foreign('user_id', 'finalytasks_users_fk')->on('users')->references('id');
            $table->foreign('task_id', 'finalytasks_tasks_fk')->on('tasks')->references('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finaly_tasks');
    }
};

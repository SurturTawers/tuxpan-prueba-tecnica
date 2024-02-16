<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->tinyInteger('priority');
            $table->dateTimeTz('due_at');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('user_tasks', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('task_id')->constrained('tasks','id')->cascadeOnDelete();
            $table->dateTimeTz('assigned_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_tasks');
        Schema::dropIfExists('tasks');
    }
};

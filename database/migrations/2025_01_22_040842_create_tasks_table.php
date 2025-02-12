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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('list_id')->nullable()->constrained('task_lists')->cascadeOnDelete();
            $table->string('name');
            $table->enum('status', ['pending','In Progress', 'completed', 'overdue'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->text('description');
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->time('time');
            $table->date('deadline')->nullable();
            $table->timestamps();
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

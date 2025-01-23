<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * This method defines the structure of the 'todos' table.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id(); // Primary key column
            $table->string('name'); // Column to store the name of the todo
            $table->text('description')->nullable(); // Column to store the description, can be null
            $table->boolean('completed')->default(false); // Column to track completion status, default is false
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     * This method drops the 'todos' table when rolling back the migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('todos'); // Drops the 'todos' table if it exists
    }
};

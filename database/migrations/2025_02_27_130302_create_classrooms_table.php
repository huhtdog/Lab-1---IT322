<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id(); // classroom_id (Primary Key)
            $table->year('year'); // Year of the classroom
            $table->foreignId('grade_id')->constrained()->onDelete('cascade'); // Foreign Key to Grades Table
            $table->char('section', 2); // Section (e.g., "A", "B")
            $table->boolean('status')->default(1); // Active status
            $table->string('remarks', 45)->nullable(); // Optional remarks
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // Foreign Key to Teachers Table
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};

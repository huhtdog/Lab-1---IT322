<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classroom_student', function (Blueprint $table) {
            $table->foreignId('classroom_id')->constrained()->onDelete('cascade'); // Foreign Key to Classrooms
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Foreign Key to Students
            $table->primary(['classroom_id', 'student_id']); // Composite Primary Key
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classroom_student');
    }
};

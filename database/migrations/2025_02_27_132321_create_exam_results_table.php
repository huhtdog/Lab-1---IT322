<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->id(); // exam_result_id (Primary Key)
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Foreign Key to Students Table
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); // Foreign Key to Courses Table
            $table->string('marks', 45); // Marks obtained
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_results');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); // exam_id (Primary Key)
            $table->foreignId('exam_type_id')->constrained()->onDelete('cascade'); // Foreign Key to Exam Types Table
            $table->string('name', 45); // Exam Name
            $table->date('start_date'); // Exam Start Date
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};

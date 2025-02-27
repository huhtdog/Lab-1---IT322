<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->date('date'); // Attendance date
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Foreign Key to Students
            $table->boolean('status'); // Attendance status (Present/Absent)
            $table->text('remark')->nullable(); // Additional remarks
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};

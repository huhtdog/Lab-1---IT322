<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_types', function (Blueprint $table) {
            $table->id(); // exam_type_id (Primary Key)
            $table->string('name', 45); // Exam Type Name
            $table->string('desc', 45)->nullable(); // Description
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_types');
    }
};

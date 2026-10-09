<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('scholarship_programs', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('scholarship_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('sk_issuers', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('academic_periods', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('semester')->nullable();
            $table->unsignedSmallInteger('academic_year_start')->nullable();
            $table->unsignedSmallInteger('academic_year_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('faculties', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('study_programs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('faculty_id')->constrained()->restrictOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['faculty_id', 'is_active']);
        });

        Schema::create('banks', function (Blueprint $table): void {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table): void {
            $table->id();
            $table->string('nim')->unique();
            $table->string('name');
            $table->foreignId('faculty_id')->nullable()->constrained()->restrictOnDelete();
            $table->foreignId('study_program_id')->nullable()->constrained()->restrictOnDelete();
            $table->unsignedSmallInteger('entry_year')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index(['faculty_id', 'study_program_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('study_programs');
        Schema::dropIfExists('faculties');
        Schema::dropIfExists('academic_periods');
        Schema::dropIfExists('sk_issuers');
        Schema::dropIfExists('scholarship_categories');
        Schema::dropIfExists('scholarship_programs');
    }
};

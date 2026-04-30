<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('file_number')->unique();
            $table->string('jurisdictional_body')->nullable();
            $table->string('judge')->nullable();
            $table->string('start_date')->nullable();
            $table->string('subject')->nullable();
            $table->string('procedural_stage')->nullable();
            $table->string('location')->nullable();
            $table->string('sumilla')->nullable();
            $table->string('judicial_district')->nullable();
            $table->string('legal_specialist')->nullable();
            $table->string('process')->nullable();
            $table->string('specialty')->nullable();
            $table->string('status')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('reason_conclusion')->nullable();
            $table->foreignId('lawyer_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cases');
    }
};
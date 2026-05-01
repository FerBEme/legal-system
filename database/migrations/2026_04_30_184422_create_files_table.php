<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->string('extension',10)->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('folder_id')->constrained('folders')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['folder_id','name']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('files');
    }
};
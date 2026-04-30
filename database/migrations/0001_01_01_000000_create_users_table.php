<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type',['dni','ce']);
            $table->string('document_number',9)->unique();
            $table->string('first_names');
            $table->string('paternal_surname');
            $table->string('maternal_surname');
            $table->char('phone',9);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_photo')->nullable();
            $table->enum('role',['admin','lawyer','secretary']);
            $table->char('tuition_number',10)->nullable();
            $table->foreignId('lawyer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('users');
    }
};
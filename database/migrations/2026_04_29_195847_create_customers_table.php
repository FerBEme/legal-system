<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type',['dni','ce','ruc']);
            $table->string('document_number',11)->unique();
            $table->string('business_name')->nullable();
            $table->string('first_names')->nullable();
            $table->string('paternal_surname')->nullable();
            $table->string('maternal_surname')->nullable();
            $table->char('phone',9)->nullable();
            $table->string('email')->nullable();
            $table->string('home_address')->nullable();
            $table->string('district_address')->nullable();
            $table->string('province_address')->nullable();
            $table->string('department_address')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void {
        Schema::dropIfExists('customers');
    }
};
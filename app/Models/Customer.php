<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model {
    use HasFactory,SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'document_type',
        'document_number',
        'business_name',
        'first_names',
        'paternal_surname',
        'maternal_surname',
        'phone',
        'email',
        'home_address',
        'district_address',
        'province_address',
        'department_address',
    ];
    protected $casts = [
        'id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
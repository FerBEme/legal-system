<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'document_type',
        'document_number',
        'first_names',
        'paternal_surname',
        'maternal_surname',
        'phone',
        'email',
        'password',
        'profile_photo',
        'role',
        'tuition_number',
        'lawyer_id'
    ];
    protected $casts = [
        'id' => 'integer',
        'password' => 'hashed',
        'lawyer_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims() {
        return [];
    }
    public function lawyer(){
        return $this->belongsTo(User::class,'lawyer_id');
    }
    public function secretaries(){
        return $this->hasMany(User::class,'lawyer_id');
    }
    public function specialties(){
        return $this->belongsToMany(
            Specialty::class,
            'specialty_user',
            'user_id',
            'specialty_id'
        );
    }
    public function cases(){
        return $this->hasMany(CaseModel::class,'lawyer_id');
    }
}
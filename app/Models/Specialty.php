<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Specialty extends Model {
    use SoftDeletes;
    protected $table = 'specialties';
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'level',
    ];
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'level' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function mainBranch(){
        return $this->belongsTo(Specialty::class,'parent_id');
    }
    public function secondaryBranches(){
        return $this->hasMany(Specialty::class,'parent_id');
    }
    public function lawyers(){
        return $this->belongsToMany(
            User::class,
            'specialty_user',
            'specialty_id',
            'user_id'
        );
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Folder extends Model {
    use HasFactory,SoftDeletes;
    protected $table = 'folders';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'parent_id',
        'case_id',
    ];
    public function folder(){
        return $this->belongsTo(Folder::class,'parent_id');
    }
    public function subFolders(){
        return $this->hasMany(Folder::class,'parent_id');
    }
    public function numberCase(){
        return $this->belongsTo(CaseModel::class,'case_id');
    }
    public function files(){
        return $this->hasMany(File::class,'folder_id');
    }
}
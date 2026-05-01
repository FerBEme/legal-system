<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class File extends Model {
    use HasFactory,SoftDeletes;
    protected $table = 'files';
    protected $fillable = [
        'name',
        'path',
        'mime_type',
        'extension',
        'size',
        'uploaded_by',
        'folder_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'size' => 'integer',
        'uploaded_by' => 'integer',
        'folder_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function uploader(){
        return $this->belongsTo(User::class,'uploaded_by');
    }
    public function folder(){
        return $this->belongsTo(Folder::class,'folder_id');
    }
}
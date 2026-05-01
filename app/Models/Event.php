<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Event extends Model {
    use HasFactory,SoftDeletes;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'event_type',
        'start_date',
        'end_date',
        'meeting_link',
        'description',
        'case_id',
        'created_by',
    ];
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'case_id' => 'integer',
        'created_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
    public function numberCase(){
        return $this->belongsTo(CaseModel::class,'case_id');
    }
    public function creater(){
        return $this->belongsTo(User::class,'created_by');
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CaseModel extends Model {
    use SoftDeletes;
    protected $table = 'cases';
    protected $fillable = [
        'file_number',
        'jurisdictional_body',
        'judge',
        'start_date',
        'subject',
        'procedural_stage',
        'location',
        'sumilla',
        'judicial_district',
        'legal_specialist',
        'process',
        'specialty',
        'status',
        'completion_date',
        'reason_conclusion',
        'lawyer_id',
        'customer_id',
    ];
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'date',
        'lawyer_id' => 'integer',
        'customer_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
    public function lawyer(){
        return $this->belongsTo(User::class,'lawyer_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
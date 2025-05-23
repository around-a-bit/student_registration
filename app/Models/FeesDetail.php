<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesDetail extends Model
{
    use HasFactory;

    protected $table = "fees_details";
    protected $primaryKey = "id";
    protected $fillable = [
        'fees_structure_id',
        'fees_head_id', 
        'amount'
    ];
    

    public function feesStructure()
{
    return $this->belongsTo(FeesStructure::class, 'fees_structure_id');
}

public function feesHead()
{
    return $this->belongsTo(FeesHead::class, 'fees_head_id'); // Assuming you have this model
}


}
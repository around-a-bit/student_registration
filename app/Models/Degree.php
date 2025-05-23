<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Degree extends Model
{
    use HasFactory;
    protected $table = "degrees";
    protected $primaryKey = "id";
    
    public static function getAllDegrees()
    {
        
        return DB::table('degrees')->get();
    }
}
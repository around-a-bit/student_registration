<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Specialization extends Model
{
    use HasFactory;
    protected $table = "specializations";
    protected $primaryKey = "id";
    public static function getAllSpecializations()
    {
        return DB::table('specializations')->get();
    }
}

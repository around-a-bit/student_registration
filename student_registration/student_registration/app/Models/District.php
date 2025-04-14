<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class District extends Model
{
    use HasFactory;
    protected $table = "districts";
    protected $primaryKey = "id";

    public static function getAllDistricts($state_id)
    {
        return DB::table('districts')
        ->where('state_id',$state_id)
        ->get();
    }
}
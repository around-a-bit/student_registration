<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class School extends Model
{
    use HasFactory;
    protected $table = "schools";
    protected $primaryKey = "id";
    public static function getAllSchools()
    {
        return DB::table('schools')->get();
    }
}

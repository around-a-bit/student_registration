<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gender extends Model
{
    use HasFactory;
    protected $table = "genders";
    protected $primaryKey = "id";
    public static function getAllGenders()
    {
        return DB::table('genders')->get();
    }
}

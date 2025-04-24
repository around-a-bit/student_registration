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
    public static function getGenderCount($gender_id) {
        $count = DB::table('student_basic_details')->where('gender_id',$gender_id)->count();
        return $count;
    }
}

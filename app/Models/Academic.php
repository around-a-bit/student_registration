<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    use HasFactory;
    protected $table = "academics";
    protected $primaryKey = "id";
    public function states()
    {
        return $this->hasMany(State::class);
    }
    public static function getAllAcademicYear()
    {
        return DB::table('academics')->get();
    }
}
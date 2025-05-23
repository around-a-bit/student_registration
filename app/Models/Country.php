<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = "countries";
    protected $primaryKey = "id";
    public function states()
    {
        return $this->hasMany(State::class);
    }
    public static function getAllCountries()
    {
        
        return DB::table('countries')->get();
    }
}
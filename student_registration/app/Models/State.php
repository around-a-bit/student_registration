<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class State extends Model
{
    use HasFactory;
    protected $table = "states";
    protected $primaryKey = "id";


    public static function getAllStates($country_id)
{
    return DB::table('states')
            ->where('country_id', $country_id)
            ->get();
}


}

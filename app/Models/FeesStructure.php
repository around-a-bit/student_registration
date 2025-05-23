<?php
// app/Models/FeesStructure.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesStructure extends Model
{
    use HasFactory;
    protected $table = 'fees_structure';

    protected $fillable = ['total_amount', 'course_id', 'academic_id','semester_id', 'structure_name'];

    public function course()
    {
        return $this->belongsTo(Degree::class, 'degree_id');
    }



    public function academicYear()
{
    return $this->belongsTo(Academic::class, 'academic_id');
}

    public function feesDetails()
    {
        return $this->hasMany(FeesDetail::class, 'fees_structure_id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'semester_id');
    }


}
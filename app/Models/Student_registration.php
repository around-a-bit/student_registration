<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Student_registration extends Model
{
    use HasFactory;


    protected $fillable = [
        "fname",
        "lname",
        "gender_id",
        "email",
        "mobile",
        "uid",
        "degree_id",
        "specialization_id",
        "school_id",
        "dob",
        "country_id",
        "state_id",
        "district_id",
        "pin",
        "street",
        "password",
        "photo",
        "signature"
    ];


    public static function registerStudent(array $data)
    {
        try {
            DB::beginTransaction();
            $existingStudent = DB::table('students')->where('email', $data['email'])->first();
            if (!$existingStudent) {
                throw new \Exception("No student found with email: " . $data['email']);
            }
            DB::table('students')
                ->where('email', $data['email'])
                ->update([
                    'fname' => $data['fname'],
                    'lname' => $data['lname'],
                    'mobile' => $data['mobile'],
                    'password' => $data['password'],
                    'updated_at' => now()
                ]);

            $studentId = DB::table('students')
                ->where('email', $data['email'])
                ->value('id');

            Log::info('$studentId:', ['id' => $studentId]);

            $basicIDs =  DB::table('student_basic_details')->updateOrInsert(['student_id' => $studentId], ['updated_at' => now()]);
            $courseIDs =  DB::table('student_course_details')->updateOrInsert(['student_id' => $studentId], ['updated_at' => now()]);
            $addressIDs =  DB::table('student_address_details')->updateOrInsert(['student_id' => $studentId], ['updated_at' => now()]);

            if (!$basicIDs) {
                DB::rollBack();
                throw new \Exception("Failed to insert student id into the student_basic_details_id table");
            }
            if (!$courseIDs) {
                DB::rollBack();
                throw new \Exception("Failed to insert student id into the student_course_details_id table");
            }
            if (!$addressIDs) {
                DB::rollBack();
                throw new \Exception("Failed to insert student id into the student_address_details_id table");
            }


            DB::commit();
            return $studentId;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Registration failed: " . $e->getMessage());
            throw $e;
        }
    }

    public static function generateRegistrationNo()
    {
        $year = date('Y');
        $lastStudent = DB::table('students')->where('registration_no', 'like', "DCG{$year}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastStudent) {
            $lastNumber = (int)substr($lastStudent->registration_no, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        Log::info("DCG{$year}{$newNumber}");
        return "DCG{$year}{$newNumber}";
    }
}

<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

// --------------------------------------------------------------------------------------------------------
class Student extends Model
{
    protected $table = 'students';
    protected $primarykey = 'id';
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
        "password",
        "photo",
        "signature"
    ];
    // --------------------------------------------------------------------------------------------------------
    public static function checkDataForLoginValidation($validated, $role)
    {

        if ($role === 'student') {
            $data = DB::table('students')
                ->where('email', $validated['email'])
                ->select('id', 'email', 'password')
                ->first();

            return $data ? (object) $data : null;
        } else if ($role === 'admin') {
            $data = DB::table('admins')
                ->where('email', $validated['email'])
                ->select('id', 'email', 'password')
                ->first();

            return $data ? (object) $data : null;
        }
    }

    // --------------------------------------------------------------------------------------------------------

    // getFname
    public static function getFname($search_item)
    {
        $users = DB::table('students')
            ->where('fname', 'like', "%{$search_item}%")
            ->limit(5)
            ->get(['fname']);

        return $users;
    }

    // --------------------------------------------------------------------------------------------------------

    public static function getPhotoSignatureName($email)
    {
        return DB::table('students')->select('photo', 'signature')->where('email', '=', $email)->first();
    }
    public static function getuid($id)
    {
        return DB::table('student_education_details')->select('uid')->where('student_id', '=', $id)->first();
    }


    // --------------------------------------------------------------------------------------------------------

    public static function getStudent($filters)
    {

        $query = DB::table('students')
            ->select(
                'students.id',
                'students.fname',
                'students.lname',
                'students.email',
                'students.mobile',
                'students.photo',
                'students.signature',
                'students.registration_no',
            )
            ->leftJoin('student_education_details', 'students.id', '=', 'student_education_details.student_id')
            ->leftJoin('degrees', 'student_education_details.degree_id', '=', 'degrees.id')
            ->leftJoin('specializations', 'student_education_details.specialization_id', '=', 'specializations.id')
            ->leftJoin('student_course_details', 'students.id', '=', 'student_course_details.student_id')
            ->leftJoin('schools', 'student_education_details.school_id', '=', 'schools.id')
            ->leftJoin('student_address_details', 'students.id', '=', 'student_address_details.student_id')
            ->leftJoin('countries', 'student_address_details.country_id', '=', 'countries.id')
            ->leftJoin('states', 'student_address_details.state_id', '=', 'states.id')
            ->leftJoin('districts', 'student_address_details.district_id', '=', 'districts.id')
            ->leftJoin('student_basic_details', 'students.id', '=', 'student_basic_details.student_id')
            ->leftJoin('genders', 'student_basic_details.gender_id', '=', 'genders.id')
            ->leftJoin('degrees', 'degrees.id', '=', 'students.degree_id_opt')
            ->leftJoin('specializations', 'specializations.id', '=', 'students.specialization_id_opt');


        // Apply Filters  
        if (isset($filters['id']) && filled($filters['id'])) {
            $query->where('students.id', $filters['id']);
        }
        if (isset($filters['search_term']) && filled($filters['search_term'])) {
            $term = '%' . $filters['search_term'] . '%';
            $query->where(function ($q) use ($term) {
                $q->where('students.fname', 'like', $term)
                    ->orWhere('students.lname', 'like', $term)
                    ->orWhere('students.email', 'like', $term)
                    ->orWhere('students.mobile', 'like', $term)
                    ->orWhere('students.registration_no', 'like', $term)
                    ->orWhere('student_education_details.uid', 'like', $term)
                    ->orWhere('degrees.name', 'like', $term)
                    ->orWhere('specializations.name', 'like', $term)
                    ->orWhere('schools.name', 'like', $term)
                    ->orWhere('countries.name', 'like', $term)
                    ->orWhere('states.name', 'like', $term)
                    ->orWhere('districts.name', 'like', $term)
                    ->orWhere('genders.name', 'like', $term);
            });
        }

        if (isset($filters['fname']) && filled($filters['fname'])) {
            $query->where('students.fname', $filters['fname']);
        }
        if (isset($filters['gender_id']) && filled($filters['gender_id'])) {
            $query->where('genders.id', $filters['gender_id']);
        }
        if (isset($filters['school_id']) && filled($filters['school_id'])) {
            $query->where('schools.id', $filters['school_id']);
        }
        if (isset($filters['country_id']) && filled($filters['country_id'])) {
            $query->where('countries.id', $filters['country_id']);
        }
        if (isset($filters['state_id']) && filled($filters['state_id'])) {
            $query->where('states.id', $filters['state_id']);
        }
        if (isset($filters['district_id']) && filled($filters['district_id'])) {
            $query->where('districts.id', $filters['district_id']);
        }
        if (isset($filters['date_from'], $filters['date_to']) && filled($filters['date_from']) && filled($filters['date_to'])) {
            $query->whereBetween('student_basic_details.dob', [$filters['date_from'], $filters['date_to']]);
        } elseif (isset($filters['date_from']) && filled($filters['date_from'])) {
            $query->where('student_basic_details.dob', '>=', $filters['date_from']);
        } elseif (isset($filters['date_to']) && filled($filters['date_to'])) {
            $query->where('student_basic_details.dob', '<=', $filters['date_to']);
        }

        $result = $query->groupBy('students.id', 'students.fname', 'students.lname', 'students.email', 'students.mobile', 'students.photo', 'students.signature', 'students.registration_no')
            ->orderByDesc('students.id');

        // dd($result);
        return $result;
    }


    // --------------------------------------------------------------------------------------------------------

    public static function getRegistration_no($email)
    {
        $query = DB::table('students')->select('registration_no')->where('email', "=", $email);
        return $query->get();
    }



    // --------------------------------------------------------------------------------------------------------

    public static function getStudentData($column, $value)
    {
        $query = DB::table('students')
            ->select(
                'students.id',
                'students.fname',
                'students.lname',
                'students.email',
                'students.mobile',
                'students.photo',
                'students.signature',
                'students.registration_no',
                'students.is_submitted'
            );

        if (!is_null($column) && $column === "id") {
            return $query->where("students.{$column}", '=', $value)->first();
        }
        // $result = $query->orderBy('students.id', 'desc')->get();
        $result = $query->orderBy('students.id', 'desc');
        // dd($result);
        return $result;
    }



    // --------------------------------------------------------------------------------------------------------
    public static function getStudentAllData($column, $value)
    {
        $query = DB::table('students')
            ->select(
                'students.id',
                'students.fname',
                'students.lname',
                'students.email',
                'students.mobile',
                'students.degree_id_opt',
                'd.name as degree_id_opt_name',
                'students.specialization_id_opt',
                'sp.name as specialization_id_opt_name',
                'students.photo',
                'students.signature',
                'students.registration_no',
                'students.is_submitted',
                'student_course_details.degree_id as degree_id',
                'student_course_details.specialization_id as specialization_id',
                'student_address_details.street as street',
                'student_address_details.pin as pin',
                'countries.name as country',
                'countries.id as country_id',
                'states.name as state',
                'states.id as state_id',
                'districts.name as district',
                'districts.id as district_id',
                'student_basic_details.dob as dob',
                'genders.name as gender',
                'genders.id as gender_id',


                DB::raw("GROUP_CONCAT(student_education_details.uid) as uids"),
                DB::raw("GROUP_CONCAT(degrees.name) as degrees"),
                DB::raw("GROUP_CONCAT(degrees.id) as degree_ids"),
                DB::raw("GROUP_CONCAT(specializations.name) as specializations"),
                DB::raw("GROUP_CONCAT(specializations.id) as specialization_ids"),
                DB::raw("GROUP_CONCAT(schools.name) as schools"),
                DB::raw("GROUP_CONCAT(schools.id) as school_ids")
            )
            ->leftJoin('student_education_details', 'students.id', '=', 'student_education_details.student_id')
            ->leftJoin('degrees', 'student_education_details.degree_id', '=', 'degrees.id')
            ->leftJoin('student_course_details', 'students.id', '=', 'student_course_details.student_id')   ///////////////
            ->leftJoin('specializations', 'student_education_details.specialization_id', '=', 'specializations.id')
            ->leftJoin('schools', 'student_education_details.school_id', '=', 'schools.id')
            ->leftJoin('student_address_details', 'students.id', '=', 'student_address_details.student_id')
            ->leftJoin('countries', 'student_address_details.country_id', '=', 'countries.id')
            ->leftJoin('states', 'student_address_details.state_id', '=', 'states.id')
            ->leftJoin('districts', 'student_address_details.district_id', '=', 'districts.id')
            ->leftJoin('student_basic_details', 'students.id', '=', 'student_basic_details.student_id')
            ->leftJoin('genders', 'student_basic_details.gender_id', '=', 'genders.id')
            ->leftJoin('degrees as d', 'd.id', '=', 'students.degree_id_opt')
            ->leftJoin('specializations as sp', 'sp.id', '=', 'students.specialization_id_opt')

            ->groupBy(
                'students.id',
                'students.fname',
                'students.lname',
                'students.email',
                'students.mobile',
                'students.degree_id_opt',
                'd.name',
                'students.specialization_id_opt',
                'sp.name',
                'students.photo',
                'students.signature',
                'students.is_submitted',
                'students.registration_no',
                'student_address_details.street',
                'student_address_details.pin',
                'student_course_details.degree_id',
                'student_course_details.specialization_id',
                'countries.name',
                'countries.id',
                'states.name',
                'states.id',
                'districts.name',
                'districts.id',
                'student_basic_details.dob',
                'genders.name',
                'genders.id'
            );

        if (!is_null($column) && !is_null($value)) {

            return $query->where("students.{$column}", '=', $value)->first();
        }
        $result = $query->orderBy('students.id', 'desc')->get();

        return $result;
    }

    // ========================================================================================================
  






















    public static function updateDetailsbyAdmin($email, $data, $table)
    {

        try {

            $id = DB::table('students')->where('email', $email)->value('id');
            if (!$id) {
                throw new ModelNotFoundException("Student record with Email $email not found.");
            }
            DB::beginTransaction();
            // Update student_basic_details
            if ($table === 'basic') {

                $dataToUpdate = array_filter([
                    'gender_id' => $data['gender_id'] ?? null,
                    'dob'       => $data['dob'] ?? null,
                    'updated_at' => now(),
                ], fn($value) => !is_null($value));

                if (!empty($dataToUpdate)) {
                    $success = DB::table('student_basic_details')->updateOrInsert(
                        ['student_id' => $id],
                        $dataToUpdate
                    );
                }

                if (!$success) {
                    throw new \Exception("Failed to update student_basic_details");
                }
                DB::commit();
                return $id;
            }
            // Update student_academics_details
            elseif ($table === 'academic') {

                foreach ($data['uid'] as $key => $uid) {
                    $degree = $data['degree_id'][$key] ?? null;
                    $specialization = $data['specialization_id'][$key] ?? null;
                    $school = $data['school_id'][$key] ?? null;


                    $dataToUpdate = array_filter([
                        'student_id'        => $id,
                        'specialization_id' => $specialization,
                        'school_id'         => $school,
                        'uid'               => $uid,
                        'updated_at'        => now(),
                    ], fn($value) => !is_null($value));

                    if (!empty($dataToUpdate)) {
                        $success = DB::table('student_education_details')->updateOrInsert(
                            ['student_id' => $id, 'degree_id' => $degree],
                            $dataToUpdate
                        );
                    }
                }

                if (!$success) {
                    throw new \Exception("Failed to update student_education_details");
                }

                DB::commit();
                return $id;
            }
            // Update student_course_details
            elseif ($table === 'students_course') {

                Log::info("course data in going to insert");

                $dataToUpdate = array_filter([
                    'degree_id_opt'  => $data['degree_id_opt'],
                    'specialization_id_opt'    => $data['specialization_id_opt']
                ], fn($value) => !is_null($value)); // Remove null values

                if (!empty($dataToUpdate)) {
                    $success = DB::table('students')->updateOrInsert(
                        ['id' => $id], // Search criteria
                        $dataToUpdate
                    );
                }

                if (!$success) {
                    throw new \Exception("Failed to update student_course_details");
                }
                DB::commit();
                return $id;
            } elseif ($table === 'address') {

                $dataToUpdate = array_filter([
                    'country_id'  => $data['country_id'] ?? null,
                    'state_id'    => $data['state_id'] ?? null,
                    'district_id' => $data['district_id'] ?? null,
                    'pin'         => $data['pin'] ?? null,
                    'street'      => $data['street'] ?? null,
                    'updated_at'  => now(),
                ], fn($value) => !is_null($value)); // Remove null values

                if (!empty($dataToUpdate)) {
                    $success = DB::table('student_address_details')->updateOrInsert(
                        ['student_id' => $id], // Search criteria
                        $dataToUpdate
                    );
                }

                if (!$success) {
                    throw new \Exception("Failed to update student_address_details");
                }
                DB::commit();
                return $id;
            } elseif ($table === 'document') {

                $dataToUpdate = array_filter([
                    'photo'      => $data['photo'] ?? null,
                    'signature'  => $data['signature'] ?? null,
                    'updated_at' => now(),
                ], fn($value) => !is_null($value));

                if (!empty($dataToUpdate)) {
                    $success = DB::table('students')
                        ->where('id', $id)
                        ->update($dataToUpdate);
                }
                if (!$success) {
                    throw new \Exception("Failed to update student_Documents");
                }

                DB::commit();
                return $id;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Basic details Update failed', ['error' => $e->getMessage()]);
            throw new \Exception("Failed to update student basic details record.");
        }
    }





























    // --------------------------------------------------------------------------------------------------------

    public static function updateDetails($email, $data, $table)
    {
        try {
            $id = DB::table('students')->where('email', $email)->value('id');
            if (!$id) {
                throw new ModelNotFoundException("Student record with Email $email not found.");
            }
            DB::beginTransaction();
            // Update student_basic_details
            if ($table === 'basic') {
                $success = DB::table('student_basic_details')->updateOrInsert(
                    ['student_id' => $id], // Search criteria
                    [
                        'gender_id'  => $data['gender_id'],
                        'dob'        => $data['dob'],
                        'updated_at' => now()
                    ]
                );

                if (!$success) {
                    throw new \Exception("Failed to insert student_basic_details");
                }
                DB::commit();
                return $id;
            }
            // Update student_academics_details
            elseif ($table === 'academic') {

                foreach ($data['uid'] as $key => $uid) {
                    $degree = isset($data['degree_id'][$key]) ? $data['degree_id'][$key] : null;
                    $specialization = isset($data['specialization_id'][$key]) ? $data['specialization_id'][$key] : null;
                    $school = isset($data['school_id'][$key]) ? $data['school_id'][$key] : null;

                    Log::info((array) $degree);
                    Log::info((array) $specialization);
                    Log::info((array) $school);
                    $success = DB::table('student_education_details')->updateOrInsert(
                        [
                            'student_id' => $id,
                            'degree_id'  => $degree
                        ],
                        [
                            'specialization_id' => $specialization,
                            'school_id'         => $school,
                            'uid'               => $uid,
                            'created_at'        => now(),
                            'updated_at'        => now()
                        ]
                    );
                }

                if (!$success) {
                    throw new \Exception("Failed to insert student_education_details");
                }

                DB::commit();
                return $id;
            }

            // Update student_course_details
            elseif ($table === 'students_course') {

                Log::info("course data in going to insert into the students table");

                $dataToUpdate = array_filter([
                    'degree_id_opt'  => $data['degree_id_opt'],
                    'specialization_id_opt'    => $data['specialization_id_opt']
                ], fn($value) => !is_null($value)); // Remove null values

                if (!empty($dataToUpdate)) {
                    $success = DB::table('students')->updateOrInsert(
                        ['id' => $id], // Search criteria
                        $dataToUpdate
                    );
                }

                if (!$success) {
                    return false;
                }
                DB::commit();
                return $id;
            } elseif ($table === 'address') {
                // Update student_address_details
                $success =  DB::table('student_address_details')->updateOrInsert(
                    ['student_id' => $id], // Search criteria
                    [
                        'country_id' => $data['country_id'],
                        'state_id' => $data['state_id'],
                        'district_id' => $data['district_id'],
                        'pin' => $data['pin'],
                        'street' => $data['street'],
                        'updated_at' => now()
                    ]
                );


                if (!$success) {
                    throw new \Exception("Failed to insert student_address_details");
                }
                DB::commit();
                return $id;
            } elseif ($table === 'document') {
                $is_submitted = 1;
                $ch = DB::table('students')->where('id', $id)->select('registration_no')->first();
                if ($ch && $ch->registration_no != null) {
                    DB::table('students')
                        ->where('id', $id)
                        ->update([
                            'registration_no' => $data['registration_no']
                        ]);
                }
                DB::table('students')
                    ->where('id', $id)
                    ->update([
                        'registration_no' => $data['registration_no'],
                        'photo' => $data['photo'],
                        'signature' => $data['signature'],
                        'is_submitted' => $is_submitted,
                        'updated_at' => now()
                    ]);

                DB::commit();
                return $id;
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Details Update failed', ['error' => $e->getMessage()]);
            throw new \Exception("Failed to update student basic details record.");
        }
    }


    // --------------------------------------------------------------------------------------------------------
    public static function forget_updatePassword($email, $password)
    {
        DB::beginTransaction();
        $updated = DB::table('students')
            ->where('email', $email)
            ->update(['password' => $password]);
        DB::commit();

        return $updated;
    }
}
    // --------------------------------------------------------------------------------------------------------
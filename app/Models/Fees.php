<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Fees extends Model
{
    use HasFactory;
    protected $table = "fees_heads";
    protected $primaryKey = "id";
    public function states()
    {
        return $this->hasMany(State::class);
    }
    public static function getAllFeesType()
    {

        return DB::table('fees_heads')->get();
    }

    public static function getAllSemesters()
    {

        return DB::table('semesters')->get();
    }


    public static function getFeesDataForEdit($id)
    {
        $query = DB::table('fees_details')->where('fees_structure_id', $id)->get();
        return $query;
    }


    public static function feesStructure()
    {
        return DB::table('fees_structure')->orderBy('id')->get();
    }
    public static function getAmount($fees_structure_id)
    {
        // Log::info("In the getAmount model function");
        $result = DB::table('fees_structure')
            ->where('id', $fees_structure_id)
            ->value('total_amount');

        return $result;
    }

    public static function forSchedule($academic_id, $semester_id, $specialization_id)
    {
        $fees_structure = DB::table('fees_structure')
            ->where('academic_id', $academic_id)
            ->where('semester_id', $semester_id)
            ->where('course_id', $specialization_id)
            ->select('total_amount', 'id')
            ->first();

        if ($fees_structure) {
            $fees_payment_schedule = DB::table('fees_payment_schedule')
                ->where('fees_structure_id', $fees_structure->id)
                ->select('start_date', 'end_date', 'extended_date', 'late_fine', 'description')
                ->first();

            return [
                'total_amount'   => $fees_structure->total_amount,
                'start_date'     => $fees_payment_schedule->start_date ?? null,
                'end_date'       => $fees_payment_schedule->end_date ?? null,
                'extended_date'  => $fees_payment_schedule->extended_date ?? null,
                'late_fine'      => $fees_payment_schedule->late_fine ?? null,
                'description'    => $fees_payment_schedule->description ?? null,
            ];
        }

        return [
            'total_amount'   => null,
            'start_date'     => null,
            'end_date'       => null,
            'extended_date'  => null,
            'late_fine'      => null,
            'description'    => null,
        ];
    }


    public static function getPaymentSchedule($fees_structure_id)
    {
        $result = DB::table('fees_payment_schedule as fp')
            ->leftJoin('fees_structure as fs', 'fp.fees_structure_id', '=', 'fs.id')
            ->select('fp.*', 'fs.total_amount as total_amount')
            ->where('fp.fees_structure_id', $fees_structure_id)
            ->first();
        return $result;
    }


    // ======================================= Making new fees schedule ==========================================================================

    public static function schedulePayment($validatedData)
    {
        Log::info("From the model schedulwPAyemnt");
        $fees_structure_id = $validatedData['fees_structure_id'];
        Log::info("fees_structure_id: ", (array) $fees_structure_id);

        if ($fees_structure_id) {
            $dataToUpdate = [
                'start_date' => $validatedData['start_date'],
                'end_date' => $validatedData['end_date'],
            ];

            if (empty($validatedData['extended_date'])) {
                $dataToUpdate['extended_date'] = null;
            }

            if (!empty($validatedData['extended_date'])) {
                $dataToUpdate['extended_date'] = $validatedData['extended_date'];
            }

            if (empty($validatedData['late_fine'])) {
                $dataToUpdate['late_fine'] = null;
            }
            if (!empty($validatedData['late_fine'])) {
                $dataToUpdate['late_fine'] = $validatedData['late_fine'];
            }
            if (empty($validatedData['description'])) {
                $dataToUpdate['description'] = null;
            }
            if (!empty($validatedData['description'])) {
                $dataToUpdate['description'] = $validatedData['description'];
            }

            return DB::table('fees_payment_schedule')->updateOrInsert(
                ['fees_structure_id' => $fees_structure_id],
                $dataToUpdate
            );
        }

        return 0;
    }




    // ======================================= Retriving all fees structure for listing ==========================================================================

    public static function getAllFeesDetails()
    {
        $query = DB::table('fees_structure as fs')
            ->leftJoin('semesters as sem', 'fs.semester_id', '=', 'sem.id')
            ->leftJoin('academics as acd', 'fs.academic_id', '=', 'acd.id')
            ->leftJoin('specializations as sp', 'fs.course_id', '=', 'sp.id')
            ->leftJoin('fees_details as fd', 'fs.id', '=', 'fd.fees_structure_id')
            ->leftJoin('fees_heads as fh', 'fd.fees_head_id', '=', 'fh.id')
            ->select(
                'fs.id',
                'fs.total_amount',
                'acd.name as academic_year',
                'sp.name as course_name',
                'sem.name as semester_name',
                DB::raw("MAX(CASE WHEN fh.name = 'tuition' THEN fd.amount END) AS `tuition`"),
                DB::raw("MAX(CASE WHEN fh.name = 'library' THEN fd.amount END) AS `library`"),
                DB::raw("MAX(CASE WHEN fh.name = 'exam' THEN fd.amount END) AS `exam`"),
                DB::raw("MAX(CASE WHEN fh.name = 'admission' THEN fd.amount END) AS `admission`")
            );

        $result = $query
            ->groupBy('fs.id', 'fs.total_amount', 'acd.name', 'sp.name', 'sem.name')
            ->orderByDesc('fs.id');
        return $result;
    }
    // public static function getAllFeesDetailsPdf($id)
    // {
    //     return DB::table('fees_structure as fs')
    //         ->leftJoin('semesters as sem', 'fs.semester_id', '=', 'sem.id')
    //         ->leftJoin('academics as acd', 'fs.academic_id', '=', 'acd.id')
    //         ->leftJoin('specializations as sp', 'fs.course_id', '=', 'sp.id')
    //         ->leftJoin('fees_details as fd', 'fs.id', '=', 'fd.fees_structure_id')
    //         ->leftJoin('fees_heads as fh', 'fd.fees_head_id', '=', 'fh.id')
    //         ->where('fs.id', $id)
    //         ->select(
    //             'fs.id',
    //             'fs.total_amount',
    //             'acd.name as academic_year',
    //             'sp.name as course_name',
    //             'sem.name as semester_name',
    //             DB::raw("MAX(CASE WHEN fh.name = 'tuition' THEN fd.amount END) AS `tuition`"),
    //             DB::raw("MAX(CASE WHEN fh.name = 'library' THEN fd.amount END) AS `library`"),
    //             DB::raw("MAX(CASE WHEN fh.name = 'exam' THEN fd.amount END) AS `exam`"),
    //             DB::raw("MAX(CASE WHEN fh.name = 'admission' THEN fd.amount END) AS `admission`")
    //         )
    //         ->groupBy('fs.id', 'fs.total_amount', 'acd.name', 'sp.name', 'sem.name')
    //         ->orderByDesc('fs.id')
    //         ->first(); // 👈 returns just one row
    // }

    // ======================================= Retriving fees structure details for pdf ==========================================================================
    public static function getAllFeesDetailsPdf($id)
    {

        $fees_structure = DB::table('fees_structure as fs')
            ->leftJoin('semesters as sm', 'fs.semester_id', '=', 'sm.id')
            ->leftJoin('academics as a', 'fs.academic_id', '=', 'a.id')
            ->leftJoin('specializations as sp', 'fs.course_id', '=', 'sp.id')
            ->where('fs.id', $id)->select(
                'fs.id as fees_structure_id',
                'fs.structure_name as structure_name',
                'sp.name as course',
                'sm.name as semester',
                'a.name as academic',
                'fs.total_amount as total_amount'
            )
            ->first(); // taking the only one record that has respective fees_structure_id
        $fees_heads = DB::table('fees_heads')->select('name', 'id')->get(); // taking all the fees heads name and id
        $fees_head_structure = DB::table('fees_details')
            ->where('fees_structure_id', $id)
            ->select('fees_head_id', 'amount', 'fees_structure_id')
            ->get();

        return [
            'fees_structure' => $fees_structure,
            'fees_heads' => $fees_heads,
            'fees_head_structure' => $fees_head_structure
        ];
    }

    // ======================================= Updating fees structure ==========================================================================
    public static function adminFeesEdit($id)
    {
        $fees_structure = DB::table('fees_structure')->where('id', $id)->select('course_id', 'semester_id', 'academic_id')->first();
        $fees_details = DB::table('fees_details')->where('fees_structure_id', $id)->get();
        Log::info("Data from fees details table: ", (array) $fees_details);
        Log::info("Data from fees_structure table: ", (array) $fees_structure);
        return [
            'fees_structure' => $fees_structure,
            'fees_details' => $fees_details,
        ];
    }
    // ======================================= Addmin new fees structure ==========================================================================

    public static function makeNewFeesStructure($validatedData)
    {
        try {
            Log::info('In the makeNewFeesStructure model class');

            $existing = DB::table('fees_structure')->where([
                ['academic_id', '=', $validatedData['academic_id']],
                ['course_id', '=', $validatedData['specialization_id']],
                ['semester_id', '=', $validatedData['semester_id']]
            ])->first();

            if ($existing) {
                Log::info('Fees structure exist!');
                return 0;
            } else {
                $academic_name = DB::table('academics')->where('id', $validatedData['academic_id'])->value('name');
                $course_name = DB::table('specializations')->where('id', $validatedData['specialization_id'])->value('name');
                $semester_name = DB::table('semesters')->where('id', $validatedData['semester_id'])->value('name');
                $structure_name = $academic_name . " " . $course_name . " " . $semester_name . " " . "SEM";
                $fees_structure_id = DB::table('fees_structure')->insertGetId([
                    'academic_id' => $validatedData['academic_id'],
                    'course_id' => $validatedData['specialization_id'],
                    'semester_id' => $validatedData['semester_id'],
                    'structure_name' => $structure_name,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            foreach ($validatedData['fees_head_id'] as $key => $fees_head_id) {
                $amount = $validatedData['amount'][$key];

                DB::table('fees_details')->updateOrInsert(
                    [
                        'fees_structure_id' => $fees_structure_id,
                        'fees_head_id' => $fees_head_id,
                    ],
                    [
                        'amount' => $amount,
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }

            $total_amount = DB::table('fees_details')
                ->where('fees_structure_id', $fees_structure_id)
                ->sum('amount');
            Log::info('$total_amount', (array) $total_amount);

            $id = DB::table('fees_structure')->where('id', $fees_structure_id)->update(['total_amount' => $total_amount]);
            Log::info('$id', (array) $id);
            DB::commit();
            return $id;
        } catch (\Exception $e) {
            Log::error('Exception: ', ['error_message' => $e->getMessage()]);
            DB::rollBack();
            return 0;
        }
    }

    // ======================================= making new fes structure ==========================================================================
    public static function makeFeesStructure($validatedData)
    {
        try {
            Log::info('In the makeFeesStructure model class');

            $existing = DB::table('fees_structure')->where([
                ['academic_id', '=', $validatedData['academic_id']],
                ['course_id', '=', $validatedData['specialization_id']],
                ['semester_id', '=', $validatedData['semester_id']]
            ])->first();

            if ($existing) {
                $fees_structure_id = $existing->id;
            } else {
                $fees_structure_id = DB::table('fees_structure')->insertGetId([
                    'academic_id' => $validatedData['academic_id'],
                    'course_id' => $validatedData['specialization_id'],
                    'semester_id' => $validatedData['semester_id'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            foreach ($validatedData['fees_head_id'] as $key => $fees_head_id) {
                $amount = $validatedData['amount'][$key];

                DB::table('fees_details')->updateOrInsert(
                    [
                        'fees_structure_id' => $fees_structure_id,
                        'fees_head_id' => $fees_head_id,
                    ],
                    [
                        'amount' => $amount,
                        'updated_at' => now(),
                        'created_at' => now()
                    ]
                );
            }

            $total_amount = DB::table('fees_details')
                ->where('fees_structure_id', $fees_structure_id)
                ->sum('amount');
            Log::info('$total_amount', (array) $total_amount);

            $id = DB::table('fees_structure')->where('id', $fees_structure_id)->update(['total_amount' => $total_amount]);
            Log::info('$id', (array) $id);
            DB::commit();
            return $id;
        } catch (\Exception $e) {
            Log::error('Exception: ', ['error_message' => $e->getMessage()]);
            DB::rollBack();
            return 0;
        }
    }



    // ======================================= ==========================================================================
    public static function getFees($filters)
    {
        $query = DB::table('fees_structure as fs')
            ->leftJoin('semesters as sem', 'fs.semester_id', '=', 'sem.id')
            ->leftJoin('academics as acd', 'fs.academic_id', '=', 'acd.id')
            ->leftJoin('specializations as sp', 'fs.course_id', '=', 'sp.id')
            ->leftJoin('fees_details as fd', 'fs.id', '=', 'fd.fees_structure_id')
            ->leftJoin('fees_heads as fh', 'fd.fees_head_id', '=', 'fh.id')
            ->select(
                'fs.id',
                'fs.total_amount',
                'acd.name as academic_year',
                'sp.name as course_name',
                'sem.name as semester_name',
                DB::raw("MAX(CASE WHEN fh.name = 'tuition' THEN fd.amount END) AS `tuition`"),
                DB::raw("MAX(CASE WHEN fh.name = 'library' THEN fd.amount END) AS `library`"),
                DB::raw("MAX(CASE WHEN fh.name = 'exam' THEN fd.amount END) AS `exam`"),
                DB::raw("MAX(CASE WHEN fh.name = 'admission' THEN fd.amount END) AS `admission`")
            );

        // Apply Filters
        if (isset($filters['id']) && filled($filters['id'])) {
            $query->where('fs.id', $filters['id']);
        }
        if (isset($filters['course_id']) && filled($filters['course_id'])) {
            $query->where('fs.course_id', $filters['course_id']);
        }
        if (isset($filters['academic_id']) && filled($filters['academic_id'])) {
            $query->where('fs.academic_id', $filters['academic_id']);
        }
        if (isset($filters['semester_id']) && filled($filters['semester_id'])) {
            $query->where('fs.semester_id', $filters['semester_id']);
        }

        if (isset($filters['search_term']) && filled($filters['search_term'])) {
            $term = '%' . $filters['search_term'] . '%';

            $query->havingRaw('
                academic_year LIKE ? OR 
                course_name LIKE ? OR 
                semester_name LIKE ? OR 
                total_amount LIKE ? OR 
                tuition LIKE ? OR 
                library LIKE ? OR 
                exam LIKE ? OR 
                admission LIKE ?
            ', [$term, $term, $term, $term, $term, $term, $term, $term]);
        }

        return $query
            ->groupBy('fs.id', 'fs.total_amount', 'acd.name', 'sp.name', 'sem.name')
            ->orderByDesc('fs.id');
    }

    // ======================================= Retriving fees heads by the admin ==========================================================================
    public static function getAllFeesHead()
    {
        $result = DB::table('fees_heads')->orderByDesc('id');
        // dd($result);
        return $result;
    }

    // ======================================= searching fees heads by the admin ==========================================================================
    public static function searchFeesHead($filters)
    {
        $query = DB::table('fees_heads')
            ->select('id', 'name', 'description');

        if (isset($filters) && filled($filters)) {
            $term = '%' . $filters . '%';

            $query->where(function ($q) use ($term) {
                $q->where('id', 'LIKE', $term)
                    ->orWhere('name', 'LIKE', $term)
                    ->orWhere('description', 'LIKE', $term);
            });
        }

        return $query->orderByDesc('id');
    }

    // ======================================= Adding new fees Heads by the admin ==========================================================================
    public static function addNewFeesHead($validatedData)
    {
        return DB::table('fees_heads')->insert([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
        ]);
    }

    // ======================================= Delete fees heads by the admin ==========================================================================
    public static function deleteFeesHead($id)
    {
        Log::info("delete id: ", (array) $id);
        return DB::table('fees_heads')
            ->where('id', $id)
            ->delete();
    }

    // ======================================= Updating Fees heads by the admin ==========================================================================

    public static function updateFeesHead($id, $validatedData)
    {
        Log::info("Updated fees id: ", (array) $id);
        return DB::table('fees_heads')
            ->where('id', $id)
            ->update($validatedData);
    }

    // ======================================= Retriving student payment details by the studnet ==========================================================================


    public static function getStudentPaymentDetails($id)
    {
        try {
            $student = DB::table('students as s')
                ->select('specialization_id_opt as course_id', 'academic_id', 'semester_id')
                ->where('s.id', $id)
                ->first();

            if ($student) {
                $academic_id = $student->academic_id;
                $course_id = $student->course_id;

                $fees_structure_records = DB::table('fees_structure')
                    ->where('academic_id', $academic_id)
                    ->where('course_id', $course_id)
                    ->select('id')
                    ->get();

                $existing_ids = [];

                foreach ($fees_structure_records as $record) {
                    $fees_structure_id = $record->id;

                    $exists = DB::table('fees_payment_schedule')
                        ->where('fees_structure_id', $fees_structure_id)
                        ->exists();

                    if ($exists) {
                        $existing_ids[] = $fees_structure_id;
                    }
                }

                if (!empty($existing_ids)) {
                    $schedule_records = DB::table('fees_payment_schedule as fp')
                        ->join('fees_structure as fs', 'fs.id', '=', 'fp.fees_structure_id')
                        ->join('semesters as sm', 'sm.id', '=', 'fs.semester_id')
                        ->leftjoin('payment_table as pt', 'pt.fees_structure_id', '=', 'fs.id')
                        ->whereIn('fp.fees_structure_id', $existing_ids)
                        ->select(
                            'fp.id as fees_payment_schedule_id',
                            'fp.start_date',
                            'fp.end_date',
                            'fp.extended_date',
                            'fp.late_fine',
                            'fs.id as fees_structure_id',
                            'fs.academic_id',
                            'fs.course_id',
                            'fs.semester_id',
                            'sm.name as semester_name',
                            'fs.total_amount',
                            'pt.id as payment_table_id',
                            'pt.payment_date as payment_date'
                        )->orderBy('sm.id')
                        ->get();

                    // dd($schedule_records);
                    return $schedule_records;
                }
            } else {
                return 0;
            }
        } catch (\Exception $e) {
            Log::error('Basic details Update failed', ['error' => $e->getMessage()]);
            throw new \Exception("Failed to retrive payment schedule records.");
        }
    }

    // ======================================= Storing data in the payment_table and payment_details table by the student ==========================================================================

    public static function studentPayFeesSubmit($validatedData)
    {
        $payment_table_id = DB::table('payment_table')->insertGetId([
            'student_id' => $validatedData['student_id'],
            'fees_structure_id' => $validatedData['fees_structure_id'],
            'total_amount' => $validatedData['total_amount'],
            'payment_date' => $validatedData['payment_date'],
            'reciept_number' => $validatedData['reciept_number']
        ]);
        if ($payment_table_id) {
            $fees_heads = DB::table('fees_details')->select('fees_head_id', 'amount')->where('fees_structure_id', $validatedData['fees_structure_id'])->orderBy('fees_head_id')->get();

            if ($fees_heads->isNotEmpty()) {
                foreach ($fees_heads as $head) {
                    $fees_details_id = DB::table('payment_details')->insertGetId([
                        'payment_table_id' => $payment_table_id,
                        'fees_head_id' => $head->fees_head_id,
                        'amount' => $head->amount,
                    ]);
                }

            $late_fine = DB::table('fees_payment_schedule')->where('fees_structure_id', $validatedData['fees_structure_id'])->value('late_fine');
            $fees_head_id_late_fine = DB::table('fees_heads')->where('name',"late_fine")->value('id');
            if($late_fine){
                $fees_details_id = DB::table('payment_details')->insertGetId([
                        'payment_table_id' => $payment_table_id,
                        'fees_head_id' => $fees_head_id_late_fine,
                        'amount' => $validatedData['late_fine']
                    ]);
            }

                return $fees_details_id;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
        return 0;
    }


    public static function generatePaymentRecieptnNo()
    {
        $year = date('Y');
        $lastPayment = DB::table('payment_table')->where('reciept_number', 'like', "PR{$year}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($lastPayment) {
            $lastNumber = (int)substr($lastPayment->reciept_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        Log::info("PR{$year}{$newNumber}");
        return "PR{$year}{$newNumber}";
    }



    public static function downloadFeesReciept($validatedData)
    {
        Log::info("Validated data: ", (array) $validatedData);
        $fee = DB::table('payment_table as pt')
            ->join('payment_details as pd', 'pt.id', '=', 'pd.payment_table_id')
            ->join('fees_structure as fs', 'pt.fees_structure_id', '=', 'fs.id')
            ->join('students as s', 'pt.student_id', '=', 's.id')
            ->join('degrees as d', 's.degree_id_opt', '=', 'd.id')
            ->join('specializations as sp', 's.specialization_id_opt', '=', 'sp.id')
            ->join('semesters as sm', 'fs.semester_id', '=', 'sm.id')
            ->join('academics as a', 'fs.academic_id', '=', 'a.id')
            ->select(
                'pt.student_id as student_id',
                'pt.id as payment_table_id',
                'pt.total_amount as total_amount',
                'pt.payment_date as payment_date',
                'pt.reciept_number as reciept_number',
                's.fname as fname',
                's.lname as lname',
                's.mobile as mobile',
                'd.name as degree',
                'sp.name as specialization',
                'a.name as academic',
                'sm.name as semester'
            )
            ->where('pt.fees_structure_id', $validatedData['fees_structure_id'])
            ->where('pt.student_id', $validatedData['student_id'])
            ->first();
        if ($fee) {
            $payment_table_id = $fee->payment_table_id;
            $heads = DB::table('payment_details as pd')
                ->join('fees_heads as fh', 'pd.fees_head_id', '=', 'fh.id')
                ->select(
                    'fh.name',
                    'pd.amount'
                )
                ->where('pd.payment_table_id', $payment_table_id)
                ->get();

                        $data = [
            'fee' => $fee,
            'heads' => $heads
        ];
        return $data;
        } else {
            return 0;
        }
        return 0;
    }
}

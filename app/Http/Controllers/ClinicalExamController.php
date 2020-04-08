<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ClinicalExam;
use Illuminate\Support\Carbon;

class ClinicalExamController extends Controller
{

    public  $fliter = [

        'children_id' => "required|exists:childrens,id",
        'doctor_id' => "required|exists:tags,id",
        'date' => 'required|date_format:"Y-m-d"',
        'case' => 'required|max:300'


    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error' => false, "data" => ClinicalExam::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), $this->fliter);
        if ($validator->passes()) {
            $clinicalExam = new ClinicalExam();
            $clinicalExam->children_id = $request->input("children_id");
            $clinicalExam->doctor_id = $request->input("doctor_id");
            $clinicalExam->date = Carbon::parse($request->input("date"))->format('Y-m-d');
            $clinicalExam->case = $request->input("case");
            $clinicalExam->save();
            return response()->json([
                'error' => 0, "data" => $clinicalExam
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ], $this->badRequest);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request["id"] = $id;
        $this->fliter[] = ['id' => "exists:clinical_exams,id"];
        $validator = Validator::make($request->all(), $this->fliter);

        if ($validator->passes()) {
            $clinicalExam = ClinicalExam::where("id", $id)->first();
            $clinicalExam->children_id = $request["children_id"];
            $clinicalExam->doctor_id = $request["doctor_id"];
            $clinicalExam->date = Carbon::parse($request->input("date"))->format('Y-m-d');
            $clinicalExam->case = $request->input("case");

            $clinicalExam->save();



            return response()->json([
                'error' => 0
            ]);
        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ], $this->badRequest);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!is_numeric($id))
            return respose()->json(['error' => true], $this->badRequest);
        ClinicalExam::where('id', $id)->delete();
        return response()->json([
            'error' => 0
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ClinicalExam;

class ClinicalExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false ,"data"=>ClinicalExam::get()]);
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

        $validator = Validator::make($request->all(), [

            'children_id'=>"required|exists:childrens,id",
            'doctor_id'=>"required|exists:doctors,id",

        ]);
        if ($validator->passes()) {
            $clinicalExam= new ClinicalExam();
            $clinicalExam->children_id=$request->input("children_id");
            $clinicalExam->doctor_id=$request->input("doctor_id");
            $clinicalExam->save();
            return response()->json([
                'error'=>0,"data"=>$clinicalExam
            ]);
        }
        else{
            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ]);

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
        $request["id"]=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:clinical_exams,id",
            'children_id'=>"required|exists:childrens,id",
            'doctor_id'=>"required|exists:doctors,id",
        ]);

        if ($validator->passes()) {
            $clinicalExam = ClinicalExam::where("id",$id )->first();
            $clinicalExam->children_id = $request["children_id"];
            $clinicalExam->doctor_id = $request["doctor_id"];
            $clinicalExam->save();



            return response()->json([
                'error' => 0
            ]);
        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ]);
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
        return respose()->json(['error'=>true]);
        ClinicalExam::where('id',$id)->delete();
        return response()->json([
            'error' => 0
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Doctor;

class DoctorController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return response()->json(['error'=>false , "data" => Doctor::get()]);

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
        $validator = Validator::make($request->all(),
         [
            'name'=>'required|unique:doctors|max:100',
            'specialization'=>'required|max:100'
        ]);

        if ($validator->passes()) {
         $savedDate= Doctor::create($request->all());
        return response()->json([
                'error' => 0 ,"data"=> $savedDate
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
        if ( !is_numeric($id))
         return response()->json(['error'=>true]);
        $doctor = Doctor::where('id',$id)->first();
        if ( $doctor == null ) return response()->json(['error'=>true]);
        else
        return response()->json(['error'=>false, "data"=> $doctor]);
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
            'name' => 'required|string|max:191',
            'specialization' => 'required|string|max:191',
            
        ]);

        if ($validator->passes()) {
            $doctor = Doctor::find($id);
            $doctor->name= $request->input("name");
            $doctor->specialization = $request->input("specialization");
             $doctor->save();

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
    public function destroy($id)    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           Doctor::where('id',$id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

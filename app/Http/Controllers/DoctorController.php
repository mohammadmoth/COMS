<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Doctor;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
        $validatedData = $request->validate([
            'name'=>['required','unique:doctors','max:100'],
            'specialization'=>['required','max:100']
        ]);

        if ($validator->passes()) {
         $savedDate= Doctor::create($validatedData);  
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
        $doctor = $doctors::where('id',$id)->first();
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
        if ( !is_numeric($id)){
            $request->input["id"]=$id;
            $validator = $request->validate([
                'id'=>['exists:doctorss','id'],
                'name'=>['required','string'],
                'specialization'=>['required','string'],
                ]);
                if($validator->passes()){
                    $doctor=Doctor::where("id",$id )->first();
                    $doctor->name=$request->input("name");
                    $doctor->specialization=$request->input("specialization");
                    $doctor->save();

                    return response()->json([
                        'error' => 0
                    ]);
                
                }
                else {

                    return response()->json([
                        'error' => 1,
                        'data' => $validator->errors()
                            ->all()
                    ]);

    
            }
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


           Doctor::whereId('id',$id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

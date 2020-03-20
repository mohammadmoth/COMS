<?php

namespace App\Http\Controllers;
use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => Family::get()]);

    }

    


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($reques->all(),[
            'husband'=>'required|string|max:100',
            'wife'=>'required|string|max:100',
            'national_id'=>'required|numeric',
            'family_card_id'=>'required|numeric',
            'mobile'=>'required|numeric',
            'economic_status'=>'required|string',
            'previous_resident_address'=>'string',
            'current_resident_address'=>'string',
        ]);
        if($validator->pases()){
            $family = new Family();
            $family->husband=$requset->input('husband');            
            $family->wife=$requset->input('wife');
            $family->national_id=$requset->input('national_id');
            $family->family_card_id=$requset->input('family_card_id');
            $family->mobile=$requset->input('mobile');
            $family->economic_status=$requset->input('economic_status');
            $family->previous_resident_address=$requset->input('previous_resident_address');
            $family->current_resident_address=$requset->input('current_resident_address');
            $family->save();
            return response()->json([
                'error' => 0 ,"data"=> $family
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
        if (!is_numeric($id)) 
            return response()->json(['error'=>true]);
        $family=Family::where('id', $id)->first();
        if ( $family == null ) return response()->json(['error'=>true]);
        else
        return response()->json(['error'=>false, "data"=> $family]);
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
        
        $validator = Validator::make($reques->all(),[
            'husband'=>'required|string|max:100',
            'wife'=>'required|string|max:100',
            'national_id'=>'required|numeric',
            'family_card_id'=>'required|numeric',
            'mobile'=>'required|numeric',
            'economic_status'=>'required|string',
            'previous_resident_address'=>'string',
            'current_resident_address'=>'string',
        ]);

        if($validator->passes()){
            $family->husband=$request->input("husband");
            $family->wife=$request->input("wife");
            $family->national_id=$request->input("national_id");
            $family->family_card_id=$request->input("family_card_id");
            $family->mobile=$request->input("mobile");
            $family->economic_status=$request->input("economic_status");
            $family->previous_resident_address=$request->input("previous_resident_address");
            $family->current_resident_address=$request->input("current_resident_address");
            $family->save();
            return response()->json([
                'error' => 0
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           Family::where('Id',$id)->delete();

            return response()->json([
                'error' => 0
            ]);
    }
}

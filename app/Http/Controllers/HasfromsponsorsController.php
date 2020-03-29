<?php

namespace App\Http\Controllers;

use App\hasfromsponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class HasfromsponsorsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => hasfromsponsors::get()]);

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

            'id_child'=>"exists:childrens,id",
            'id_sponsor' =>"exists:tags,id",
            'startsopnser'=>'required|date_format:"Y-m-d"',
            "endsponosor"=>'required|date|after:startsopnser',
   

        ]);

        if ($validator->passes()) {
            $hasfromsponsors = new hasfromsponsors();
            $hasfromsponsors->id_child = $request->input("id_child");
            $hasfromsponsors->id_sponsor = $request->input("id_sponsor");
            $hasfromsponsors->startsopnser =Carbon::parse($request->input("startsopnser"))->format('Y-m-d');
            $hasfromsponsors->endsponosor = Carbon::parse($request->input("endsponosor"))->format('Y-m-d'); 
           
            $hasfromsponsors->save();

                    return response()->json([
                        'error' => 0 ,"data"=> $hasfromsponsors
                    ]);



        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ],$this->badRequest);
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hasfromsponsors  $hasfromsponsors
     * @return \Illuminate\Http\Response
     */
    public function show(hasfromsponsors $hasfromsponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true],$this->badRequest);
         $hasfromsponsor = $hasfromsponsors->whereId($id)->first();

           if ( $hasfromsponsor == null ) return response()->json(['error'=>true] ,$this->badRequest);
            else
           return response()->json(['error'=>false, "data"=> $hasfromsponsor]);
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hasfromsponsors  $hasfromsponsors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hasfromsponsors $hasfromsponsors , $id)
    {
        $request->id=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:hasfromsponsors,id",
            'id_child'=>"exists:childrens,id",
            'id_sponsor' =>"exists:tags,id",
            'startsopnser'=>'required|date_format:"Y-m-d"',
            "endsponosor"=>'required|date|after:startsopnser',
       

        ]);

        if ($validator->passes()) {
            $hasfromsponsors = $hasfromsponsors->whereId($id )->first();
            $hasfromsponsors->id_child = $request->input("id_child");
            $hasfromsponsors->id_sponsor = $request->input("id_sponsor");
            $hasfromsponsors->startsopnser = $request->input("startsopnser");
            $hasfromsponsors->endsponosor = $request->input("endsponosor");
     
            $hasfromsponsors->save();

            return response()->json([
                'error' => 0
            ]);
        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ],$this->badRequest);
        }

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hasfromsponsors  $hasfromsponsors
     * @return \Illuminate\Http\Response
     */
    public function destroy(hasfromsponsors $hasfromsponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true] ,$this->badRequest);


           $hasfromsponsors->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

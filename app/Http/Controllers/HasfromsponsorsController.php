<?php

namespace App\Http\Controllers;

use App\hasfromsponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function __construct()
    {
        $this->middleware('auth');
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

            'id_child'=>"exists:childrens,id",
            'id_sponsor' =>"exists:tags,id",
            'startsopnser'=>'required|date_format:m/d/Y|after_or_equal:'.date('m/d/Y'),
            "startend"=>'required|date|after:startsopnser',
            'extradata' => 'required',

        ]);

        if ($validator->passes()) {
            $hasfromsponsors = new hasfromsponsors();
            $hasfromsponsors->id_child = $request->input("id_child");
            $hasfromsponsors->id_sponsor = $request->input("id_sponsor");
            $hasfromsponsors->startsopnser = $request->input("startsopnser");
            $hasfromsponsors->startsopnser = $request->input("startend");
            $hasfromsponsors->startsopnser = $request->input("extradata");
            $hasfromsponsors->save();

                    return response()->json([
                        'error' => 0 ,"data"=> $hasfromsponsors
                    ]);



        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ]);
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
        return response()->json(['error'=>true]);
         $hasfromsponsor = $hasfromsponsors->whereId($id)->first();

           if ( $hasfromsponsor == null ) return response()->json(['error'=>true]);
            else
           return response()->json(['error'=>false, "data"=> $hasfromsponsor]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hasfromsponsors  $hasfromsponsors
     * @return \Illuminate\Http\Response
     */
    public function edit(hasfromsponsors $hasfromsponsors)
    {


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
        $request->input["id"]=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:hasfromsponsors,id",
            'id_childrens'=>"exists:childrens,id",
            'id_sponsor' =>"exists:tags,id",
            'startsopnser'=>'required|date_format:m/d/Y|after_or_equal:'.date('m/d/Y'),
            "startend"=>'required|date|after:startsopnser',
            'extradata' => 'required',

        ]);

        if ($validator->passes()) {
            $hasfromsponsors = $hasfromsponsors->whereId("id",$id );
            $hasfromsponsors->id_child = $request->input("id_childrens");
            $hasfromsponsors->id_sponsor = $request->input("id_sponsor");
            $hasfromsponsors->startsopnser = $request->input("startsopnser");
            $hasfromsponsors->startsopnser = $request->input("startend");
            $hasfromsponsors->startsopnser = $request->input("extradata");
            $hasfromsponsors->save();

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
        return response()->json(['error'=>true]);


           $hasfromsponsors->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

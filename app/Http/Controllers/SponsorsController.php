<?php

namespace App\Http\Controllers;

use App\Sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorsController extends Controller
{

    /// filter
    public $filter = [

        'firstname' => 'required|string|max:191',
        'lastname' => 'required|string|max:191',
        'mobilephone' => 'required|numeric',
        'phone' => 'required|numeric',
        'typesponsor' => 'required|string|max:191',
        'idnumber' => 'required|max:191',
        'tags_id' => 'nullable|exists:tags,id',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => Sponsors::get()]);

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

        $validator = Validator::make($request->all(),$this->filter );

        if ($validator->passes()) {
            $sponsors = new Sponsors();
            $sponsors->firstname = $request->input("firstname");
            $sponsors->lastname = $request->input("lastname");
            $sponsors->mobilephone = $request->input("mobilephone");
            $sponsors->phone = $request->input("phone");
            $sponsors->typesponsor = $request->input("typesponsor");
            $sponsors->idnumber = $request->input("idnumber");
            $sponsors->tags_id = $request->input("tags_id");

            $sponsors->save();
            return response()->json([
                'error' => 0 ,"data"=> $sponsors
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
     * @param  \App\Sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsors $sponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true],$this->badRequest);
         $sponsor = $sponsors->whereId($id)->first();

        if ( $sponsor == null ) return response()->json(['error'=>true],$this->badRequest);
        else
        return response()->json(['error'=>false, "data"=> $sponsor]);
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->id=$id;
        $filter= $this->filter;
        $filter[]= ['id' => 'nullable|exists:sponsors,id'];
        $validator = Validator::make($request->all(),$filter);

        if ($validator->passes()) {
            $sponsors =  Sponsors::whereId($id)->first();
            $sponsors->firstname = $request->input("firstname");
            $sponsors->lastname = $request->input("lastname");
            $sponsors->mobilephone = $request->input("mobilephone");
            $sponsors->phone = $request->input("phone");
            $sponsors->typesponsor = $request->input("typesponsor");
            $sponsors->idnumber = $request->input("idnumber");
            $sponsors->tags_id = $request->input("tags_id");



            $sponsors->save();
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
     * @param  \App\Sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsors $sponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true],$this->badRequest);


           $sponsors->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

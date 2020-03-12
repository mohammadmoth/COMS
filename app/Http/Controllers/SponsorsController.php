<?php

namespace App\Http\Controllers;

use App\sponsors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SponsorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => sponsors::get()]);

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

            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'mobilephone' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'infoSponser' => 'required',
        ]);

        if ($validator->passes()) {
            $sponsors = new sponsors();
            $sponsors->firstname = $request->input("firstname");
            $sponsors->lastname = $request->input("lastname");
            $sponsors->mobilephone = $request->input("mobilephone");
            $sponsors->phone = $request->input("phone");
            $sponsors->infoSponser = $request->input("infoSponser");


            $sponsors->save();
            return response()->json([
                'error' => 0 ,"data"=> $sponsors
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
     * @param  \App\sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function show(sponsors $sponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);
         $sponsor = $sponsors->whereId($id)->first();

           if ( $sponsor == null ) return response()->json(['error'=>true]);
            else
           return response()->json(['error'=>false, "data"=> $sponsor]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function edit(sponsors $sponsors)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sponsors $sponsors)
    {
        $validator = Validator::make($request->all(), [

            'firstname' => 'required|string|max:191',
            'lastname' => 'required|string|max:191',
            'mobilephone' => 'required|string|max:191',
            'phone' => 'required|string|max:191',
            'infoSponser' => 'required',
        ]);

        if ($validator->passes()) {
            $sponsors = new sponsors();
            $sponsors->firstname = $request->input("firstname");
            $sponsors->lastname = $request->input("lastname");
            $sponsors->mobilephone = $request->input("mobilephone");
            $sponsors->phone = $request->input("phone");
            $sponsors->infoSponser = $request->input("infoSponser");


            $sponsors->save();
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
     * @param  \App\sponsors  $sponsors
     * @return \Illuminate\Http\Response
     */
    public function destroy(sponsors $sponsors , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           $sponsors->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

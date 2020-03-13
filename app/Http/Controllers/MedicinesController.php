<?php

namespace App\Http\Controllers;

use App\medicines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MedicinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => medicines::get()]);

        //
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

            'id_childrens'=>"exists:childrens,id",
            'nameTag' =>"exists:tags,id",
            'extradata' => 'required',

        ]);

        if ($validator->passes()) {
            $medicines = new medicines();
            $medicines->id_childrens = $request->input("id_childrens");
            $medicines->nameTag = $request->input("nameTag");
            $medicines->extradata = $request->input("extradata");

                    $medicines->save();

                    return response()->json([
                        'error' => 0 ,"data"=> $medicines
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
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function show(medicines $medicines , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);
         $medicine = $medicines->whereId($id)->first();

           if ( $medicine == null ) return response()->json(['error'=>true]);
            else
           return response()->json(['error'=>false, "data"=> $medicine]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function edit(medicines $medicines)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medicines $medicines , $id)
    {
        $request->input["id"]=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:medicines,id",
            'id_childrens'=>"exists:childrens,id",
            'nameTag' =>"exists:tags,id",
            'extradata' => 'required',

        ]);

        if ($validator->passes()) {
            $medicines = $medicines->whereId("id",$id );
            $medicines->id_childrens = $request->input("id_childrens");
            $medicines->nameTag = $request->input("nameTag");
            $medicines->extradata = $request->input("extradata");

            $medicines->save();
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
     * @param  \App\medicines  $medicines
     * @return \Illuminate\Http\Response
     */
    public function destroy(medicines $medicines , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           $medicines->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

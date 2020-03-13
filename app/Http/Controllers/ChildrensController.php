<?php

namespace App\Http\Controllers;

use App\Childrens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ChildrensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => Childrens::get()]);

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

            'firstname'=>"required|string",
            'lastname' =>"required|string",
            'mothername'=>"required|string",
            "father"=>"required|string",
            'mobilephone' => 'required',
            'phone' => 'required',
            'birthplace' => 'required',
            'birthday' => 'required|date_format:m/d/Y|before_or_equal:'.date('m/d/Y'),
            'extradata' => 'required|json',

        ]);

        if ($validator->passes()) {
            $Childrens = new Childrens();
            $Childrens->firstname = $request->input("firstname");
            $Childrens->lastname = $request->input("lastname");
            $Childrens->mothername = $request->input("mothername");
            $Childrens->father = $request->input("father");
            $Childrens->mobilephone = $request->input("mobilephone");

            $Childrens->phone = $request->input("phone");

            $Childrens->birthplace = $request->input("birthplace");
            $Childrens->birthday = $request->input("birthday");
            $Childrens->extradata = $request->input("extradata");

            $Childrens->save();

                    return response()->json([
                        'error' => 0 ,"data"=> $Childrens
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
     * @param  \App\Childrens  $Childrens
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,Childrens $Childrens ,$id )
    {
        $request["id"] = $id ;
        $validator = Validator::make($request->all(), [
            'id' => 'exists:childrens,id',
        ]);

        if ($validator->passes()) {

            return response()->json(['error'=>false, "data"=>$Childrens->whereId($request->id)->first()]);
        }
        else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ]);

            }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Childrens  $Childrens
     * @return \Illuminate\Http\Response
     */
    public function edit(Childrens $Childrens)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Childrens  $Childrens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Childrens $Childrens , $id)
    {
        $request->input["id"]=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:childrens,id",
            'firstname'=>"required|string",
            'lastname' =>"required|string",
            'mothername'=>"required|string",
            "father"=>"required|string",
            'mobilephone' => 'required',
            'phone' => 'required',
            'birthplace' => 'required',
            'birthday' => 'required|date_format:m/d/Y|before_or_equal:'.date('m/d/Y'),
            'extradata' => 'required|json',


        ]);

        if ($validator->passes()) {
            $Childrens = $Childrens->whereId("id",$id );
            $Childrens->firstname = $request->input("firstname");
            $Childrens->lastname = $request->input("lastname");
            $Childrens->mothername = $request->input("mothername");
            $Childrens->father = $request->input("father");
            $Childrens->mobilephone = $request->input("mobilephone");

            $Childrens->phone = $request->input("phone");

            $Childrens->birthplace = $request->input("birthplace");
            $Childrens->birthday = $request->input("birthday");
            $Childrens->extradata = $request->input("extradata");


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
     * @param  \App\Childrens  $Childrens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Childrens $Childrens , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           $Childrens->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

<?php

namespace App\Http\Controllers;

use App\children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => children::get()]);

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
            $children = new children();
            $children->firstname = $request->input("firstname");
            $children->lastname = $request->input("lastname");
            $children->mothername = $request->input("mothername");
            $children->father = $request->input("father");
            $children->mobilephone = $request->input("mobilephone");

            $children->phone = $request->input("phone");

            $children->birthplace = $request->input("birthplace");
            $children->birthday = $request->input("birthday");
            $children->extradata = $request->input("extradata");

            $children->save();

                    return response()->json([
                        'error' => 0 ,"data"=> $children
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
     * @param  \App\children  $children
     * @return \Illuminate\Http\Response
     */
    public function show(children $children , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);
         $child = $children->whereId($id)->first();

           if ( $child == null ) return response()->json(['error'=>true]);
            else
           return response()->json(['error'=>false, "data"=> $child]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\children  $children
     * @return \Illuminate\Http\Response
     */
    public function edit(children $children)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\children  $children
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, children $children , $id)
    {
        $request->input["id"]=$id;
        $validator = Validator::make($request->all(), [
            'id'=>"exists:children,id",
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
            $children = $children->whereId("id",$id );
            $children->firstname = $request->input("firstname");
            $children->lastname = $request->input("lastname");
            $children->mothername = $request->input("mothername");
            $children->father = $request->input("father");
            $children->mobilephone = $request->input("mobilephone");

            $children->phone = $request->input("phone");

            $children->birthplace = $request->input("birthplace");
            $children->birthday = $request->input("birthday");
            $children->extradata = $request->input("extradata");


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
     * @param  \App\children  $children
     * @return \Illuminate\Http\Response
     */
    public function destroy(children $children , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           $children->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);

        //
    }
}

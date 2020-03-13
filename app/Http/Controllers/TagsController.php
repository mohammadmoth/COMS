<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\tags;
use Hamcrest\Type\IsNumeric;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error'=>false , "data" => tags::get()]);

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

            'name' => 'required|string|max:191',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->passes()) {
            $tags = new tags();
            $tags->name = $request->input("name");
            $tags->type = $request->input("type");
            $tags->save();
            return response()->json([
                'error' => 0 , "data"=> $tags
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
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(tags $tags , $id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);
         $tag = $tags->whereId($id)->first();

           if ( $tag == null ) return response()->json(['error'=>true]);
            else
           return response()->json(['error'=>false, "data"=> $tag]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function edit(tags $tags)
    {


        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tags $tags)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'type' => 'required|string|max:255',
        ]);

        if ($validator->passes()) {
            $tags =  $tags->where("id" ,  $request->input("id"));
            $tags->name = $request->input("name");
            $tags->type = $request->input("type");
            $tags->save();
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
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(tags $tags ,$id)
    {
        if ( !is_numeric($id))
        return response()->json(['error'=>true]);


           $tags->whereId( $id)-> delete();

            return response()->json([
                'error' => 0
            ]);


        //
    }
}

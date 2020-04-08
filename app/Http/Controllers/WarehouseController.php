<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Warehouses;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{

    public  $fliter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error' => false, "data" => Warehouses::get()]);
    }
    public function __construct()
    {
        $this->fliter = [

            'tags_id' => "required|exists:tags,id",
            'countofwares' => "required|numeric",
            'date' => 'required|date_format:"Y-m-d"',
            'inputoutput' =>  [
                'required', 'string', 'max:255',
                Rule::in(["input", "output"]),
            ],
            'numberwarehouse' => "required|numeric",
        ];
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

        $validator = Validator::make($request->all(), $this->fliter);
        if ($validator->passes()) {
            $Warehouses = new Warehouses();
            $Warehouses->tags_id = $request->input("tags_id");
            $Warehouses->countofwares = $request->input("countofwares");
            $Warehouses->date = Carbon::parse($request->input("date"))->format('Y-m-d');
            $Warehouses->inputoutput = $request->input("inputoutput");
            $Warehouses->numberwarehouse = $request->input("numberwarehouse");
            $Warehouses->save();
            return response()->json([
                'error' => 0, "data" => $Warehouses
            ]);
        } else {
            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ], $this->badRequest);
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
        $request["id"] = $id;
        $this->fliter[] = ['id' => "exists:clinical_exams,id"];
        $validator = Validator::make($request->all(), $this->fliter);

        if ($validator->passes()) {
            $Warehouses = Warehouses::where("id", $id)->first();
            $Warehouses->tags_id = $request->input("tags_id");
            $Warehouses->countofwares = $request->input("countofwares");
            $Warehouses->date = Carbon::parse($request->input("date"))->format('Y-m-d');
            $Warehouses->inputoutput = $request->input("inputoutput");
            $Warehouses->numberwarehouse = $request->input("numberwarehouse");

            $Warehouses->save();



            return response()->json([
                'error' => 0
            ]);
        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ], $this->badRequest);
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
        if (!is_numeric($id))
            return respose()->json(['error' => true], $this->badRequest);
        Warehouses::where('id', $id)->delete();
        return response()->json([
            'error' => 0
        ]);
    }
}

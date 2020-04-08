<?php

namespace App\Http\Controllers;

use App\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FamilyController extends Controller
{

    public $fliter = [
        'husband' => 'max:191|required_without_all:wife',
        'wife' => 'max:191|required_without_all:husband',
        'national_id' => 'required|string|max:191',
        'family_card_id' => 'required|string|max:191',
        'mobile' => 'required|string',
        'economic_status' => 'required|string',
        'previous_resident_address' => 'nullable|string',
        'current_resident_address' => 'string',
        'count' => 'required|numeric'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['error' => false, "data" => Family::get()]);
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
            $family = new Family();
            $family->husband = $request->input('husband',null );
            $family->wife = $request->input('wife' ,null);
            $family->national_id = $request->input('national_id');
            $family->family_card_id = $request->input('family_card_id');
            $family->mobile = $request->input('mobile');
            $family->economic_status = $request->input('economic_status');
            $family->previous_resident_address = $request->input('previous_resident_address');
            $family->current_resident_address = $request->input('current_resident_address');
            $family->count = $request->input('count');

            $family->save();
            return response()->json([
                'error' => 0, "data" => $family
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
        if (!is_numeric($id))
            return response()->json(['error' => true], $this->badRequest);
        $family = Family::where('id', $id)->first();
        if ($family == null) return response()->json(['error' => true], $this->badRequest);
        else
            return response()->json(['error' => false, "data" => $family]);
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
        $Family = new Family();
        $request["id"] = $id;
        $this->fliter[] = ['id' => "exists:clinical_exams,id"];
        $validator = Validator::make($request->all(), $this->fliter);

        if ($validator->passes()) {
            $family = $Family->whereId($request->id)->first();
            $family->husband = $request->input('husband');
            $family->wife = $request->input('wife');
            $family->national_id = $request->input('national_id');
            $family->family_card_id = $request->input('family_card_id');
            $family->mobile = $request->input('mobile');
            $family->economic_status = $request->input('economic_status');
            $family->previous_resident_address = $request->input('previous_resident_address');
            $family->current_resident_address = $request->input('current_resident_address');
            $family->count = $request->input('count');
            $family->save();
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
            return response()->json(['error' => true], $this->badRequest);


        Family::where('Id', $id)->delete();

        return response()->json([
            'error' => 0
        ]);
    }
}

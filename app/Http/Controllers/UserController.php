<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Controllers\Auth\AuthExtend as Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'rules' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->errorStatus);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }


    public function index()
    {
        return response()->json(['error' => false, "data" => User::get()]);

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

        return $this->register($request);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $User, $id)
    {
        if (!is_numeric($id))
            return response()->json(['error' => true] , $this->errorStatus);
        $user = $User->whereId($id)->first();

        if ($user == null) return response()->json(['error' => true] , $this->errorStatus);
        else
            return response()->json(['error' => false, "data" => $user]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'email' => 'email',            
        ]);

        if ($validator->passes()) {
        
            $user =  $User->where("id",  $request->input("id"))->first();
            if ($request->has("name"))
            $user->name = $request->input("name");
            if ($request->has("email"))
            $user->email = $request->input("email");
            if ($request->has("rules"))
            $user->rules = $request->input("rules");

            if ($request->has("passowrd"))
            $user->passowrd =bcrypt ( $request->input("passowrd"));

            $user->save();
            return response()->json([
                'error' => 0
            ]);
        } else {

            return response()->json([
                'error' => 1,
                'data' => $validator->errors()
                    ->all()
            ] ,$this->errorStatus);
        }

        //
    }
       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $tags
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
         $User = new User();
        if (!is_numeric($id))
            return response()->json(['error' => true] , $this->errorStatus);


        $User->whereId($id)->delete();

        return response()->json([
            'error' => 0
        ]);


        //
    }
}

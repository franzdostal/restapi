<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:3',
        );
        $data = $request->all();
        $v = Validator::make($data, $rules);

        if( ! $v->passes() ) {

            return [
                'success' => false,
                'response' => $v->errors()
            ];
        }

        $data['email_token'] = md5(time());
        User::create($data);

        return [
            'success' => true,
            'activation_token' => $data['email_token']
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 
        
        if(!$user) {
            return response('Not found', 404);
        } else {
            return $user;
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $user->delete();

            return json_encode(['success' => 'user deleted']);
        }

        return response('Not found', 404);
    }

    public function emailVerification(Request $request, $token) 
    {
        $user = User::where('email_token', '=', $token)->first();
        if(!$user) {
            return response('Not found', 404);
        } else {
            // removing token , so system knows that this user is verefied
            $user->email_token = '';
            $user->save();

            return json_encode(['success' => 'user was veryfied']);
        }        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->session()->has('token')){
            return redirect('/admin/dashboard');
        }
        return view('auth.login');
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
        //
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
        //
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            $response = Http::post(config('app.api_url') . '/auth/signin', [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);
            $result = $response->json();
            if ($result['message'] == 'Ok.') {
                session(['token' => $result['data']['token']]);
                $user = Http::withHeaders([
                    'Authorization' =>  $result['data']['token']
                ])->get(config('app.api_url') . '/user/profile');
                $userdata = $user->json();
                session(['username'=>$userdata['data']['username']]);
                return redirect('/admin/dashboard');
            }else{
                return redirect()->back()->with('error','wrong email or password');
            }
        }
    }

    public function logout(Request $request)
    {
        if($request->session()->has('token')){
            session()->flush();
            return redirect("/login");
        }
    }
}

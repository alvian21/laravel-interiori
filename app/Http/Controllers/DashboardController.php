<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = session('token');
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->get(config('app.api_url') . '/user');
        $result = $response->json();
        if ($result['message'] == 'Ok.') {
            $data = $result['data'];
            $user = [];
            $designer = [];
            foreach ($data as $row) {

                if ($row['role'] == 'user') {
                    $x['id'] = $row['id'];
                    array_push($user, $x);
                }

                if ($row['role'] == 'designer') {
                    $x['id'] = $row['id'];
                    array_push($designer, $x);
                }
            }
        }
        return view('admin.dashboard.index', ['user' => count($user), 'designer' => count($designer)]);
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
}

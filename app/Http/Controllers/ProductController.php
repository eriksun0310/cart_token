<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = DB::table('products')->get();
        // $data = DB::table('sbl_team_data')
        // ->join('sbl_teams', function($join){
        //     $join->on('sbl_teams.id','=','sbl_team_data.team_id')
        //         ->where('sbl_teams.total_win', '>', '200');
        // })
        // ->select('*')
        // ->get();
        // $data = $data->addSelect('season')->get();
        return response($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd(11111);
        $data = $this->getData();
        $newData = $request->all();
        // array的用法
        // array_push($data, $newData);
        // collect的用法
        $data->push(collect($newData));
        return response($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

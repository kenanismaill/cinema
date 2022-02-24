<?php

namespace App\Http\Controllers\Api\v1\Cinema;

use App\Http\Controllers\Controller;
use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{

    public function index(Request $request)
    {
        $cinemas = Cinema::with('city')->paginate($request->has('per_page') ? $request->get('per_page') : 20);

        return response()->json($cinemas);
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Cinema $cinema)
    {
        //
    }


    public function update(Request $request, Cinema $cinema)
    {
        //
    }


    public function destroy(Cinema $cinema)
    {
        //
    }
}

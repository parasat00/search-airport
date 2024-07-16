<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function __invoke(Request $request)
    {
        $list = Airport::whereRaw('LOWER(city_name->"$.en") like ?', '%'.strtolower($request->name).'%')
                        ->orWhereRaw('LOWER(city_name->"$.ru") like ?', '%'.strtolower($request->name).'%')
                        ->orWhereRaw('LOWER(airport_name->"$.en") like ?', '%'.strtolower($request->name).'%')
                        ->orWhereRaw('LOWER(airport_name->"$.ru") like ?', '%'.strtolower($request->name).'%')
                        ->get();
        return response()->json($list, 200);
    }
}

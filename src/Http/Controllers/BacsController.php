<?php

namespace LaravelBacs\LaravelBacs\Http\Controllers;

use Illuminate\Http\Request;
use LaravelBacs\LaravelBacs\Messages\VOL;

class BacsController
{
    public function index(Request $request)
    {
        validator($request->query(), [
            'serial_number' => 'string|required|max:6',
            'sun' => 'sometimes|string|max:6',
            'marker' => 'sometimes|string|max:4',
        ])->validate();

        return response()->json([
            'vol' => VOL::fromRequest($request),
        ]);
    }
}

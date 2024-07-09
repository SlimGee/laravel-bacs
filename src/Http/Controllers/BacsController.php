<?php

namespace LaravelBacs\LaravelBacs\Http\Controllers;

use Illuminate\Http\Request;
use LaravelBacs\LaravelBacs\Messages\HDR1;
use LaravelBacs\LaravelBacs\Messages\VOL;

class BacsController
{
    public function index(Request $request)
    {
        validator($request->query(), [
            'serial_number' => 'string|required|size:6',
            'sun' => 'sometimes|string|size:6',
            'marker' => 'sometimes|string|max:4',
            'generation_number' => 'sometimes|integer|digits:4',
            'generation_version_number' => 'sometimes|integer|digits:2',
            'creation_date' => 'sometimes|date_format:Y-m-d',
            'expiration_date' => 'sometimes|date_format:Y-m-d',
            'system_code' => 'sometimes|string|size:13',
            'fast_payment' => 'sometimes|boolean',
        ])->validate();

        $vol = VOL::fromRequest($request);
        $hdr = HDR1::fromRequest($request, $vol);

        return response()->json(compact(
            'vol',
            'hdr',
        ));
    }
}

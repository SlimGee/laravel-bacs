<?php

namespace LaravelBacs\LaravelBacs\Messages;

use Illuminate\Http\Request;

class VOL
{
    /**
     * Create VOL record from request get params
     */
    public static function fromRequest(Request $request): string
    {
        return implode([
            'VOL',
            '1',
            $request->query('serial_number'),
            '0',
            str_pad('', 20, ' '),
            $request->has('sun') ? str_pad('', 6, ' ') : strtoupper($request->query('marker', 'HSBC')).str_pad('', 2, ' '),
            str_pad('', 4, ' '),
            $request->has('sun') ? $request->query('sun') : str_pad('', 6, ' '),
            str_pad('', 4, ' '),
            str_pad('', 28, ' '),
            '1',
        ]);
    }
}

<?php

namespace LaravelBacs\LaravelBacs\Messages;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HDR1
{
    /**
     * Create HDR1 record from request
     */
    public static function fromRequest(Request $request, string $vol): string
    {
        if ($request->query('fast_payment', '0') == '1' || ! $request->has(['creation_date', 'expiration_date'])) {
            $creation_date = now();
            $expiration_date = now();
        } else {
            $expiration_date = Carbon::parse($request->query('expiration_date'));
            $creation_date = Carbon::parse($request->query('creation_date'));
        }

        return implode([
            'HDR',
            '1',
            'A',
            substr($vol, 41, 5),
            'S',
            str_pad('', 2, ' '),
            '1',
            substr($vol, 41, 5),
            substr($vol, 4, 6),
            '0001',
            '0001',
            $request->query('generation_number', str_pad('', 4, ' ')),
            $request->query('generation_version_number', str_pad('', 2, ' ')),
            $creation_date->format(' y').str_pad((string) $creation_date->dayOfYear, 3, '0', STR_PAD_LEFT),
            $expiration_date->format(' y').str_pad((string) $expiration_date->dayOfYear, 3, '0', STR_PAD_LEFT),
            '0',
            str_pad('', 6, '0'),
            $request->query('system_code', Str::random(13)),
            str_pad('', 7, ' '),
        ]);
    }
}

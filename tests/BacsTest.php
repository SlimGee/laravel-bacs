<?php

use Illuminate\Support\Str;

it('can validate when request is made without required params', function () {
    $response = $this->getJson('/api/bacs');

    $response->assertStatus(422);
});

it('can return valid message response', function () {
    $response = $this->getJson('/api/bacs?'.http_build_query([
        'serial_number' => Str::random(6),
        'sun' => Str::random(6),
        'marker' => 'HSBC',
    ]));

    $response->assertStatus(200);
});

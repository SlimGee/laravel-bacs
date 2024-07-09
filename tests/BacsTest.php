<?php

use Illuminate\Support\Str;

use function Pest\Laravel\getJson;

it('can validate when request is made without required params', function () {
    getJson('/api/bacs')->assertStatus(422);
});

it('can return valid message response', function () {
    getJson('/api/bacs?' . http_build_query([
        'serial_number' => Str::random(6),
        'sun' => Str::random(6),
        'marker' => 'HSBC',
        'generation_number' => rand(1000, 9999),
        'generation_version_number' => rand(10, 99),
        'creation_date' => now()->format('Y-m-d'),
        'expiration_date' => now()->addDays(21)->format('Y-m-d'),
        'system_code' => Str::random(13),
    ]))->assertStatus(200);
});

it('can return valid vol and hdr1 when fast payment is marked as false', function () {
    $serial = Str::upper(Str::random(6));
    $sun = Str::upper(Str::random(6));
    $creation_at = now()->addYears(5);
    $expiration_at = now()->addYears(5)->addDays(21);

    $creation_at_assert = $creation_at->format('y') . str_pad(
        (string) $creation_at->dayOfYear, 3, '0', STR_PAD_LEFT
    );

    $expiration_at_assert = $expiration_at->format('y') . str_pad(
        (string) $expiration_at->dayOfYear, 3, '0', STR_PAD_LEFT
    );

    getJson('/api/bacs?' . http_build_query([
        'serial_number' => $serial,
        'sun' => $sun,
        'marker' => 'HSBC',
        'generation_number' => rand(1000, 9999),
        'generation_version_number' => rand(10, 99),
        'creation_date' => $creation_at->format('Y-m-d'),
        'expiration_date' => $expiration_at->format('Y-m-d'),
        'system_code' => Str::random(13),
        'fast_payment' => false,
    ]))
        ->assertStatus(200)
        ->assertSee('VOL')
        ->assertSee('HDR')
        ->assertSee($sun)
        ->assertSee($serial)
        ->assertSee($expiration_at_assert)
        ->assertSee($creation_at_assert);
});

it('can return valid vol and hdr1 when fast payment is marked as true', function () {
    $serial = Str::upper(Str::random(6));
    $sun = Str::upper(Str::random(6));
    $creation_at = now()->addYears(5);
    $expiration_at = now()->addYears(5)->addDays(21);

    $creation_at_assert = now()->format('y') . str_pad(
        (string) now()->dayOfYear, 3, '0', STR_PAD_LEFT
    );

    $expiration_at_assert = now()->format('y') . str_pad(
        (string) now()->dayOfYear, 3, '0', STR_PAD_LEFT
    );

    getJson('/api/bacs?' . http_build_query([
        'serial_number' => $serial,
        'sun' => $sun,
        'marker' => 'HSBC',
        'generation_number' => rand(1000, 9999),
        'generation_version_number' => rand(10, 99),
        'creation_date' => $creation_at->format('Y-m-d'),
        'expiration_date' => $expiration_at->format('Y-m-d'),
        'system_code' => Str::random(13),
        'fast_payment' => true,
    ]))
        ->assertStatus(200)
        ->assertSee('VOL')
        ->assertSee('HDR')
        ->assertSee($sun)
        ->assertSee($serial)
        ->assertSee($expiration_at_assert)
        ->assertSee($creation_at_assert);
});

it('can return records with defined marker', function () {
    $marker = ['hsbc', 'sage'][rand(0, 1)];

    getJson('/api/bacs?' . http_build_query([
        'serial_number' => Str::random(6),
        'marker' => $marker,
        'generation_number' => rand(1000, 9999),
        'generation_version_number' => rand(10, 99),
        'creation_date' => now()->format('Y-m-d'),
        'expiration_date' => now()->addDays(21)->format('Y-m-d'),
        'system_code' => Str::random(13),
    ]))
        ->assertStatus(200)
        ->assertSee(strtoupper($marker));
});

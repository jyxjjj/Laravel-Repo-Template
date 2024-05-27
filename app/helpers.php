<?php /** @noinspection PhpUnused */

use Illuminate\Support\Carbon;

function getRequestTime(): Carbon
{
    return Carbon::createFromFormat('U.u', LARAVEL_START)->setTimezone(config('app.timezone'));
}

function parseFromDateTime(string $datetime): Carbon
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $datetime, config('app.timezone'));
}

function parseISO8601Variant(string $datetime): Carbon
{
    return Carbon::createFromFormat('Y-m-d\TH:i:s.up', $datetime)->setTimezone(config('app.timezone'));
}

function isUpperHexString(?string $string): bool
{
    return !is_null($string) && (strtoupper($string) == $string) && ctype_xdigit($string);
}

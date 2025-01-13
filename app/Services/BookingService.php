<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Sleep;


class BookingService
{
    public function callApi($url, $sleepDuration): Array|string
    {
        Sleep::for($sleepDuration)->seconds();
        try {
            return Http::get($url)->json();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}

<?php
namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Url;

class UrlService {
    public function shorten(String $originalUrl): Url {
        do{
            $code = Str::random(6);
        }while(Url::where("short_code", $code)->exists());

        return Url::create([
            "original_url" => $originalUrl,
            "short_code" => $code
        ]);
    }
}
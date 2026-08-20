<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Services\UrlService;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function store(Request $request) {
        $request->validate(
            ["url"=>"required|url|max:2048"],
            ["url.required"=>"A URL é obrigatória"],
            ["url.url"=>"A URL deve ser um link válido (ex: www.meusite.com)"],
            ["url.max"=>"A URL deve ter no máximo 2048 caracteres"]
        );

        $url = UrlService::shorten($request->url);
        
        return response()->json([
            'id' => $url->id,
            'original' => $url->original_url,
            'shortened' => url('/' . $url->short_code)
        ]);

    }

    public function redirect($code) {
        $url = Url::where('short_code', $code)->firstOrFail();
        $url->increment('clicks');

        return redirect($url->original_url);
    }
}

<?php

namespace App\Http\Controllers;

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

        $urlService = new UrlService();
        $url = $urlService->shorten($request->url);
        
        return response()->json([
            'id' => $url->id,
            'original' => $url->original_url,
            'shortened' => url('/' . $url->short_code)
        ]);

    }
}

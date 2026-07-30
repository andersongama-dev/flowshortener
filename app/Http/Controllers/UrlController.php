<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function shorten(Request $request) {
        $request->validate(
            ["url"=>"required|url|max:2048"],
            ["url.required"=>"A URL é obrigatória"],
            ["url.url"=>"A URL deve ser um link válido (ex: www.meusite.com)"],
            ["url.max"=>"A URL deve ter no máximo 2048 caracteres"]
        );

        

    }
}

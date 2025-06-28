<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromRequest
{

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header("Accept-Language");

        if (in_array($locale, ["uz", "ru"])) {
            App::setlocale($locale);
        } else {
            App::setlocale(config("app.locale"));
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(isset($_COOKIE['logado']))
        {
            $cookie = json_decode($_COOKIE['logado']);
            session()->put('imagem', str_replace('public/profiles', 'storage/profiles', $cookie->imagem));
            session()->put('id', $cookie->id);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
/**
 * Middleware nay dung de chuyen doi Ngon ngu bang cach ghi nho trong Session
 * Middleware nay can register trong Kernel.php tai group Middle la web thi moi hoat dong.
 * Chua biet ly do vi sao nhung co the lien quan den Auth
 */
class GetCurrentLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(!session()->exists('currentLang')){
            $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            $lang = in_array($lang,['vi','en','de','fr'])?$lang:'en';
            session()->put('currentLang',$lang); // mac dinh la ngon ngu cua browser do Laravel truyen vao
        }
        
        App::setLocale(session('currentLang')); 
        //dump(session()->all());
        return $next($request);
    }
}

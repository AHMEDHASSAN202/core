<?php


use Closure;
use App;

class ApiLocalization
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
        $language = $request->header('Accept-Language');
        \Modules\Core\Http\Middleware\config()->set('app.locale', $language);
        App::setLocale($language);
        return $next($request);
    }
}

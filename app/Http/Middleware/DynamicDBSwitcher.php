<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DynamicDBSwitcher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (request()->has('th')) {
            session()->put('th', request('th'));
        }

        if (session()->has('th')) {
            $themeId = session('th');
            $theme = \Modules\Theme\Entities\Theme::find($themeId)->name ?? \Modules\Theme\Entities\Theme::where('is_active', 1)->value('name') ?? 'classic';

            $theme = strtoupper($theme);
            if ($theme === 'GAZETTE' || $theme === 'FASHION') {
                config(['database.default' => strtolower($theme)]);
            } else {
                config(['database.default' => 'mysql']);
            }
        } 

        return $next($request);
    }
}

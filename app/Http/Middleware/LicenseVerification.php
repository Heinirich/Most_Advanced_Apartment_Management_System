<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class LicenseVerification
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
        return $next($request);
       
        
        $response = Http::get('http://127.0.0.1:8000/api/licencechecker',[
            'license' => Bam_Setting()->license_key,
            'domain' => $request->getSchemeAndHttpHost(),
        ]);

        
        $body = $response->body();
        $body = json_decode($body,true);
        // dd($body['success']);
        if($body['success'] == false && !$request->routeIs('admin.settings.*')){
            admin_warning('Warning', 'Kindly verify your license keys.');
            return \Redirect::to('/admin/settings');
        }
            //!$request->is('admin/auth/setting')
        return $next($request);
        
        

       
       
    }
}

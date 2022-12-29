<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        
        admin_warning('Warning', 'Please change your password.');
        $response = Http::get('http://127.0.0.1:8000/api/licencechecker',[
            'license' => 'Taylor',
            'domain' => 1,
        ]);

        if($response['success'] == true){
            return redirect()->url('/register');
        }else{
            //!$request->is('admin/auth/setting')
            return 124;
        }
        

       
        return $next($request);
    }
}

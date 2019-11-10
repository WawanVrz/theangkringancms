<?php

namespace App\Http\Middleware;

use Closure;

use App\SysSetting;

class SystemSetting
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
        $website = session('sys_setting_website', 0);
    	$sys_setting = SysSetting::where('active','1')->where('website_id',$website)->get();
        session(['sys_setting_website' => $website]);

    	foreach($sys_setting as $ss) config(['sys_data.setting.'.$ss->key => $ss->value]);

        return $next($request);
    }
}

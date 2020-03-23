<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
class Admin
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
       
        $user = Session::get('login_detail');
           
         
        if (!isset($user)) {
            $remember = Cookie::get('login_detail');
           
            if (isset($remember) and ! empty($remember)) {
                $data = \App\User::where('remember_token',$remember)->first();
                $login = array(
                    'login_id'=>$data->id,
                    'login_email'=>$data->email, 
                    'login_name'=>$data->first_name.' '.$data->last_name,
                    'login_group'=>$data->group_id,
                    'profile_pic'=>$data->profile_image
                    
                );
               Session::put('login_detail', $login);
               $user = $remember;
            }
        }

        if(isset($user)){
          
        return $next($request);
      }
        return redirect('login');
    }
}

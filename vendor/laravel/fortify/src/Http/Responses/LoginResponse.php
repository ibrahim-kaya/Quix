<?php

namespace Laravel\Fortify\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        if($request->wantsJson()) return response()->json(['two_factor' => false]);
        else
        {
           if($request->url) return redirect($request->url);
           else return redirect()->intended(config('fortify.home'));
        }

        /*return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(config('fortify.home'));*/
    }
}

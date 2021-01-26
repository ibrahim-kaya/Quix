<?php

namespace App\Http\Middleware\UserKontrol;

use App\Models\Quiz;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostEditKontrol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $postid = $request->route()->parameters()['quizler'];
        if(Auth::user()->type !== 'admin' && Quiz::where('uniqueid', $postid)->get()->first()->olusturan_id != Auth::user()->id){
            return redirect()->route('anasayfa')->withErrors('Bu Quiz\'i sen oluşturmamışsın!');
        }
        return $next($request);
    }
}

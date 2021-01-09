<?php

namespace App\Http\Middleware\UserKontrol;

use App\Models\Quiz;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

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
        if(auth()->user()->type !== 'admin' && Quiz::find($postid)->olusturan_id != auth()->user()->id){
            return redirect()->route('dashboard')->withErrors('Bu Quiz\'i sen oluşturmamışsın!');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SayfaController extends Controller
{
    public function credits($sayfa)
    {
        if($sayfa === '')
        {

        }
        else
        {
            return view('credits.resimler');
        }
    }
}

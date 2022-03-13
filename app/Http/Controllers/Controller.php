<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function lang(Request $request)
    {
        $lang = $request->all()['lang'];
        if (! in_array($lang, ['en', 'hy', 'ru'])) {
            abort(400);
        }

        session()->put('lang',$lang);
        App::setLocale(session()->get('lang'));

        return redirect()->back();
    }
}

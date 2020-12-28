<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Config;
use Modules\Clicks\Entities\Click;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function success($idClick)
    {
        $click = Click::find($idClick);

        return view('success', [
            'click' => $click
        ]);
    }

    public function error($idClick)
    {
        $click = Click::find($idClick);

        return view('error', [
            'redirect_url' => Config::get('clicks.redirect_url'),
            'click' => $click
        ]);
    }

}



<?php

namespace Modules\Clicks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Clicks\Entities\Click;

class ClicksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $clicks = Click::all();

        return response()->json($clicks->toArray());
    }

}

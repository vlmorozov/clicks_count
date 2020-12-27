<?php

namespace Modules\Clicks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Clicks\Http\Requests\ClickRequest;
use Modules\Clicks\Entities\BadDomain;
use Modules\Clicks\Entities\Click;

class ClickController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ClickRequest $request)
    {
        $data = [
            'ua' => \request()->userAgent(),
            'ip' => \request()->ip(),
            'ref' => \request()->headers->get('HTTP_REFERER') ?? '',
            'param1' => $request->get('param1'),
            'param2' => $request->get('param2'),
        ];

        $click = Click::where('ua', $data['ua'])
            ->where('ip', $data['ip'])
            ->where('ref', $data['ref'])
            ->where('param1', $data['param1'])
            ->first();

        if ($click) {
            $click->increment('error');
            $click->save();
        } else {
            $click = new Click();
            if (BadDomain::where(['name' => $data['ref']])->first()) {
                $data['error'] = 1;
            }
            $click->fill($data);
            $click->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('clicks::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('clicks::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('clicks::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

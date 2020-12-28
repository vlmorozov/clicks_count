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

        $referer = \request()->headers->get('referer') ?? '';
        $parseReferer = parse_url($referer);

        $data = [
            'ua' => \request()->userAgent(),
            'ip' => \request()->ip(),
            'ref' => $parseReferer['host'] ?? '',
            'param1' => $request->get('param1'),
            'param2' => $request->get('param2'),
        ];

        $preClick = new Click($data);

        $clickInDb = Click::where('id', $preClick->id)->first();

        $hasError = false;

        if ($badDomain = BadDomain::where(['name' => $data['ref']])->first()) {
            $hasError = true;
        }

        if ($clickInDb) {
            $clickInDb->bad_domain = $badDomain ? 1 : 0;
            $clickInDb->increment('error');
            $clickInDb->save();
            $hasError = true;
        } else {
            $clickInDb = new Click();
            if ($badDomain) {
                $data['error'] = 1;
                $data['bad_domain'] = 1;
            }
            $clickInDb->fill($data);
            $clickInDb->save();
        }

        if ($hasError) {
            return redirect(route('error', ['idClick' => $clickInDb->id]));
        } else {
            return redirect(route('success', ['idClick' => $clickInDb->id]));
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

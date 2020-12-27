<?php

namespace Modules\Clicks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Clicks\Entities\BadDomain;

class BadDomainsController extends Controller
{

    public function index()
    {
        $domains = BadDomain::all();

        return response()->json($domains->toArray());
    }

    public function store(Request $request)
    {
        $domainName = $request->post('domain');

        $domain = BadDomain::firstOrCreate(['name' => $domainName]);


        return response()->json([
            'data' => $domain
        ]);
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

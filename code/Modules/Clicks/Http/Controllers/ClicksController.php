<?php

namespace Modules\Clicks\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Clicks\Entities\Click;
use Modules\Clicks\Http\Requests\ClicksRequest;

class ClicksController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(ClicksRequest $request)
    {

        $searchColumns = [
            0 => 'id',
            1 => 'ua',
            2 => 'ip',
            3 => 'ref',
            4 => 'param1',
            5 => 'param2',
            6 => 'error',
            7 => 'bad_domain',
        ];

        $builder = Click::query()
            ->when($request->input('search.value'), function ($query, $searchValue) {
                return $query
                    ->where('id', 'like', '%' . $searchValue . '%')
                    ->orWhere('ua', 'like', '%' . $searchValue . '%')
                    ->orWhere('ip', 'like', '%' . $searchValue . '%')
                    ->orWhere('ref', 'like', '%' . $searchValue . '%')
                    ->orWhere('param1', 'like', '%' . $searchValue . '%')
                    ->orWhere('param2', 'like', '%' . $searchValue . '%');
            });

        $recordsTotal = Click::all()->count();
        $recordsFiltered = $builder->count();

        $clicks = $builder->orderBy($searchColumns[$request->input('order.0.column')] ?? 'id', $request->input('order.0.dir'))
            ->offset($request->get('start'))
            ->limit($request->get('length'))
            ->get();


        return response()->json([
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $clicks->toArray()
        ]);
    }

}

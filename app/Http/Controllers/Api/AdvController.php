<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\DataProvider;
use App\Http\Requests\AdvRequest;
use App\Http\Resources\AdvCollection;
use App\Http\Resources\AdvResource;
use App\Models\Adv;
use Illuminate\Http\Request;

class AdvController extends Controller
{
    use DataProvider;
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage =  $request->per_page ?? 10;

        $query = Adv::select('id', 'name', 'price', 'description', 'images', 'created_at');

        $result = $this->prepareModel($request, $query)->paginate((int) $perPage);

        return new AdvCollection($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvRequest $request)
    {
        $adv = Adv::create($request->all());
        return response()->json(['data'=> $adv], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return new AdvResource(Adv::find($id));
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\HolidayService;
use Illuminate\Http\Request;

class HolidayController extends ApiController
{

    public function __construct(HolidayService $modelService)
    {
        parent::__construct($modelService);
    }

    public function index(Request $request)
    {
        return $this->modelService->load($request->get('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        //
    }

}

<?php

namespace App\Http\Controllers;

use App\Services\PayTypeService;
use Illuminate\Http\Request;

class PayTypeController extends Controller
{
    public function __construct(PayTypeService $modelService)
    {
        parent::__construct($modelService);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PayType  $payType
     * @return \Illuminate\Http\Response
     */
    public function show(PayType $payType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayType  $payType
     * @return \Illuminate\Http\Response
     */
    public function edit(PayType $payType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PayType  $payType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayType $payType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayType  $payType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayType $payType)
    {
        //
    }
}

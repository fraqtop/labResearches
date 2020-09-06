<?php

namespace App\Http\Controllers;

use App\Services\GenotypeStatusService;
use Illuminate\Http\Request;

class GenotypeStatusController extends ApiController
{

    public function __construct(GenotypeStatusService $modelService)
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
     * Display the specified resource.
     *
     * @param  \App\GenotypeStatus  $genotypeStatus
     * @return \Illuminate\Http\Response
     */
    public function show(GenotypeStatus $genotypeStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GenotypeStatus  $genotypeStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(GenotypeStatus $genotypeStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GenotypeStatus  $genotypeStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GenotypeStatus $genotypeStatus)
    {
        //
    }

}

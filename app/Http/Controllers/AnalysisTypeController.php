<?php

namespace App\Http\Controllers;

use App\Models\AnalysisType;
use App\Services\AnalysisTypeService;
use Illuminate\Http\Request;

class AnalysisTypeController extends ApiController
{

    public function __construct(AnalysisTypeService $modelService)
    {
        parent::__construct($modelService);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnalysisType  $analysisType
     * @return \Illuminate\Http\Response
     */
    public function show(AnalysisType $analysisType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnalysisType  $analysisType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnalysisType $analysisType)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AnalysisType;
use Illuminate\Http\Request;

class AnalysisTypeController extends ApiController
{

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnalysisType  $analysisType
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnalysisType $analysisType)
    {
        $analysisType->delete();
    }
}

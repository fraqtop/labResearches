<?php

namespace App\Http\Controllers;

use App\Services\AnalysisService;
use App\Services\Service;
use Illuminate\Http\Request;
use App\Http\Resources\AnalysisCollection;
use App\Models\Analysis;

class AnalysisController extends ApiController
{

    public function __construct(AnalysisService $modelService)
    {
        parent::__construct($modelService);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse

     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Analysis  $analysis
     * @return \Illuminate\Http\JsonResponse

     */
    public function show(Analysis $analysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Analysis  $analysis
     * @return \Illuminate\Http\JsonResponse

     */
    public function edit(Analysis $analysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Analysis  $analysis
     * @return \Illuminate\Http\JsonResponse

     */
    public function update(Request $request, Analysis $analysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Analysis  $analysis
     * @return \Illuminate\Http\JsonResponse

     */
    public function destroy(Analysis $analysis)
    {
        $analysis->delete();
    }
}

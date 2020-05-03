<?php

namespace App\Http\Controllers;

use App\Services\AnalysisService;
use Illuminate\Http\Request;
use App\Http\Resources\AnalysisCollection;
use App\Models\Analysis;

class AnalysisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param AnalysisService $analysisService
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, AnalysisService $analysisService)
    {
        $query = $analysisService->load($request->get('filters'));
        return (new AnalysisCollection($query->paginate($this->perPage)))->response();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse

     */
    public function store(Request $request)
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

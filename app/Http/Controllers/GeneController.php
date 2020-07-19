<?php

namespace App\Http\Controllers;

use App\Models\Gene;
use App\Http\Resources\GeneResource;
use App\Services\GeneService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneController extends Controller
{
    private GeneService $geneService;

    public function __construct(GeneService $geneService)
    {
        $this->geneService = $geneService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return JsonResource
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'coords' => 'required',
        ]);

        return new GeneResource($this->geneService->create($request->post()));
    }

    /**
     * Display the specified resource.
     *
     * @param  Gene  $gene
     * @return JsonResource
     */
    public function show(Gene $gene)
    {
        return new GeneResource($gene);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function edit(Gene $gene)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gene $gene)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gene  $gene
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gene $gene)
    {
        //
    }
}
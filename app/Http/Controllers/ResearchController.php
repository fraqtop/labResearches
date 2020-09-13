<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Services\ResearchService;
use Illuminate\Http\Request;
use Storage;

class ResearchController extends ApiController
{
    private FileHelper $fileHelper;

    public function __construct(ResearchService $modelService, FileHelper $fileHelper)
    {
        $this->fileHelper = $fileHelper;
        $this->fileHelper->setCache(Storage::path('cache/'));
        parent::__construct($modelService);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit(Research $research)
    {
        //
    }

    public function setResults(Request $request, $id)
    {
        $this->modelService->complete(
            $id,
            $request->post('results'),
            $request->post('diagnosis'),
            $request->post('recommendations')
        );

        return [];
    }

    public function print(int $id)
    {
        $data = $this->modelService->prepareReportData($id);
        $documentData = $this->fileHelper->getFile(Storage::path('template.docx'), $data);

        return [
            'url' => $documentData
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Research $research)
    {
        //
    }

}

<?php


namespace App\Services;


use App\Http\Resources\AnalysisCollection;
use App\Models\Analysis;
use Illuminate\Container\Container;

class AnalysisService extends Service
{
    protected string $class = Analysis::class;

    public function getCollectionClass(): string
    {
        return AnalysisCollection::class;
    }

    public function getValidators(): array
    {
        return [];
    }

    public function create(array $data)
    {
        $analysis = parent::create($data);

        if (isset($data['genes'])) {
            /** @var GeneService $geneService */
            $geneService = Container::getInstance()->get(GeneService::class);
            $geneService->setParent($analysis->id, $data['genes']);
        }

        return $analysis;
    }


}
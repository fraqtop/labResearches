<?php


namespace App\Services;


use App\Http\Resources\ResearchCollection;
use App\Models\Research;

class ResearchService extends Service
{
    protected string $class = Research::class;

    public function getCollectionClass(): string
    {
        return ResearchCollection::class;
    }

}
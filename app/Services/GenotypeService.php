<?php


namespace App\Services;


use App\Http\Resources\DictionaryCollection;
use App\Models\Genotype;
use Carbon\Carbon;

class GenotypeService extends Service
{
    protected string $class = Genotype::class;

    public function getCollectionClass(): string
    {
        return DictionaryCollection::class;
    }

    public function create(array $data)
    {
        $data = $this->getSnakeInput($data);
        Genotype::insert($data);
    }

    protected function getSnakeInput(array $data)
    {
        return array_map(function ($genotype) {
            $genotype = parent::getSnakeInput($genotype);
            $genotype['created_at'] = $genotype['updated_at'] = Carbon::now();
            return $genotype;
        }, $data);
    }
}
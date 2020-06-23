<?php

namespace App\Http\Resources;

use App\Models\Genotype;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GenotypesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->map(fn(Genotype $genotype) => [
            'id' => $genotype->id,
            'name' => $genotype->name,
            'description' => $genotype->description,
            'status' => $genotype->status,
        ]);
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Gene;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GenesCollection extends ResourceCollection
{
    public static $wrap = 'items';
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->map(function (Gene $gene) {
            return [
                'id' => $gene->id,
                'name' => $gene->name,
                'description' => $gene->description,
                'genotypes' => $gene->genotypes
            ];
        });
    }
}

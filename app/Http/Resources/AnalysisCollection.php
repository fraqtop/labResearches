<?php

namespace App\Http\Resources;

use App\Models\Analysis;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnalysisCollection extends ResourceCollection
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
        return $this->map(function (Analysis $analysis) {
            return [
                'id' => $analysis->id,
                'code' => $analysis->code,
                'duration' => $analysis->duration,
                'price' => $analysis->price,
                'description' => $analysis->description,
                'self-link' => route('analyses.show', [$analysis->id]),
                'type' => $analysis->type
            ];
        });
    }
}

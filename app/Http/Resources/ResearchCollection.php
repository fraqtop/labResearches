<?php

namespace App\Http\Resources;

use App\Models\Research;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResearchCollection extends ResourceCollection
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
        return $this->map(function (Research $research) {
            return [
                'id' => $research->id,
                'code' => $research->code,
                'duration' => $research->duration,
                'price' => $research->price,
                'description' => $research->description,
                'self-link' => route('analyses.show', [$research->id]),
                'type' => $research->type
            ];
        });
    }
}

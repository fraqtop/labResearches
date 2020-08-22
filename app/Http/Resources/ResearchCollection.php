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
                'analysis' => $research->analysis,
                'executor' => $research->executor,
                'patient' => $research->patient,
                'user' => $research->user,
                'self-link' => route('analyses.show', [$research->id]),
                'diagnosis' => $research->diagnosis,
                'issuePlanedAt' => $research->issue_planed_at,
                'issuedAt' => $research->issued_at
            ];
        });
    }
}

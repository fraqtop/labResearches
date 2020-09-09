<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ResearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'innerNumber' => $this->inner_number,
            'materialTakenAt' => $this->material_taken_at,
            'patient' => $this->patient,
            'executor' => $this->executor,
            'initiator' => $this->initiator,
            'user' => $this->user,
            'diagnosis' => $this->diagnosis,
            'material' => $this->material,
            'analysis' => $this->analysis,
            'genes' => $this->analysis->genes,
            'payType' => $this->payType,
            'issue_planed_at' => $this->issue_planed_at,
            'issued_at' => $this->issued_at,
            'comment' => $this->comment,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at
        ];
    }
}

<?php

namespace App\Http\Resources;

use App\Models\Patient;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientCollection extends ResourceCollection
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
        return $this->map(function (Patient $patient) {
            return [
                'id' => $patient->id,
                'name' => $patient->name,
                'phone' => $patient->phone,
                'mail' => $patient->mail,
                'birthDate' => $patient->birth_date
            ];
        });
    }
}

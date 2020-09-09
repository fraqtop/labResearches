<?php


namespace App\Services;


use App\Http\Resources\ResearchCollection;
use App\Http\Resources\ResearchResource;
use App\Models\Research;
use Illuminate\Database\Eloquent\Builder;

class ResearchService extends Service
{
    protected string $class = Research::class;

    public function getCollectionClass(): string
    {
        return ResearchCollection::class;
    }

    public function getResourceClass(): string
    {
        return ResearchResource::class;
    }


    public function getValidators(): array
    {
        return [
            'materialTakenAt' => ['required', 'date'],
            'patientId' => ['required', 'exists:patients,id'],
            'initiatorId' => ['required', 'exists:institutions,id'],
            'userId' => ['required', 'exists:users,id'],
            'materialId' => ['required', 'exists:material_types,id'],
            'analysisId' => ['required', 'exists:analyses,id'],
            'payTypeId' => ['required', 'exists:pay_types,id'],
            'issuePlanedAt' => ['required', 'date'],
            'registeredAt' => ['required', 'date'],
            'executorId' => ['required', 'exists:institutions,id']
        ];
    }

    public function load(array $filters = null)
    {
        return parent::load($filters)->with([
            'executor',
            'patient',
            'user',
            'analysis'
        ])->orderBy('issue_planed_at', 'desc');
    }

    public function loadOne(int $id): Builder
    {
        return parent::loadOne($id)->with([
            'patient',
            'executor',
            'initiator',
            'user',
            'material',
            'analysis',
            'payType',
        ]);
    }


}
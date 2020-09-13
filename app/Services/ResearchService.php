<?php


namespace App\Services;


use App\Http\Resources\ResearchCollection;
use App\Http\Resources\ResearchResource;
use App\Models\Genotype;
use App\Models\Research;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use DB;

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

    public function complete(int $id, array $genotypes, string $diagnosis, string $recommendations)
    {
        $data = array_map(fn ($genotype) => ['research_id' => $id, 'genotype_id' => $genotype], $genotypes);
        DB::table('genotype_research')->insert($data);
        $research = Research::find($id);
        $research->diagnosis = $diagnosis;
        $research->recommendations = $recommendations;
        $research->issued_at = Carbon::now();
        $research->save();
    }

    public function prepareReportData(int $id): array
    {
        /** @var Research $research */
        $research = $this->loadOne($id)->first();

        $genes = $research->genotypes->reduce(function (array $result, Genotype $item) {
            $result[] = [
                'name' => $item->gene->name,
                'coords' => $item->gene->coords,
                'description' => $item->gene->description,
                'genotype' => $item->name,
                'typeDescription' => $item->description
            ];
            $result['geneListName'][] = 'Ген ' . $item->gene->name;
            $result['geneListDescription'][] = $item->gene->description;
            return $result;
        }, []);

        return [
            'clientName' => $research->patient->name,
            'clientBirthDate' => $research->patient->birth_date,
            'innerNumber' => $research->inner_number,
            'initiatorName' => $research->initiator->name,
            'doctorName' => $research->user->name,
            'issuedDate' => $research->issued_at,
            'diagnosis' => explode('.', $research->diagnosis),
            'recommendations' => explode('.', $research->recommendations),
            'genes' => $genes,
            'geneListName' => $genes['geneListName'],
            'geneListDescription' => $genes['geneListDescription']
        ];
    }


}
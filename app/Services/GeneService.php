<?php


namespace App\Services;


use App\Http\Resources\GenotypesCollection;
use App\Models\Gene;
use Illuminate\Container\Container;

class GeneService extends Service
{
    protected string $class = Gene::class;

    public function getCollectionClass(): string
    {
        return GenotypesCollection::class;
    }

    public function getValidators(): array
    {
        return [];
    }


    public function create(array $data)
    {
        $data = $this->getSnakeInput($data);
        $gene = Gene::create($data);
        /** @var GenotypeService $genotypeService */
        $genotypeService = Container::getInstance()->get(GenotypeService::class);
        $genotypeService->create(
            array_map(function ($genotype) use($gene) {
                $genotype['gene_id'] = $gene->id;
                return $genotype;
            }, $data['genotypes'])
        );

        return $gene;
    }

    public function setParent(int $analysisId, array $ids)
    {
        Gene::whereIn('id', $ids)->update(['analysis_id' => $analysisId]);
    }

    public function generateGenomes(string $description)
    {
        if (preg_match('/[\\w]+\\s*>\\s*[\\w]+/ui', $description, $matches)) {
            $descriptionParts = explode('>', $matches[0]);
            $minLength = PHP_INT_MAX;
            foreach ($descriptionParts as &$part) {
                $part = trim($part);
                $descriptionPartLength = mb_strlen($part);
                $minLength = $minLength > $descriptionPartLength ? $descriptionPartLength: $minLength;
            }
            $descriptionParts[0] = implode('', array_reverse(preg_split('//ui', $descriptionParts[0])));
            $alleles = array_fill(0, 2, '');
            for ($i = 0; $i < $minLength; ++$i) {
                $alleles[0] = mb_substr($descriptionParts[0], $i, 1) . $alleles[0];
                $alleles[1] .= mb_substr($descriptionParts[1], $i, 1);
            }
            return [
                GenotypeStatusService::OK => $alleles[0] . '/' . $alleles[0],
                GenotypeStatusService::ACCEPTABLE => $alleles[0] . '/' . $alleles[1],
                GenotypeStatusService::CORRUPTED => $alleles[1] . '/' . $alleles[1]
            ];
        }
    }
}

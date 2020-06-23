<?php


namespace App\Services;


use App\Models\Gene;

class GeneService extends Service
{
    public function create(array $data)
    {
        $gene = Gene::create($data);
        if ($gene->description && $genomeTypes = $this->getGenomes($gene->description)) {
            foreach ($genomeTypes as $status => $name) {
                $gene->genotypes()->create([
                    'name' => $name,
                    'genotype_status_id' => $status
                ]);
            }
        }
        return $gene;
    }

    public function getGenomes(string $description)
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

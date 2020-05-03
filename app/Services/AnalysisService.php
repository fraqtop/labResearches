<?php


namespace App\Services;


use App\Models\Analysis;

class AnalysisService extends Service
{

    public function load(array $filters = null)
    {
        $query = Analysis::query();
        if (!$filters) {
            return $query;
        }
        $query = $this->applyFilters($query, (new Analysis())->getFillable(), $filters);
        return $query;
    }

}
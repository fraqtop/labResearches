<?php


namespace App\Services;


use App\Helpers\Filter;
use Illuminate\Database\Eloquent\Builder;

class Service
{
    protected $error;

    public function getErrorMessage()
    {
        return $this->error;
    }

    /**
     * @param $filters
     * @return Filter[]
     */
    protected function parseFilters($filters)
    {
        $result = [];
        foreach ($filters as $item => $value) {
            $item = explode(':', $item);
            $result[] = new Filter($value, $item[1] ?? $item[0], count($item) === 2 ? $item[0]: '=');
        }
        return $result;
    }

    protected function applyFilters(Builder $query, array $attributes, array $filters)
    {
        $filters = $this->parseFilters($filters);
        foreach ($filters as $filter) {
            if (array_search($filter->getParameter(), $attributes) !== false) {
                $query = $query->where($filter->getParameter(), $filter->getSign(), $filter->getValue());
            }
        }
        return $query;
    }

}
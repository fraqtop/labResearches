<?php


namespace App\Services;


use App\Helpers\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassAssignmentException;

abstract class Service
{
    protected string $error;
    protected string $class;

    public abstract function getCollectionClass() : string;

    public function getValidators(): array
    {
        return ['name', ['required']];
    }

    public function create(array $data)
    {
        $model = $this->class::create($data);
        if (!$model) {
            throw new MassAssignmentException('can\'t save model');
        }
        return $model;
    }

    public function getErrorMessage()
    {
        return $this->error;
    }

    public function load(array $filters = null)
    {
        $query = $this->class::query();
        if (!$filters) {
            return $query;
        }
        $query = $this->applyFilters($query, (new $this->class())->getFillable(), $filters);
        return $query;
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
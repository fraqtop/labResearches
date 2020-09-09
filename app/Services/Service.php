<?php


namespace App\Services;


use App\Helpers\Filter;
use App\Http\Resources\DictionaryResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Str;

abstract class Service
{
    protected string $error;
    protected string $class;

    public abstract function getCollectionClass(): string;

    public function getResourceClass(): string
    {
        return DictionaryResource::class;
    }

    public function getValidators(): array
    {
        return ['name' => ['required']];
    }

    public function create(array $data)
    {
        $model = $this->class::create($this->getSnakeInput($data));
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
        return $this->applyFilters($query, (new $this->class())->getFillable(), $filters);
    }

    public function loadOne(int $id): Builder
    {
        return $this->class::query()->where('id', $id);
    }

    public function delete(int $id)
    {
        $this->class::destroy($id);
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

    protected function getSnakeInput(array $data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[Str::snake($key)] = $value;
        }
        return $result;
    }

}
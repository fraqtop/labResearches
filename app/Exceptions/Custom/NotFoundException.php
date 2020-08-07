<?php

namespace App\Exceptions\Custom;

class NotFoundException extends \Exception
{
    private array $searchContext;

    public function __construct(array $searchContext)
    {
        $this->searchContext = $searchContext;
        parent::__construct('', 404, null);
    }

    public function render()
    {
        return response()
            ->json([
                'message' => 'Данные по запросу не найдены',
                'searchedValues' => $this->searchContext
            ])
            ->setStatusCode(404);
    }
}
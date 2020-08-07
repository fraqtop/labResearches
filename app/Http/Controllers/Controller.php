<?php

namespace App\Http\Controllers;

use App\Services\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $perPage = 10;
    protected Service $modelService;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Service $modelService)
    {
        $this->modelService = $modelService;
    }

    public function index(Request $request)
    {
        $query = $this->modelService->load($request->get('filters'));
        $collection = $this->modelService->getCollectionClass();
        return (new $collection($query->paginate($this->perPage)))->response();
    }

    public function store(Request $request)
    {
        $request->validate($this->modelService->getValidators());
        $this->modelService->create($request->post());
    }
}

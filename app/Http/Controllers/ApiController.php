<?php


namespace App\Http\Controllers;


use App\Services\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected int $perPage = 10;
    protected Service $modelService;

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

    public function show(int $id)
    {
        $query = $this->modelService->loadOne($id);
        $resource = $this->modelService->getResourceClass();
        return (new $resource($query->first()))->response();
    }

    public function store(Request $request)
    {
        $request->validate($this->modelService->getValidators());
        return $this->modelService->create($request->post());
    }

    public function destroy(int $id)
    {
        $this->modelService->delete($id);

        return true;
    }

}
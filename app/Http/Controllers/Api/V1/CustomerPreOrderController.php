<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerPreOrder\CreateRequest;
use App\Services\Api\V1\CustomerPreOrderService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerPreOrderController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function create(CreateRequest $request, CustomerPreOrderService $service)
    {
        $service->create($request->all(), $request->route('id'));

        return response('', Response::HTTP_CREATED);
    }
}
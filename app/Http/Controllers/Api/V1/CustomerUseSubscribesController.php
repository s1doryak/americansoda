<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CustomerUserSubscribe\CreateRequest;
use App\Http\Requests\Api\V1\CustomerUserSubscribe\DeleteRequest;
use App\Http\Requests\Api\V1\CustomerUserSubscribe\SearchRequest;
use App\Services\Api\V1\CustomerUserSubscribeService;
use Crmplease\MaterialAdmin\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class CustomerUseSubscribesController extends Controller
{
    protected $prefix = 'api';
    protected $defaultMiddleware = 'api';

    public function create(CreateRequest $request, CustomerUserSubscribeService $service)
    {
        $service->create($request->input('product_id'));

        return response('', Response::HTTP_CREATED);
    }

    public function search(SearchRequest $request, CustomerUserSubscribeService $service)
    {
        $data = $service->search();

        return response()->json($data, Response::HTTP_OK);
    }

    public function delete(DeleteRequest $request, CustomerUserSubscribeService $service)
    {
        $service->delete($request->route('customer_notification'));

        return response('', Response::HTTP_OK);
    }
}

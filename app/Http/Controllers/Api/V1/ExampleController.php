<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ExampleController
{
    /**
     * @OA\Get(
     *     path="/api/v1/example",
     *     description="Returns the example data",
     *     tags={"Example"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful fetch of example data",
     *     )
     * )
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['example' => 'data']);
    }
}

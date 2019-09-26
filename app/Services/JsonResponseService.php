<?php

namespace App\Services;

use Illuminate\Http\Resources\Json\JsonResource;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JsonResponseService
 * @package App\Services
 */
class JsonResponseService
{
    /**
     * @param array $resource
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($resource = [], $code = Response::HTTP_OK)
    {
        return $this->putAdditionalMeta($resource, 'success')
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param array $resource
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function fail($resource = [], $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return $this->putAdditionalMeta($resource, 'fail')
            ->response()
            ->setStatusCode($code);
    }

    /**
     * @param array $resource
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function noContent($resource = [], $code = Response::HTTP_NO_CONTENT)
    {
        return $this->putAdditionalMeta($resource, 'success')
            ->response()
            ->setStatusCode($code);
    }


    /**
     * @param $resource
     * @param $status
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    private function putAdditionalMeta($resource, $status)
    {
        $meta   = [
            'status'         => $status,
            'execution_time' => number_format(microtime(true) - LARAVEL_START, 4),
        ];
        $merged = array_merge($resource->additional ?? [], $meta);

        if ($resource instanceof JsonResource) {
            return $resource->additional($merged);
        }

        if (is_array($resource)) {
            return (new JsonResource(collect($resource)))->additional($merged);
        }

        throw new Exception('Invalid type of resource.');
    }
}

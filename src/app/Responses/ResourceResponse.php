<?php

namespace App\Responses;

use Illuminate\Http\Resources\Json\ResourceResponse as CoreResourceResponse;
use Illuminate\Support\Collection;

/**
 * Class ResourceResponse
 * @package App\Responses
 */
class ResourceResponse extends CoreResourceResponse
{

    /**
     * Return the content for response.
     *
     * @param $request
     *
     * @return array
     */
    public function getResponseContent($request): array
    {
        $data = $this->resource->resolve($request);

        if ($data instanceof Collection) {
            $data = $data->all();
        }
        return array_merge_recursive($data, $this->resource->with($request), $this->resource->additional);
    }
}

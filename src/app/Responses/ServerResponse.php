<?php

namespace App\Responses;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Collection;

class ServerResponse extends Response
{
    protected $content = [];

    public function __construct(string $content = '', int $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
        $this->original = $this->getDefaultResponse();
        $this->content = $this->original;
    }

    /**
     * Add to response result from resource.
     *
     * @param JsonResource|AbstractPaginator $resource
     *
     * @return $this
     */
    public function resource(JsonResource|AbstractPaginator $resource): ServerResponse
    {
        $this->content = $this->content->merge((new ResourceResponse($resource))->getResponseContent(request()));

        return $this;
    }

    /**
     * Sends HTTP headers and content.
     *
     * @return ServerResponse
     */
    public function send(): static
    {
        $this->setContent($this->content);

        return parent::send();
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function data($data): ServerResponse
    {
        $this->content = $this->content->merge($data);

        return $this;
    }

    /**
     * Return default response array
     *
     * @return Collection
     */
    private function getDefaultResponse(): Collection
    {
        return collect([]);
    }
}

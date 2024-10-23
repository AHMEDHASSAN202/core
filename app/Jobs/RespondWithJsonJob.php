<?php

namespace Modules\Core\Http\Jobs;

use INTCore\OneARTFoundation\Job;
use Illuminate\Routing\ResponseFactory;

class RespondWithJsonJob extends Job
{
    protected $status;
    protected $content;
    protected $headers;
    protected $options;

    public function __construct($content, $status = 200, array $headers = [], $options = 0)
    {
        $this->content = $content;
        $this->status = $status;
        $this->headers = $headers;
        $this->options = $options;
    }

    public function handle(ResponseFactory $factory)
    {
        $response = [
            'data' => $this->content,
        ];

        return $factory->json($response, $this->status, $this->headers, $this->options);
    }
}

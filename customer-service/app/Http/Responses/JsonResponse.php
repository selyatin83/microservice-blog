<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse as BaseJsonResponse;
use \Throwable;

class JsonResponse extends BaseJsonResponse
{
    /**
     * @param Throwable|Arrayable|array|null $data
     * @param int $status
     * @param array $headers
     * @param int $options
     * @param bool $json
     */
    public function __construct(
        Throwable|Arrayable|array|null $data = null,
        int $status = 200,
        array $headers = [],
        int $options = 0,
        bool $json = false
    ) {
        $preparedData = $this->prepareData($data);
        $errorMessage = $this->prepareErrorMessage($data);
        $responseData = new ResponsePatternData($preparedData, $errorMessage, $status);
        parent::__construct($responseData, $status, $headers, $options, $json);
    }

    /**
     * @param Throwable|Arrayable|array|null $data
     * @return array|null
     */
    protected function prepareData(
        mixed $data
    ): ?array {
        if ($data === null || $data instanceof Throwable) {
            return null;
        }

        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof Arrayable) {
            return $data->toArray();
        }

        return null;
    }

    /**
     * @param Throwable|Arrayable|array|null $data
     * @return string|null
     */
    protected function prepareErrorMessage(
        mixed $data
    ): ?string {
        if ($data instanceof Throwable) {
            return $data->getMessage();
        }

        return null;
    }
}

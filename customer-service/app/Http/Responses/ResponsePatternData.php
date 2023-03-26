<?php

namespace App\Http\Responses;

use JsonSerializable;

class ResponsePatternData implements JsonSerializable
{
    /** @var array|null  */
    readonly public ?array $data;

    /** @var object|null  */
    readonly public ?object $error;

    /**
     * @param array|null $data
     * @param ?string $errorMessage
     * @return object
     */
    protected function getErrorPattern(?array $data, ?string $errorMessage): object
    {
        $object = new \stdClass();
        $object->data = $data;
        $object->message = $errorMessage;

        return $object;
    }

    /**
     * @param array|null $data
     * @param string|null $errorMessage
     * @param int $status
     */
    public function __construct(
        ?array $data,
        ?string $errorMessage,
        int $status,
    ) {
        if ($status < 200 || $status > 300) {
            $this->data = null;
            $this->error = $this->getErrorPattern($data, $errorMessage);
        } else {
            $this->data = $data;
            $this->error = $this->getErrorPattern(null, $errorMessage);
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'payload' => $this->data,
            'error' => $this->error
        ];
    }
}

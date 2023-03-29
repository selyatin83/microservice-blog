<?php

namespace App\DataTypes\User;

use DateTimeImmutable;
use JsonSerializable;

/**
 * @author <Mikhail Selyatin>
 */
readonly class TokenDataType implements JsonSerializable
{
    /**
     * Token
     *
     * @var string
     */
    private string $value;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $expiresAt;

    /**
     * @param string $value
     * @param DateTimeImmutable $expiresAt
     */
    public function __construct(string $value, DateTimeImmutable $expiresAt)
    {
        $this->value = $value;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->value;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getExpiresAt(): DateTimeImmutable
    {
        return $this->expiresAt;
    }

    /**
     * @param string $value
     * @param DateTimeImmutable $expiresAt
     *
     * @return static
     */
    public static function create(string $value, DateTimeImmutable $expiresAt): static
    {
        return new static($value, $expiresAt);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'value' => $this->value,
            'expiresAt' => $this->expiresAt->format("Y-m-d H:i:s")
        ];
    }
}
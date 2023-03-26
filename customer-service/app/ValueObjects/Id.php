<?php

namespace App\ValueObjects;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;
use App\Interfaces\ValueObjectInterface;

/**
 * @property string $id
 *
 * @author <Mikhail Selyatin>
 */
readonly class Id implements ValueObjectInterface
{
    /** @var string  */
    private string $id;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->id = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->id;
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public static function create(string $value): self
    {
        return new self($value);
    }

    /**
     * @return static
     */
    public static function generate(): self
    {
        return new self(Uuid::uuid4()->toString());
    }
}

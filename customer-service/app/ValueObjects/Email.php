<?php

namespace App\ValueObjects;
use App\Interfaces\ValueObjectInterface;
use Webmozart\Assert\Assert;

/**
 * @property string $email
 *
 * @author <Mikhail Selyatin>
 */
readonly class Email implements ValueObjectInterface
{
    /** @var string  */
    private string $email;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::email($value, "Email isn`t correct");
        $this->email = strtolower($value);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->email;
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
}
<?php

namespace App\ValueObjects;

use App\Interfaces\ValueObjectInterface;
use Illuminate\Support\Facades\Hash;

/**
 * @todo It no have test case
 *
 * @author <Mikhail Selyatin>
 */
readonly class Password implements ValueObjectInterface
{
    /** @var string  */
    private string $password;

    /** @var string  */
    private string $hashPassword;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->password = $value;
        $this->hashPassword = Hash::make($value);
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
     * @return string
     */
    public function getValue(): string
    {
        return $this->hashPassword;
    }

    /**
     * @return string
     */
    public function getNoHashPassword(): string
    {
        return $this->password;
    }
}
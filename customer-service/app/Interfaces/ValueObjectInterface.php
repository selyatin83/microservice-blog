<?php

namespace App\Interfaces;

/**
 * @author <Mikhail Selyatin>
 */
interface ValueObjectInterface
{
    /**
     * @return mixed
     */
    public function getValue(): mixed;
}
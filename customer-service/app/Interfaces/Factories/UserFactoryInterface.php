<?php

namespace App\Interfaces\Factories;

use App\Models\User;
use App\ValueObjects\Email;
use App\ValueObjects\Id;
use App\ValueObjects\Password;

/**
 * @author <Mikhail Selyatin>
 */
interface UserFactoryInterface
{
    /**
     * @param Id $userId
     * @param Email $email
     * @param Password $password
     * @param string $name
     * @param string $lastName
     * @param string|null $login
     *
     * @return User
     */
    public function create(
        Id $userId,
        Email $email,
        Password $password,
        string $name,
        string $lastName,
        ?string $login = null,
    ): User;
}

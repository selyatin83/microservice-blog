<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\ValueObjects\User\Email;
use App\ValueObjects\User\Id;
use App\ValueObjects\User\Password;
use Tests\TestCase;

/**
 * @author <Mikhail Selyatin>
 */
class UserTest extends TestCase
{
    /**
     * @return void
     */
    public function test_that_can_set_to_field_id_value_object(): void
    {
        $id = "0574a7d8-5406-48db-9967-d8e05c65cee8";
        $idVo = Id::create($id);

        $user = new User();
        $user->id = $idVo;

        $this->assertEquals($id, $user->id);
    }

    /**
     * @return void
     */
    public function test_that_can_set_to_field_email_value_object(): void
    {
        $value = "testcorrect@gmail.com";
        $emailVo = Email::create($value);

        $user = new User();
        $user->email = $emailVo;

        $this->assertEquals($value, $user->email);
    }

    /**
     * @return void
     */
    public function test_that_can_set_to_field_password_value_object(): void
    {
        $value = "correctPassword";
        $passwordVo = Password::create($value);

        $user = new User();
        $user->password = $passwordVo;

        $this->assertNotEquals($value, $user->password);
    }
}

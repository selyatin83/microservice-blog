<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Email;
use Tests\TestCase;

/**
 * @author <Mikhail Selyatin>
 */
class EmailValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function test_success_creating_value_object(): void
    {
        $value = "correctEmail@gmail.com";
        $emailVo = Email::create($value);

        $this->assertEquals($value, $emailVo->getValue());
    }

    /**
     * @return void
     */
    public function test_failure_creating_value_object(): void
    {
        $this->expectException(\Exception::class);
        $value = "incorrectEmail.com";
        Email::create($value);
    }

    /**
     * @return void
     */
    public function test_empty_value_creating_value_object(): void
    {
        $this->expectException(\Exception::class);
        Email::create("");
    }
}

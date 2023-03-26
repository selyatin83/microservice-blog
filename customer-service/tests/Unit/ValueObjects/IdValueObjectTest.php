<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Id;
use Tests\TestCase;

/**
 * @author <Mikhail Selyatin>
 */
class IdValueObjectTest extends TestCase
{
    /**
     * @return void
     */
    public function test_success_creating_value_object(): void
    {
        $value = "e9d769ab-a29d-4f20-8ab2-89a97583eb6f";
        $emailVo = Id::create($value);

        $this->assertEquals($value, $emailVo->getValue());
    }

    /**
     * @return void
     */
    public function test_failure_creating_value_object(): void
    {
        $this->expectException(\Exception::class);
        $value = "incorrectUuid4";
        Id::create($value);
    }

    /**
     * @return void
     */
    public function test_empty_value_creating_value_object(): void
    {
        $this->expectException(\Exception::class);
        Id::create("");
    }
}

<?php

namespace Tests\Unit\DataTypes;

use App\DataTypes\User\TokenDataType;
use Tests\TestCase;
use DateTimeImmutable;

/**
 * @author <Mikhail Selyatin>
 */

class TokenDataTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_json_serialize_valid(): void
    {
        $tokenValue = "valuetokenrandom";
        $expiresAt = new DateTimeImmutable();
        $tokenDataType = TokenDataType::create($tokenValue, $expiresAt);
        $serializedToken = json_encode($tokenDataType);

        $expectedJsonStructure = '{"value":"' . $tokenValue . '","expiresAt":"'. $expiresAt->format("Y-m-d H:i:s") .'"}';
        $this->assertJsonStringEqualsJsonString($expectedJsonStructure, $serializedToken);
    }
}

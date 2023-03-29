<?php

namespace Tests\Feature;

use App\Models\User;
use App\ValueObjects\User\Id;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @author <Mikhail Selyatin>
 */
class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_signin_customer_route_is_exists(): void
    {
        $route = route('version-1.no-auth.customer_signin');
        $this->assertIsString($route);
    }

    /**
     * @return void
     */
    public function test_signin_customer_route_http_is_available(): void
    {
        $route = route('version-1.no-auth.customer_signin');

        $response = $this->post(
            $route,
            []
        );

        $statusCode = $response->getStatusCode();
        $this->assertNotEquals(Response::HTTP_NOT_FOUND, $statusCode);
        $this->assertNotEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $statusCode);
        $this->assertNotEquals(Response::HTTP_BAD_GATEWAY, $statusCode);
    }

    /**
     * @return void
     */
    public function test_signin_customer_success(): void
    {

        $userTestEmail = 'testcorrect@gmail.com';
        $userTestPassword = 'correctPassword';

        User::factory(1)->create([
            'id' => Id::generate(),
            'email' => $userTestEmail,
            'password' => Hash::make($userTestPassword),
        ]);

        $route = route('version-1.no-auth.customer_signin');

        $response = $this->post(
            $route,
            [
                'email' => $userTestEmail,
                'password' => $userTestPassword,
            ]
        );

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'payload' => [
                    'user' => [
                        'email' => $userTestEmail,
                    ],
                    'token' => []
                ],
                'error' => [
                    'data' => null,
                    'message' => null
                ]
              ]);
    }

    /**
     * @return void
     */
    public function test_signin_customer_failed_validation(): void
    {
        $route = route('version-1.no-auth.customer_signin');

        $response = $this->post(
            $route,
            []
        );

        $response
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                 'payload' => null,
                 'error' => [
                     'data' => []
                 ]
             ]);
    }
}

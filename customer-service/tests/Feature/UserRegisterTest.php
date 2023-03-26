<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * @author <Mikhail Selyatin>
 */
class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function test_signup_customer_route_is_exists(): void
    {
        $route = route('version-1.no-auth.customer_signup');
        $this->assertIsString($route);
    }

    /**
     * @return void
     */
    public function test_signup_customer_route_is_not_404(): void
    {
        $route = route('version-1.no-auth.customer_signup');

        $response = $this->post(
            $route,
            []
        );

        $statusCode = $response->getStatusCode();
        $this->assertNotEquals(Response::HTTP_NOT_FOUND, $statusCode);
    }

    /**
     * @return void
     */
    public function test_signup_customer_success(): void
    {
        $route = route('version-1.no-auth.customer_signup');

        $userTestName = 'TestName';
        $userTestLastName = 'TestLastName';
        $userTestEmail = 'testcorrect@gmail.com';
        $userTestPassword = 'correctPassword';
        $userTestLogin = 'correctLogin';

        $response = $this->post(
            $route,
            [
                'name' => $userTestName,
                'lastName' => $userTestLastName,
                'email' => $userTestEmail,
                'password' => $userTestPassword,
                'password_confirmation' => $userTestPassword,
                'login' => $userTestLogin
            ]
        );

        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJson([
                'payload' => [
                    'login' => $userTestLogin,
                    'email' => $userTestEmail,
                    'name' => $userTestName,
                    'last_name' => $userTestLastName,
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
    public function test_signup_customer_failed_validation(): void
    {
        $route = route('version-1.no-auth.customer_signup');

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

    /**
     * @return void
     */
    public function test_signup_customer_failed_confirm_password(): void
    {
        $route = route('version-1.no-auth.customer_signup');

        $userTestName = 'TestName';
        $userTestLastName = 'TestLastName';
        $userTestEmail = 'testcorrect@gmail.com';
        $userTestPassword = 'correctPassword';
        $userTestLogin = 'correctLogin';

        $response = $this->post(
            $route,
            [
                'name' => $userTestName,
                'lastName' => $userTestLastName,
                'email' => $userTestEmail,
                'password' => $userTestPassword,
                'password_confirmation' => 'otherPassword',
                'login' => $userTestLogin
            ]
        );

        $response
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson([
                'payload' => null,
                'error' => [
                    'data' => [
                        'password' => []
                    ]
                ]
             ]);
    }
}

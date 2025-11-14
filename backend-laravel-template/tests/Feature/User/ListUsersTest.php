<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    private $responseFields = [
        'id',
        'type',
        'name',
        'email',
        'active',
    ];

    /** @test */
    public function list_users_requires_login()
    {
        $response = $this->get('/api/v1/users');
        $this->checkAuthenticationExceptionResponse($response);
    }

    /** @test */
    public function should_list_all_users(): void
    {
        $this->loginAsAdmin();
        $perPage = 25;
        $total = 30;
        $actualTotal = $total + $this->totalDefaultUser;
        $users = User::factory()->times($total)->create();
        $response = $this->get('/api/v1/users');
        $response->assertStatus(200);
        $response->assertJsonCount(25, 'data');
        $this->checkSuccessResponseResourceList($response, $this->responseFields);
        $this->assertArrayHasKey('pagination', $response);
        $this->assertArrayHasKey('data', $response);
        $responseData = $response->json()['data'];
        for ($i = $this->totalDefaultUser; $i < $perPage; $i++) {
            $user = $users[$i - $this->totalDefaultUser];
            $responseUser = $responseData[$i];
            $this->assertEquals($user->name, $responseUser['name']);
        }
    }

    /** @test */
    public function should_list_all_users_page2(): void
    {
        $this->loginAsAdmin();
        $perPage = 25;
        $total = 30;
        $actualTotal = $total + $this->totalDefaultUser;
        $users = User::factory()->times($total)->create();
        $response = $this->get('/api/v1/users?page=2');
        $response->assertStatus(200);
        $count = 30 - $perPage + $this->totalDefaultUser;
        $response->assertJsonCount($count, 'data');
        $this->checkSuccessResponseResourceList($response, $this->responseFields);
        $this->assertArrayHasKey('pagination', $response);
        $this->assertArrayHasKey('data', $response);
        $responseData = $response->json()['data'];
        $startIndex = $actualTotal - $perPage;
        $user = $users[$startIndex];
        for ($i = 0; $i < $count; $i++) {
            $responseUser = $responseData[$i];
            $user = $users[$perPage + $i - $this->totalDefaultUser];
            $this->assertEquals($user->name, $responseUser['name']);
        }
    }
}

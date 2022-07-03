<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testHealthCheck()
    {
        $this->get('/health-check')
            ->assertStatus(Response::HTTP_OK)
            ->assertExactJson(['status' => 'ok']);
    }

    public function testApiExample()
    {
        $this->getJson('/api/v1/example')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'example' => 'data'
            ]);
    }

    public function testAuthorization()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->getJson('/api/me')
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'name' => $user->name,
                'email' => $user->email
            ]);
    }

    public function testUnauthorizedGet401()
    {
        $this->getJson('/api/me')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}

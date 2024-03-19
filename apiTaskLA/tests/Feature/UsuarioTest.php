<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class UsuarioTest extends TestCase
{
  use RefreshDatabase;
  public function test_registro(): void
  {
    $user = [
      'name' => 'test',
      'email' => 'test@test',
      'password' => 'test'
    ];

    $response = $this->postJson('api/register', $user);
    $response->assertStatus(200)->assertJsonStructure([
      'data',
      'access_token',
      'token_type'
    ]);
  }

  public function test_login(): void
  {
    $user = User::factory()->create();
    $login = [
      'email' => $user->email,
      'password' => 'password'
    ];

    $response = $this->postJson('api/login', $login);
    $response->assertStatus(200)->assertJsonStructure([
      'message',
      'access_token',
      'token_type'
    ]);
  }

  public function test_logout(): void
  {
    $user = User::factory()->create();
    $token = $user->createToken('auth_token')->plainTextToken;
    $this->actingAs($user)->assertAuthenticated();
    $response = $this->actingAs($user)->withToken($token)->getJson('api/logout');
    $response->assertStatus(200);
  }
}

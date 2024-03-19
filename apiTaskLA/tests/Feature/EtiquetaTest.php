<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Etiqueta;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EtiquetaTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  public function test_get_etiquetas_all(): void
  {
    $user = User::factory()->create();
    $etiqueta = new Etiqueta();
    $etiqueta->nombre = "testNombre";
    $etiqueta->save();

    $response = $this->actingAs($user)->getJson('api/etiquetas');
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $etiqueta->id,
      'nombre' => 'Nombre: ' . $etiqueta->nombre
    ]);
  }

  public function test_get_una_etiqueta(): void
  {
    $user = User::factory()->create();
    $etiqueta = new Etiqueta();
    $etiqueta->nombre = "testNombre99";
    $etiqueta->save();

    $response = $this->actingAs($user)->getJson('api/etiquetas/' . $etiqueta->id);
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $etiqueta->id,
      'nombre' => 'Nombre: ' . $etiqueta->nombre
    ]);
  }

  public function test_create_etiqueta(): void
  {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson('api/etiquetas', [
      'nombre' => 'testNombre33',
    ]);
    $response->assertStatus(201);
  }

  public function test_error_create_etiqueta(): void
  {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson('api/etiquetas', [
      'nombre' => '',
    ]);
    $response->assertStatus(422);
  }

}

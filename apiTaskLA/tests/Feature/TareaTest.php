<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tarea;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TareaTest extends TestCase
{
  use RefreshDatabase, WithFaker;

  public function test_get_tareas_all(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo";
    $tarea->descripcion = "testDescripcion";
    $tarea->save();

    $response = $this->actingAs($user)->getJson('api/tareas');
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $tarea->id,
      'titulo' => 'Titulo: ' . $tarea->titulo,
      'descripcion' => 'Descripcion: ' . $tarea->descripcion,
      'etiquetas' => $tarea->etiquetas != null ? $tarea->etiquetas->pluck('nombre') : []
    ]);
  }

  public function test_get_una_tarea(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo";
    $tarea->descripcion = "testDescripcion";
    $tarea->save();

    $response = $this->actingAs($user)->getJson('api/tareas/' . $tarea->id);
    $response->assertStatus(200);

    $response->assertJsonFragment([
      'id' => $tarea->id,
      'titulo' => 'Titulo: ' . $tarea->titulo,
      'descripcion' => 'Descripcion: ' . $tarea->descripcion,
      'etiquetas' => $tarea->etiquetas != null ? $tarea->etiquetas->pluck('nombre') : []
    ]);
  }

  public function test_put_tarea(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo47";
    $tarea->descripcion = "testDescripcion47";
    $tarea->save();

    $response = $this->actingAs($user)->putJson('api/tareas/' . $tarea->id, [
      'titulo' => 'testTitulo2',
      'descripcion' => 'testDescripcion2',
    ]);
    $response->assertStatus(200);
    $response->assertJsonFragment([
      'id' => $tarea->id,
      'titulo' => 'Titulo: ' . 'testTitulo2',
      'descripcion' => 'Descripcion: ' . 'testDescripcion2',
      'etiquetas' => $tarea->etiquetas != null ? $tarea->etiquetas->pluck('nombre') : []
    ]);
  }

  public function test_delete_tarea(): void
  {
    $user = User::factory()->create();
    $tarea = new Tarea();
    $tarea->titulo = "testTitulo15";
    $tarea->descripcion = "testDescripcion15";
    $tarea->save();

    $response = $this->actingAs($user)->deleteJson('api/tareas/' . $tarea->id);
    $response->assertStatus(200);

    $this->assertDatabaseMissing('tareas', [
      'id' => $tarea->id
    ]);
  }

  public function test_create_tarea(): void
  {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson('api/tareas', [
      'titulo' => 'testTitulo',
      'descripcion' => 'testDescripcion',
    ]);
    $response->assertStatus(201);
  }

  public function test_error_create_tarea(): void
  {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->postJson('api/tareas', [
      'titulo' => '',
      'descripcion' => '',
    ]);
    $response->assertStatus(422);
  }

}

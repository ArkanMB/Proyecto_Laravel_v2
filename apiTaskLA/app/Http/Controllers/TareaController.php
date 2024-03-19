<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Http\Resources\TareaResource;
use App\Http\Requests\TareaRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class TareaController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): JsonResource
  {
    $tareas = Tarea::all();
    return TareaResource::collection($tareas);
  }


  /**
   * Store a newly created resource in storage.
   */
  public function store(TareaRequest $request): JsonResource
  {
    $tarea = new Tarea();
    $tarea->titulo = $request->titulo;
    $tarea->descripcion = $request->descripcion;
    $tarea->save();

    $tarea->etiquetas()->attach($request->etiquetas);
    return new TareaResource($tarea);
  }

  /**
   * Display the specified resource.
   */
  public function show($id): JsonResource
  {
    $tarea = Tarea::find($id);
    return new TareaResource($tarea);
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(TareaRequest $request, $id): JsonResource
  {
    $tarea = Tarea::find($id);
    $tarea->titulo = $request->titulo;
    $tarea->descripcion = $request->descripcion;
    $tarea->etiquetas()->detach();
    
    $tarea->etiquetas()->attach($request->etiquetas);
    $tarea->save();

    return new TareaResource($tarea);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($id)
  {
    Tarea::find($id)->delete();
    return response()->json(['success' => true], 200);
  }
}

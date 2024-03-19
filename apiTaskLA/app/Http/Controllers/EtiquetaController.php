<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Http\Resources\EtiquetaResource;
use App\Http\Requests\EtiquetaRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
      $etiquetas = Etiqueta::all();
       return EtiquetaResource::collection($etiquetas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EtiquetaRequest $request):JsonResource
    {
      $etiqueta=new Etiqueta();
      $etiqueta->nombre = $request->nombre;
      $etiqueta->save();

      $etiqueta->tareas()->attach($request->tareas);
     return new EtiquetaResource($etiqueta);
    }

    /**
     * Display the specified resource.
     */
    public function show($id):JsonResource
    {
      $etiqueta = Etiqueta::find($id);
      return new EtiquetaResource($etiqueta);
    }

  
    /**
     * Update the specified resource in storage.
     */
    public function update(EtiquetaRequest $request, $id):JsonResource
    {
      $etiqueta = Etiqueta::find($id);
      $etiqueta->nombre = $request->nombre;
      $etiqueta->tareas()->detach();

      $etiqueta->tareas()->attach($request->tareas) ;
      $etiqueta->save();

      return new EtiquetaResource($etiqueta);
    }
}

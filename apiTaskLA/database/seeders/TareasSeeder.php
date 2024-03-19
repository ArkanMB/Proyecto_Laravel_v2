<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TareasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('tareas')->insert([
      [
        'titulo' => 'Compra del mes',
        'descripcion' => 'Lacteos: leche, yogurts, queso;
                          Hidratos: pan, pasta, arroz;
                          Proteinas: pollo, ternera, cerdo.',
      ],
      [
        'titulo' => 'Limpiar habitaciones',
        'descripcion' => 'Limpiar exhaustivamente el WC 
                          y poner lavadora.',
      ],
      [
        'titulo' => 'Llevar a la abuela al medico',
        'descripcion' => 'Hay que recogerla del canto porque 
                          a las 5pm tiene traumatologo.',
      ],
      [
        'titulo' => 'Proyecto Laravel',
        'descripcion' => 'Hay que realizar el proyecto laravel,
                          para el dia 4 de Marzo.',
      ]
    ]);
  }
}

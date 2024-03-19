<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class EtiquetasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('etiquetas')->insert([
      [
        'nombre' => 'Home',
      ],
      [
        'nombre' => 'Familia',
      ],
      [
        'nombre' => 'Trabajo',
      ]
    ]);
  }
}

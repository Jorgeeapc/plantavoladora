<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\Regione;
use App\Models\Comuna;
use App\Models\Estado;
use App\Models\Prenda;
use App\Models\PrendaCategoria;
use App\Models\Talla;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
         Regione::factory(15)->create();
         Comuna::factory(30)->create();
         User::factory(5)->create();
         $estados=array("Listo","Pendiente");
         foreach ($estados as $estado) {
            Estado::create([
                'estado'=> $estado
            ]);
         };
        //  Estado::factory(5)->create();
        //  Compra::factory(5)->create();
         Talla::factory(3)->create();
         Prenda::factory(40)->create();
    
    
    }
}

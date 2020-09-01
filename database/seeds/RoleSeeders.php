<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	'title' => 'administrador',
        	'description' => 'Este usuario cuenta con permisos de super administrador'
        ]);

        DB::table('roles')->insert([
            'title' => 'editor',
            'description' => 'Este usuario cuenta con permisos para crear/editar/eliminar configuraciones de la sección Página Web.'
        ]);
    }
}

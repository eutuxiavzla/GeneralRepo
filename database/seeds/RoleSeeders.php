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
        	'description' => 'Este usuario cuenta con permisos de super usuario'
        ]);
    }
}

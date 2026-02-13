<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'admin', 'description' => 'Administrador del sistema'],
            ['name' => 'gestor', 'description' => 'Funcionario/Gestor'],
            ['name' => 'auditor', 'description' => 'Supervisor/Auditor'],
            ['name' => 'operativo', 'description' => 'Usuario operativo'],
        ]);
    }
}

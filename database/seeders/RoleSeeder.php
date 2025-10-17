<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpa o cache de roles e permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Cria os papéis
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'supervisor']);
        Role::create(['name' => 'author']);
        Role::create(['name' => 'user']);
    }
}

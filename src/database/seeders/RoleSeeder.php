<?php

namespace DevSajid\Permission\Database\Seeders;

use DevSajid\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
            // 'created_by' => 1,
            'deleteable' => false,
        ]);

        Role::updateOrCreate([
            'name' => 'Admin',
            'slug' => 'admin',
            'deleteable' => true,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
        {
            $roles = Role::all();

            foreach ($roles as $role) {

                User::firstOrCreate(
                    [
                        'email' => $role->slug . '@warehousepro.test'
                    ],
                    [
                        'name' => ucfirst(str_replace('_', ' ', $role->slug)),
                        'password' => bcrypt('password'),
                        'role_id' => $role->id
                    ]
                );
            }
        }
}

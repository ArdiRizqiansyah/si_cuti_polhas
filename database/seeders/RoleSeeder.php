<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $role = [
            [
                'name' => 'admin',
                'description' => 'Administrator',
            ],
            [
                'name' => 'kepala_unit',
                'description' => 'Kepala Unit',
            ],
            [
                'name' => 'pegawai',
                'description' => 'Pegawai',
            ],
        ];

        foreach ($role as $r) {
            Role::create($r);
        }
    }
}

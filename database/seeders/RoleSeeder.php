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
        /*Super Admin*/
        Role::create([
            'code'=>'super-admin',
            'name' => 'Süper Yönetici'
        ]);

        /*Warehouse Supervisor*/
        Role::create([
            'code'=>'warehouse-supervisor',
            'name' => 'Depo Yöneticisi'
        ]);

        /*Warehouse Staff*/
        Role::create([
            'code'=>'warehouse-staff',
            'name' => 'Depo Personeli'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Super Admin*/
        $superAdmin = User::create([
            'name' => 'Süper Yönetici',
            'email' => 'yonetici@tailadmin.dev',
            'password' => \Hash::make('12345678')
        ]);

        /*Warehouse Supervisor*/
        $warehouseSupervisor = User::create([
            'name' => 'Depo Yöneticisi 1',
            'email' => 'supervisor@tailadmin.dev',
            'password' => \Hash::make('12345678')
        ]);

        /*Warehouse Staff*/
        $warehouseStaff = User::create([
            'name' => 'Depo Çalışanı 1',
            'email' => 'staff@tailadmin.dev',
            'password' => \Hash::make('12345678')
        ]);

        $superAdmin->roles()->attach(Role::where('code', 'super-admin')->first()->id);
        $warehouseSupervisor->roles()->attach(Role::where('code', 'warehouse-supervisor')->first()->id);
        $warehouseStaff->roles()->attach(Role::where('code', 'warehouse-staff')->first()->id);
    }
}

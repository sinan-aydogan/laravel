<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCreate = Permission::create([
            'name'=>'create_product'
        ]);

        $productUpdate = Permission::create([
            'name'=>'update_product'
        ]);

        $productDelete = Permission::create([
            'name'=>'delete_product'
        ]);

        $warehouseCreate = Permission::create([
            'name'=>'create_warehouse'
        ]);

        $warehouseUpdate = Permission::create([
            'name'=>'update_warehouse'
        ]);

        $warehouseDelete = Permission::create([
            'name'=>'delete_warehouse'
        ]);

        $transactionCreate = Permission::create([
            'name'=>'create_transaction'
        ]);

        $transactionUpdate = Permission::create([
            'name'=>'update_transaction'
        ]);

        $transactionDelete = Permission::create([
            'name'=>'delete_transaction'
        ]);

        $stockCardCreate = Permission::create([
            'name'=>'create_stock_card'
        ]);

        $stockCardUpdate = Permission::create([
            'name'=>'update_stock_card'
        ]);

        $stockCardDelete = Permission::create([
            'name'=>'delete_stock_card'
        ]);


        /*Super Admin*/
        $superAdmin = Role::where('code', 'super-admin')->first();
        $superAdmin->permissions()->sync([
            $productCreate->id,
            $productUpdate->id,
            $productDelete->id,
            $warehouseCreate->id,
            $warehouseUpdate->id,
            $warehouseDelete->id,
            $transactionCreate->id,
            $transactionUpdate->id,
            $transactionDelete->id,
            $stockCardCreate->id,
            $stockCardUpdate->id,
            $stockCardDelete->id,
        ]);


        /*Warehouse Supervisor*/
        $warehouseSupervisor = Role::where('code', 'warehouse-supervisor')->first();
        $warehouseSupervisor->permissions()->sync([
            $warehouseCreate->id,
            $warehouseUpdate->id,
            $warehouseDelete->id,
            $transactionCreate->id,
            $transactionUpdate->id,
            $transactionDelete->id,
            $stockCardCreate->id,
            $stockCardUpdate->id,
            $stockCardDelete->id,
        ]);

        /*Warehouse Staff*/
        $warehouseStaff = Role::where('code', 'warehouse-staff')->first();
        $warehouseStaff->permissions()->sync([
            $transactionCreate->id,
            $stockCardCreate->id,
        ]);
    }
}

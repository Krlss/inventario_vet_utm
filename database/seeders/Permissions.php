<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'inventory.permissions']);

        Permission::create(['name' => 'inventory.home']);
        Permission::create(['name' => 'inventory.products.index']);
        Permission::create(['name' => 'inventory.products.show']);
        Permission::create(['name' => 'inventory.products.create']);
        Permission::create(['name' => 'inventory.products.edit']);
        Permission::create(['name' => 'inventory.products.destroy']);

        Permission::create(['name' => 'inventory.ingress-products.index']);
        Permission::create(['name' => 'inventory.ingress-products.show']);
        Permission::create(['name' => 'inventory.ingress-products.create']);
        Permission::create(['name' => 'inventory.ingress-products.edit']);
        Permission::create(['name' => 'inventory.ingress-products.destroy']);

        Permission::create(['name' => 'inventory.egress-products.index']);
        Permission::create(['name' => 'inventory.egress-products.show']);
        Permission::create(['name' => 'inventory.egress-products.create']);
        Permission::create(['name' => 'inventory.egress-products.edit']);
        Permission::create(['name' => 'inventory.egress-products.destroy']);


        Permission::create(['name' => 'inventory.expires-products.index']);
        Permission::create(['name' => 'inventory.expires-stock-products.index']);

        Permission::create(['name' => 'inventory.categories.index']);
        Permission::create(['name' => 'inventory.categories.show']);
        Permission::create(['name' => 'inventory.categories.create']);
        Permission::create(['name' => 'inventory.categories.edit']);
        Permission::create(['name' => 'inventory.categories.destroy']);

        Permission::create(['name' => 'inventory.types.index']);
        Permission::create(['name' => 'inventory.types.show']);
        Permission::create(['name' => 'inventory.types.create']);
        Permission::create(['name' => 'inventory.types.edit']);
        Permission::create(['name' => 'inventory.types.destroy']);

        Permission::create(['name' => 'inventory.units.index']);
        Permission::create(['name' => 'inventory.units.show']);
        Permission::create(['name' => 'inventory.units.create']);
        Permission::create(['name' => 'inventory.units.edit']);
        Permission::create(['name' => 'inventory.units.destroy']);

        Permission::create(['name' => 'inventory.reports']);

        Permission::create(['name' => 'inventory.lotes.index']);
        Permission::create(['name' => 'inventory.lotes.show']);
        Permission::create(['name' => 'inventory.lotes.create']);
        Permission::create(['name' => 'inventory.lotes.edit']);
        Permission::create(['name' => 'inventory.lotes.destroy']);
    }
}

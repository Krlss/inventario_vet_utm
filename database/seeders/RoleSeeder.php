<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrador = User::with(['roles' => function ($query) {
            $query->where('name', 'administradoristrador');
        }])->first();

        $secretario = User::with(['roles' => function ($query) {
            $query->where('name', 'Secretario');
        }])->first();

        if (!$administrador || !$secretario) {
            $this->command->info('No se encontraron usuarios para asignar roles');
            return;
        } else {
            Permission::create(['name' => 'inventory.home'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.products.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.products.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.products.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.products.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.products.destroy'])->syncRoles([$administrador]);

            Permission::create(['name' => 'inventory.ingress-productos.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.ingress-productos.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.ingress-productos.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.ingress-productos.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.ingress-productos.destroy'])->syncRoles([$administrador]);

            Permission::create(['name' => 'inventory.egress-productos.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.egress-productos.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.egress-productos.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.egress-productos.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.egress-productos.destroy'])->syncRoles([$administrador]);


            Permission::create(['name' => 'inventory.expires-productos.index'])->syncRoles([$administrador]);
            Permission::create(['name' => 'inventory.expires-productos.index'])->syncRoles([$administrador]);

            Permission::create(['name' => 'inventory.categories.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.categories.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.categories.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.categories.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.categories.destroy'])->syncRoles([$administrador]);

            Permission::create(['name' => 'inventory.types.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.types.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.types.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.types.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.types.destroy'])->syncRoles([$administrador]);

            Permission::create(['name' => 'inventory.units.index'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.units.show'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.units.create'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.units.edit'])->syncRoles([$administrador, $secretario]);
            Permission::create(['name' => 'inventory.units.destroy'])->syncRoles([$administrador]);
        }
    }
}

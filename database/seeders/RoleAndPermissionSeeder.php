<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{

	public function run()
	{
		$permissionsManager = [
			'products.index',
			'products.create',
			'products.show',
			'products.store',
			'products.edit',
			'products.update',
			'products.destroy',
			'categories.index',
			'categories.get-all',
			'categories.create',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',
		];
		$permissionsAdmin = array_merge([
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',
		], $permissionsManager);

		// Roles
		$admin = Role::create(['name' => 'admin']);
		$manager = Role::create(['name' => 'manager']);
		Role::create(['name' => 'user']);

		foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
		}

		foreach ($permissionsManager as $permission) {
			$permission = Permission::where(['name' => $permission])->first();
			$manager->givePermissionTo($permission);
		}
	}
}

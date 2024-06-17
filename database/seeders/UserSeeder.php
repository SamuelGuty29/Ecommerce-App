<?php

namespace Database\Seeders;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

	public function run()
	{
		$user = new User([
			'number_id' => '1007605306',
			'name' => 'Samuel',
			'last_name' => 'Gutierrez',
			'email' => 'samuel2003295@gmail.com',
			'password' => '123456789',
			'remember_token' => Str::random(10),

		]);
		$user->save();
		$user->assignRole('admin');
		$file = new File(['route' => '/storage/images/users/default.jpg']);
		$user->file()->save($file);
	}
}

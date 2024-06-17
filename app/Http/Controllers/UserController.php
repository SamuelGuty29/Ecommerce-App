<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\UploadFile;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\user\UserUpdateRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
	use UploadFile;
	public function index(Request $request)
	{
		$roles = Role::get();
		$users = User::with('roles', 'file')->get();
		if (!$request->ajax()) return view('users.index', compact('users','roles'));
		return response()->json(['users' => $users], 200);
	}

	public function create()
	{
		$roles = Role::all()->pluck('name');
		return view('users.create', compact('roles'));
	}


	public function store(UserRequest $request)
	{
		try {
			DB::beginTransaction();
			$user = new User($request->all());
			$user->save();
			$this->uploadFile($user, $request);
			DB::commit();
			if (!$request->ajax()) return back()->with("success", 'user created');
			return response()->json(['status' => 'user created'], 201);
		} catch (\Throwable $th) {
			DB::rollBack();
			throw $th;
		}
	}


	public function edit(User $user)
	{
		$roles = Role::all()->pluck('name');
		return view('users.edit', compact('user', 'roles'));
	}


	public function update(UserUpdateRequest $request, User $user)
	{
		try {
            DB::beginTransaction();
            $data = $request->all();
            $user->update($data);
            if ($request->hasFile('file')) {
                $this->uploadFile($user, $request);
            }
            if (!$request->filled('password')) unset($data['password'], $data['password_confirmation']);
            $user->syncRoles([$request->role]);
            DB::commit();
            if (!$request->ajax()) return back()->with("success", 'User updated');
            return response()->json([], 204);
        } catch (\Throwable $th) {
            DB::rollback();
        }
	}

	public function destroy(Request $request, User $user)
    {
        $user->delete();
        $this->deleteFile($user);
        if (!$request->ajax()) return back()->with("success", 'User deleted');
        return response()->json([], 204);
    }
}

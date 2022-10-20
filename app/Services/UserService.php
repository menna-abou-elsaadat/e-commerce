<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
	public static function create($name,$email,$password,$role)
	{
		$new_user = new User();
		$new_user->name = $name;
		$new_user->email = $email;
		$new_user->password = Hash::make($password);
		$new_user->role = $role;
		$new_user->save();

		return $new_user;
	}
}
?>
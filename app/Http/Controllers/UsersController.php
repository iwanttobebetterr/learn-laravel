<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('company')
            ->withLastLogin()
            ->orderBy('name')
            ->simplePaginate();

        return view('users', ['users' => $users]);
    }
}

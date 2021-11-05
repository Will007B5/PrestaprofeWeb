<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->getAll();
    }
    public function show(User $user)
    {
        return $this->userService->getOne($user);
    }
    public function store(Request $request)
    {
        return $this->userService->create($request->all());
    }
    public function update(Request $request, User $user)
    {
        return $this->userService->update($request->all(), $user);
    }
    public function destroy(User $user)
    {
        return $this->userService->delete($user);
    }
}

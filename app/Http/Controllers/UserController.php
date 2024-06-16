<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

/**
 * UserController
 */
class UserController extends Controller
{
    public function index(): ViewContract
    {
        $users = User::all();

        return View::make('admin.user.index', compact('users'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.user.index');
    }

    public function show(User $user): ViewContract
    {
        return View::make('admin.user.form', compact('user'));
    }

    public function edit(User $user): ViewContract
    {
        return View::make('admin.user.form', compact('user'));
    }

    public function create(): ViewContract
    {
        return View::make('admin.user.form');
    }

    public function store(CreateRequest $request): RedirectResponse
    {
        $data = (array) $request->validated();

        $data['password']  = Hash::make($request->password);
        $data['is_active'] = true;

        User::firstOrCreate($data);

        return redirect()->route('admin.user.index');
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $data = (array) $request->validated();

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('admin.user.index');
        } catch (Exception) {
            return redirect()->route('admin.user.edit', compact('user'))
                ->with('error', trans('messages.auth.errorException'));
        }
    }

    public function changeStatus(User $user): RedirectResponse
    {
        $user->update(['is_active' => !$user->is_active]);

        return redirect()->back();
    }
}

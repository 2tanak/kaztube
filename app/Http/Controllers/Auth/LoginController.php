<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

/**
 * Controller
 */
class LoginController extends BaseController
{
    public function index(): ViewContract
    {
        return View::make('auth.login');
    }

    public function check(UserRequest $request): RedirectResponse
    {
        try {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin_index')->with('success', trans('messages.auth.successMessage'));
            }
            return redirect()->route('login')->with('error', trans('messages.auth.errorMessage'));
        } catch (Exception) {
            return redirect()->route('login')->with('error', trans('messages.auth.errorException'));
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login')->with('status', 200);
    }
}

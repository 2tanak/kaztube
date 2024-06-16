<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\View;

/**
 * Controller
 */
class RegisterController extends BaseController
{
    public function index(): ViewContract
    {
        return View::make('auth.register');
    }

    /**
     * Сохранение в базу данных пользователя
     */
    public function save(UserRequest $request): RedirectResponse
    {
        try {
            $requestData = $request->all();

            $requestData['password'] = Hash::make($request->password);

            User::create($requestData);

            return redirect()->route('auth.register-form')->with('success', trans('messages.register.successMessage'));
        } catch (Exception) {
            return redirect()->route('auth.register-form')->with('error', trans('messages.register.errorException'));
        }
    }
}

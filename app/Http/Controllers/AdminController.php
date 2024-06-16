<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

/**
 * AdminController
 */
class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        return View::make('admin.index');
    }
}

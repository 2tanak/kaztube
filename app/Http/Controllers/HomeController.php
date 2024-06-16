<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Support\Facades\View;

/**
 * HomeController
 */
class HomeController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return View::make('index', ['videos' => Video::all()]);
    }
}

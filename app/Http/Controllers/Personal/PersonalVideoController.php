<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;

/**
 * VideoController
 */
class PersonalVideoController extends Controller
{
    public function index(): ViewContract
    {
        $videos = User::current()->videos;

        return View::make('personal.video.index', compact('videos'));
    }
}

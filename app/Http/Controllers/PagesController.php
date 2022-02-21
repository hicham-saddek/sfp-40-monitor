<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Variable;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use function inertia;
use const PHP_VERSION;

class PagesController extends Controller
{
    public function welcome()
    {
        return inertia('Welcome')-> with([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function dashboard()
    {
        return inertia('Dashboard')->with([
            'analytics' => [
                [
                    'type' => 'Somme',
                    'name' => 'Nombre de variables monitorer',
                    'value' => Variable::query()->count(),
                ],
                [
                    'type' => 'Somme',
                    'name' => 'Nombre de données stocker',
                    'value' => Data::query()->count(),
                ],
            ],
        ]);
    }
}

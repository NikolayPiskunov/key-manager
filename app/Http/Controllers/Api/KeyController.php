<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Key;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    //

    public function index()
    {
        $app = App::first();
        dd($app->tariffs);
        $keys = Key::all();

        dd($keys);
    }
}

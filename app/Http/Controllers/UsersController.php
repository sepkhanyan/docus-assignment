<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data = User::filter($request->all());

        $type = 'user';
        $count = $data->count();
        $view = view('table',compact('data','type', 'count'))->render();
        return response()->json($view, 200);
    }
}

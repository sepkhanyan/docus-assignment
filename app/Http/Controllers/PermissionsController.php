<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $data = Permission::all();

        $type = 'role';
        $count = $data->count();
        $view = view('table',compact('data','type', 'count'))->render();
        return response()->json($view, 200);
    }
}

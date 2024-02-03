<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('Role.index');
    }

    public function getDataRole()
    {
        $role = Role::all();
        return DataTables::of($role)
            ->addColumn('action', function ($role) {
                return '<a href="" class="btn btn-primary btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Delete</a>';
            })
            ->make(true);
    }
}

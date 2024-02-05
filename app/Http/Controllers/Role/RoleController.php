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

    public function addrole(Request $request)
    {
        try {
            if ($request->role == null) {
                return redirect()->back()->with('error', 'Role tidak boleh kosong');
            }
            if (Role::where('name', $request->role)->exists()) {
                return redirect()->back()->with('error', 'Role sudah ada');
            }
            Role::create([
                'name' => $request->role,
                'guard_name' => 'web'
            ]);
            return redirect()->back()->with('success', 'Role berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Role gagal ditambahkan');
        }
    }
}

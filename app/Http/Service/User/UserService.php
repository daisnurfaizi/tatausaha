<?php

namespace App\Http\Service\User;

use App\Http\Builder\UserEntityBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;

// change to your repository
class UserService
{
    protected $repository;
    public function __construct($repository)
    {
        $this->repository = $repository;
    }

    public function createUser($reqesut)
    {

        try {
            DB::beginTransaction();
            $userBuilder = (new UserEntityBuilder)
                ->setName($reqesut->name)
                ->setEmail($reqesut->email)
                ->setPassword($reqesut->password)
                ->build();
            $user = $this->repository->createUser($userBuilder);
            // dd($user);
            $user->roles()->sync($reqesut->role);
            DB::commit();
            return redirect()->back()->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User creation failed!');
        }
    }

    public function getDataUsers()
    {
        $users = $this->repository->getAll();

        return DataTables::of($users)
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('role', function ($row) {
                $roles = $row->getRoleNames()->first();
                return $roles;
            })
            ->addColumn('action', function ($row) {
                $viewBtn = '<button type="button" class="edit btn btn-primary btn-sm" onclick="editForm(' . $row->id . ')">View</button>';
                $deleteBtn = '<a href="' . route('dashboard.deleteuser', $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>';

                // Hanya menampilkan tombol "View" jika user yang sedang login bukan user yang sedang ditampilkan
                if ($row->id == Auth::user()->id) {
                    return $viewBtn;
                } else {
                    return $viewBtn . ' ' . $deleteBtn;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();
        try {
            $this->repository->delete($id);
            DB::commit();
            return redirect()->back()->with('success', 'User deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User deletion failed!');
        }
    }

    public function getDataUsersById($id)
    {
        $user = $this->repository->getModels()::where('id', $id)->with('roles')->first();
        return $user;
    }

    public function updateUser($request)
    {
        DB::beginTransaction();
        try {
            $user = $this->repository->getModels()::where('id', $request->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $user->roles()->sync($request->role);
            DB::commit();
            return redirect()->back()->with('success', 'User updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User update failed!');
        }
    }
}

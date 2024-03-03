<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function test_spatie(){
        // $role = Role::create(['name' => 'Pembeli']);
        // $permission = Permission::create(['name' => 'Pembeli']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // melihat user siapa yg sedang login saat ini
                // $user = auth()->user();
                // return $user;
        // agar user yg login memiliki role 
        // cara 1       
                // $user = auth()->user();
                // $user->assignRole('Admin');
                // return $user;
        // cara 2
                // $user = User::where('id', 2)->first();
                // $user->assignRole('Pembeli');
                // return $user;
        // menghapus role
        // cara 1
                // $user = auth()->user();
                // $user->removeRole('petugas');
        // cara 2
                // $user = User::where('id', 2)->first();
                // $user->removeRole('petugas');
        // melihat data user beserta rolesnya
                $user = User::with('roles')->get();
                return $user;
    }


    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}

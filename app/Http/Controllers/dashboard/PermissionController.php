<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:inventory.permissions')->only('index');
    }
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::where('name', 'like', '%inventory%')->get();

        return view('dashboard.permissions.index', compact('roles', 'permissions'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function givePermissionToRole(Request $request)
    {

        try {
            $input = $request->all();
            $role = Role::findOrfail($input['roleId']);
            $role->givePermissionTo($input['permission']);
        } catch (\Throwable $th) {
        }
    }

    public function revokePermissionToRole(Request $request)
    {

        try {
            $input = $request->all();
            $role = Role::findOrfail($input['roleId']);
            $role->revokePermissionTo($input['permission']);
        } catch (\Throwable $th) {
        }
    }
}

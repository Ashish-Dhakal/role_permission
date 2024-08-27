<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
       //show the permmission page
       public function index()
       {
              $data['roles'] = Role::orderBy('created_at', 'ASC')->paginate(2);
              return view('role.list', $data);
       }

       public function create()
       {
              $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
              return view('role.create', $data);
       }

       public function store(Request $request)
       {
              $validator =  Validator::make($request->all(), [
                     'name' => 'required|unique:roles|min:3'
              ]);

              if ($validator->passes()) {
                     $role = Role::create(['name' => $request->name]);

                     if (!empty($request->permission)) {
                            foreach ($request->permission as $name) {
                                   $role->givePermissionTo($name);
                            }
                     }

                     return redirect()->route('roles.index')->with('success', 'Role Added Successfully!');
              } else {
                     return redirect()->route('roles.create')->withErrors($validator)->withInput();
              }
       }

       public function edit($id)
       {
              $data['role'] = Role::findorFail($id);
              $data['hasPermissions'] = $data['role']->permissions->pluck('name');
              $data['permissions'] = Permission::orderBy('name', 'ASC')->get();
              return view('role.edit', $data);
       }


       public function update(Request $request, $id)
       {
              $role = Role::findorFail($id);

              $validator =  Validator::make($request->all(), [
                     'name' => 'required|unique:roles,name,' . $id . '|min:3'
              ]);
              if ($validator->passes()) {
                     $role->name = $request->name;
                     $role->save();
                     if (!empty($request->permission)) {
                            $role->syncPermissions($request->permission);
                     } else {
                            $role->syncPermissions([]);
                     }
                     return redirect()->route('roles.index')->with('success', 'Role Updated Successfully!');
              } else {
                     return redirect()->route('roles.edit', $id)->withErrors($validator)->withInput();
              }
       }

       public function destroy(Request $request)
       {
              $role = Role::findorFail($request->id);
              $role->delete();
              return redirect()->route('roles.index')->with('success', 'Role Deleted Successfully!');
       }
}

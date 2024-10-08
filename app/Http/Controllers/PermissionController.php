<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function Pest\Laravel\delete;
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Contracts\Permission;
use Illuminate\Support\Facades\Validator;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('permission:permission crud',only:['create']),
            new Middleware('permission:permission crud',only:['edit']),
            new Middleware('permission:permission crud',only:['index']),
            new Middleware('permission:permission crud',only:['destroy']),
        ];

    }

    //show the permmission page
    public function index()
    {
        $data['permissions'] = Permission::orderBy('created_at', 'ASC')->paginate(15);
        return view('permissions.list', $data);
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|unique:permissions|min:3'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);
            return redirect()->route('permissions.index')->with('success', 'Permission Added Successfully!');
        } else {
            return redirect()->route('permissions.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id)
    {
        // dd('permission edit');
        $data['permission'] = Permission::findorFail($id);
        return view('permissions.edit', $data);
    }

    public function update($id, Request $request)
    {
      

        $permission = Permission::findorFail($id);
        $validator =  Validator::make($request->all(), [
            'name' => 'required|min:3|unique:permissions,name,' . $id . ',id'
        ]);

        if ($validator->passes()) {

            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with('success', 'Permission Updated Successfully!');
        } else {
            return redirect()->route('permissions.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $permission = Permission::find($id);
        if ($permission->id) {
            $permission->delete();
            return redirect()->route('permissions.index')->with(['success' => 'Permission cannot deleted!']);
        }
    }
}

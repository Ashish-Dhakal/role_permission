<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class UserController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            new Middleware('permission:view user', only: ['index']),
            new Middleware('permission:create user', only: ['create']),
            new Middleware('permission:index user', only: ['index']),
            new Middleware('permission:delete user', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['users'] = User::latest()->paginate(10);
        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        return view('users.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        return view('users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('')->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->password);
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::findorFail($id);
        $data['roles'] = Role::orderBy('name', 'ASC')->get();
        $data['hasRoles'] = $data['user']->roles->pluck('id');
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            ',id',
            //         'password' => 'required|min:8',
            //         'role_id' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}

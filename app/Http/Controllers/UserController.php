<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::latest()->paginate('10');
        // $users = User::latest()->get();
        $users = User::with('roles')->get();
        return Inertia::render('User/Index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::latest()->get();
        return Inertia::render('User/Create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        //     'name' => 'required',
        //     'role' => 'required',
        // ]);

        Validator::make($request->all(), [
            'email' => ['required'],
            'password' => ['required'],
            'name' => ['required'],
            'role' => ['required'],
        ])->validate();

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'name' => $request->name,
        ])->assignRole($request->input('role'));

        return redirect()->route('user.index');
        // dd($request->role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $user = User::find($id);
        // return redirect()->route('users.index', []);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $id = $user['id'];
        $userWithRole = User::with('roles')->find($id);
        $roles = Role::latest()->get();
        return Inertia::render('User/Edit', [
            'user' => $userWithRole,
            'roles' => $roles,
        ]);
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
        // $request->validate([
        //     'name' => 'required',
        //     'password' => 'password',
        //     'role' => ['required'],
        // ]);
        
        Validator::make($request->all(), [
            'email' => ['required'],
            'name' => ['required'],
        ])->validate();

        $updatedUser = User::with('roles')->find($id);
        $updatedUser->update($request->all());

        if ($id === 1) {
            //remain admin
        }
        if ($updatedUser->roles[0]->name === 'admin') {
            $updatedUser->removeRole('admin');
            $updatedUser->assignRole($request->input('role'));
        } else {
            $updatedUser->assignRole($request->input('role'));
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index');
    }
}

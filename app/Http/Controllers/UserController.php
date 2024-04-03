<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller 
{
    public function __construct(){
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
        $this->middleware('permission:update user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index(){
        $users = User::get();
        return view('role-permission.user.index',['users' => $users]);
    }

    public function create(){
        $roles = Role::pluck('name','name')->all();              //get() will throw error 
        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request){
        $request->validate([
            'name'=> ['required','string','max:255'],
            'email'=> ['required','email','unique:users,email'],
            'password'=> ['required','string','min:5','max:20'],
            'roles'=>['required']
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),               //'password'=>Hash::make($request->password),
        ]);
        $user->syncRoles($request->roles);
        return redirect('/users')->with('status','User created successfully with roles!!');
    }

    public function edit(User $user){
        $roles = Role::pluck('name','name')->all();
        $userRoles = $user->roles->pluck('name','name')->all();
        return view('role-permission.user.edit', ['user'=>$user, 'roles'=>$roles, 'userRoles'=>$userRoles]);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'name'=> ['required','string','max:255'],
            'password'=> ['nullable','string','min:5','max:20'],
            'roles'=>['required']
        ]);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
        ];
        if(!empty($request->password)){
            $data += [
                'password'=>bcrypt($request->password), 
            ];
        }
        $user->update($data);
        $user->syncRoles($request->roles);
        return redirect('/users')->with('status','User Updated successfully with Roles!!');
    }

    public function destroy($userId){
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect('/users')->with('status','User deleted successfully with Roles!!');
    }

}

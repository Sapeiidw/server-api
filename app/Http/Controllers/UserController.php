<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\DomainCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-user')->only('index','show');
        $this->middleware('permission:update-user')->only('edit','update');
        $this->middleware('permission:delete-user')->only('delete');
        $this->middleware('permission:create-user')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        activity()
        ->performedOn(new User())
        ->causedBy(auth()->user())
        ->log(':causer.name mengunjungi halaman user.');
        $users = User::with('roles')
                ->where('name','like',"%{$request->search}%")
                ->paginate(20);
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck("name");
        return view('pages.user.create', compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new DomainCheck],
            'password' => "required|min:8|confirmed",
        ]);
        $request->role = $request->role !== null ? $request->role : 'user';
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ])->syncRoles($request->role);
        activity()->by(auth()->user())->withProperties($user)->log('Pengguna ini telah menambahkan user');
        return back()->with('success','User Telah Dibuat!!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $activity = Activity::where('causer_id',$user->id)->paginate(20);
        return view('pages.user.show', compact('user','activity'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user->with('roles');
        return view('pages.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => "required|string",
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id, new DomainCheck],
            // "required|email|unique:users,email,".$user->id,
        ]);
        $request->role = $request->role !== null ? $request->role : $user->roles->first()->name;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->syncRoles($request->role);

        return back()->with('success','User Telah Diperbarui!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->foto_profile);
        Activity::where('causer_id','=',$user->id)->delete();
        $user->delete();
        return back()->with('success','User Telah Diperbarui!!');
    }
}

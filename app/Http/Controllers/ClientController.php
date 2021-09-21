<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-client')->only('index','show');
        $this->middleware('permission:update-client')->only('edit','update');
        $this->middleware('permission:delete-client')->only('delete');
        $this->middleware('permission:create-client')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        activity()
        ->performedOn(new Client())
        ->causedBy(auth()->user())
        ->log(':causer.name mengunjungi halaman client.');

        if(auth()->user()->roles->first()->name == 'super-admin'){
            $clients = Client::where('name','like',"%{$request->search}%")->paginate(20);
            return view('pages.client.index', compact('clients'));
        } else {
            $clients = Client::where([
                ['user_id','=',auth()->user()->id],
                ['name','like',"%{$request->search}%"]
                ])->paginate(20);
            return view('pages.client.index', compact('clients'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.client.create');
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
            'name' => 'required|string|unique:oauth_clients',
            'redirect' => 'required|url|string|unique:oauth_clients,redirect',
            'url' => 'required|url|string|unique:oauth_clients,url',
            'thumbnail' => 'nullable|mimes:jpg,bmp,png|max:1024',
            'visibility' => 'required|string',
        ]);
        $thumbnail = request('thumbnail') ? request()->file('thumbnail')->store('images/client') : null;
        $client = Client::create([
            'user_id' => auth()->user()->id,
            'name'=> $request->name,
            'secret' => Str::random(50),
            'slug'=> Str::slug($request->name),
            'redirect'=> $request->redirect,
            'url'=> $request->url,
            'thumbnail'=> $thumbnail,
            'visibility' => $request->visibility,
            "provider" => false,
            "personal_access_client" => false,
            "password_client" => false,
            "revoked" => false,
            ]);

        return redirect(route('client.show',$client->id))->with('success','Client Telah Dibuat!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        if(auth()->user()->roles->first()->name == 'super-admin' or auth()->user()->id == $client->user_id){
            return view('pages.client.show', compact('client'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        if(auth()->user()->roles->first()->name == 'super-admin' or auth()->user()->id == $client->user_id){
            return view('pages.client.edit', compact('client'));
        } else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        if(auth()->user()->roles->first()->name == 'super-admin' or auth()->user()->id == $client->user_id){
            $request->validate([
                'name' => 'required|string|unique:oauth_clients,name,'.$client->id,
                'redirect' => 'required|string|url|unique:oauth_clients,redirect,'.$client->id,
                'url' => 'required|string|url|unique:oauth_clients,url,'.$client->id,
                'thumbnail' => 'nullable|mimes:jpg,bmp,png|max:1024',
                'visibility' => 'required|string',
            ]);
    
            if (request('thumbnail')) {
                if (Storage::exists($client->thumbnail) ) {
                    Storage::delete($client->thumbnail);
                }
                $thumbnail = request()->file('thumbnail')->store('images/client');
            }
            elseif ($client->thumbnail) {
                $thumbnail = $client->thumbnail;
            }
            else {
                $thumbnail = null;
            }
    
            $client->update([
                'name' => $request->name,
                'slug'=> Str::slug($request->name),
                'redirect' => $request->redirect,
                'url' => $request->url,
                'thumbnail' => $thumbnail,
                'visibility' => $request->visibility,
            ]);
    
           return back()->with('success','Client Telah Diperbarui!!');
        } else {
            abort(403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        if(auth()->user()->roles->first()->name == 'super-admin' or auth()->user()->id == $client->user_id){
            Storage::delete($client->thumbnail);
            $client->delete();
            return redirect(route('client.index'))->with('success','Client Telah Dihapus!!');
        } else {
            abort(403);
        }
    }
}

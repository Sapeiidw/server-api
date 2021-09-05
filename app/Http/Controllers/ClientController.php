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
        $this->middleware('permission:edit-client')->only('edit','update');
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
        ->log(':causer.name visited client page.');
        
        $clients = Client::where('name','like',"%{$request->search}%")->paginate(15);
        return view('pages.client.index', compact('clients'));
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
        Client::create([
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

        return back()->with('success','Client was Created!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('pages.client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('pages.client.edit', compact('client'));
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
        
       return back()->with('success','Client was Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Storage::delete($client->thumbnail);
        $client->delete();
        return redirect(route('client.index'))->with('success','Client was Deleted!!');
    }
}

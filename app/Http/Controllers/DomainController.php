<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-domain')->only('index','show');
        $this->middleware('permission:update-domain')->only('edit','update');
        $this->middleware('permission:delete-domain')->only('delete');
        $this->middleware('permission:create-domain')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        activity()
        ->performedOn(new Domain())
        ->causedBy(auth()->user())
        ->log(':causer.name visited domain page.');
        $domains = Domain::where('name','like',"%{$request->search}%")->paginate(20);
        return view('pages.domain.index', compact('domains'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.domain.create');
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
            'name' => 'required|string|unique:domains',
        ]);
        Domain::create(['name'=> $request->name]);
        return back()->with('success','Domain Telah Dibuat!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function show(Domain $domain)
    {
        abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function edit(Domain $domain)
    {
        return view('pages.domain.edit', compact('domain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'name' => 'required|string|unique:domains,name,'.$domain->id,
        ]);

        $domain->update([
            'name' => $request->name,
        ]);

       return back()->with('success','Domain Telah Diperbaharui!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Domain  $domain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Domain $domain)
    {
        $domain->delete();
        return back()->with('success','Domain Telah Dihapus!!');
    }
}

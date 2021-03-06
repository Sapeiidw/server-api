<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-log')->only('index','show');
        $this->middleware('permission:delete-log')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        activity()
        ->performedOn(new Activity())
        ->causedBy(auth()->user())
        ->log(':causer.name mengunjungi halaman log.');
        $logs = Activity::where('log_name','like',"%{$request->search}%")->orderBy('created_at', 'desc')->paginate(20);
        return view('pages.log.index', compact('logs'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Activity::find($id);
        return view('pages.log.show',compact('log'));
    }

    public function destroy($id)
    {
        $log = Activity::find($id);
        $log->delete();
        return back()->with('success','Log Telah Dihapus!!');
    }
}

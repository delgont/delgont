<?php

namespace Delgont\Cms\Http\Controllers\Account;

use Delgont\Cms\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class AccountController extends Controller
{

    public function __construct()
    {
    }
    /**
     * Display admin account info.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = auth()->user();
        $activityLog = $account->activityLog()->orderBy('created_at', 'desc')->limit(2)->get();
        return (request()->expectsJson()) ? response()->json(['account' => $account, 'activityLog' => $activityLog]) : view('delgont::account.index', compact(['account', 'activityLog']));
    }

    public function activityLog()
    {
        $account = auth()->user();
        $activitylog = $account->activitylog()->orderBy('created_at', 'desc')->paginate(4);
        return (request()->expectsJson()) ? response()->json(['account' => $account, 'activitylog' => $activitylog]) :  view('delgont::account.activitylog.index', compact(['account', 'activitylog']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showStatus()
    {
        return view('lad::account.status');
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'password' => 'required|min:6,max:12|confirmed',
        ]);

        auth()->user()->update([
            'password' => bcrypt($request->password)
        ]);
        return ($request->expectsJson()) ? response()->json(['message' => 'Password changed successfully']) : back()->withInput()->with('updated', 'Password changed successfully');
    }

    public function updateAvator(Request $request)
    {
        $request->validate([
            'avator' => 'required||mimes:jpeg,png,jpg|max:2048'
        ]);

        auth()->user()->update([
            'avator' => 'storage/'.request()->avator->store(config('lad.media_dir', 'media/avators'), 'public')
        ]);

        return ($request->expectsJson()) ? response()->json(['hello' => 'hello']) : back()->withInput()->with('updated', 'Avator changed successfully');
    }
    
}

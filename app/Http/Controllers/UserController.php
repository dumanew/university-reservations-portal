<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	$users = User::where('is_archived', 0)->get();
    	return view('users.student-list', [
    	    'users' => $users
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('users.student-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;

        $user->name = $request->name;
        $user->email= $request->email;
        $user->password = bcrypt($request->password);
        $user->user_role = 'student';

        $user->save();
        $request->session()->flash('message', 'The user has been added.');

        return redirect('/student-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.student-edit', [
        	'user' => $user,
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
        $user = User::find($id);

        $user->name = $request->name;
        $user->email= $request->email;

        $user->save();
        $request->session()->flash('message', 'User details have been updated.');

        return redirect('/student-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        $user->is_archived = 1;

        $user->save();
        $request->session()->flash('message', 'The user has been deleted.');

        return redirect('/student-list');
    }   

    public function deleteConfirm($id)
    {
        $user = User::find($id);
        return view('users.student-delete', [
            'user' => $user
        ]);
    }

    
}

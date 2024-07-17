<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Repository\User\GetAllUsers;
use App\Repository\User\GetUser;
use App\Repository\User\UpdateUser;
use App\Models\User;

class UserController extends Controller
{

    public function index(GetAllUsers $request)
    {
        $response = $request->handle();
        return view('user.index', ['users' => $response]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GetUser $request)
    {

        $user_id = auth()->user()->id;
        $currentUserId = $request->id ?? $user_id;

        $user = $request->handle();



        $data = [
            'user' => $user,
            'route' => route('users.update', ['user' => $user_id]),
            'edit' => true,
        ];

        return view('user.info', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id, GetUser $request)
    {
        $user = $request->handle();

        $data = [
            'user' => $user,
            'route' => route('users.update', ['user' => $request->id]),
            'edit' => true,
        ];

        return view('user.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        $response = $request->handle($id);

        if ($request->ajax()) {
            return response()->json(['message' => 'User updated successfully']);
        }

        return redirect()->route('users.show', ['user' => $id]);
    }





}

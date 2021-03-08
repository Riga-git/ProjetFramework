<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        dd(User::where('id', '6')->get());
        $validator = Validator::make($request->all(), [
            'department_id' => 'sometimes|nullable|exists:departments,id',
        ]);

        if ($validator->fails()) {
            $result = response('Validation fail : ' . $validator->failed(), 500);
        } else {
            try {
                if ($request->has('department_id')) {
                    $user->department_id = $request->input('department_id');
                }
                $user->save();
                $result = User::where('id',  $user->id)->get();
            } catch (Throwable $e) {
                $result = response('error during user update : ' . $e, 500);
            }
        }
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * Select all user without a related department.
     * Used by an axios request, don't need a ressource to add external items
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserWithoutDepartment(){
      return User::where('department_id', null)->get();
    }

    public function getAllUsers(){
        return User::all();
    }
}

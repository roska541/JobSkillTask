<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSkill;
use Illuminate\Http\Request;

class UserController extends Controller
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
     * @return \App\Http\Resources\User
     */
    public function store(Request $request)
    {
        //Validate the inputs
        $validated = $request->validate([
            'email' => 'required',
            'name'  => 'required',
            'skills' => 'required'
        ]);

        //If user already exists overwrite the skills
        if($user = User::where('email', $validated['email'])->first()){
            $skills = $user->user_skills ?: [];
            foreach($skills as $s) $s->delete();
        }else{
            $user = new User();
        }

        $user->fill($validated);
        $user->save();

        foreach($validated['skills'] as $skill){
            UserSkill::create([
                'user_id' => $user->id,
                'skill_id' => $skill
            ]);
        }

        return new \App\Http\Resources\User($user);
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
}

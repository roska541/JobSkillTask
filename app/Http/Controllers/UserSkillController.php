<?php

namespace App\Http\Controllers;

use App\User;
use App\UserSkill;
use Illuminate\Http\Request;

class UserSkillController extends Controller
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
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function show(UserSkill $userSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSkill $userSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserSkill  $userSkill
     * @return \App\Http\Resources\UserSkillCollection
     */
    public function update(Request $request, UserSkill $userSkill)
    {
        $validated = $request->validate([
            'email' => 'required',
            'skills' => 'required'
        ]);

        $user = User::where('email' , $validated['email'])->first();

        if(!$user){
            abort(404, 'User cannot be found');
        }

        //Update the ratings of the user skills
        foreach($validated['skills'] as $skill){
            UserSkill::where('skill_id', (int) $skill['id'])
                      ->where('user_id', $user->id)
                      ->update([
                          'rating' => $skill['attributes']['rating']
                      ]);
        }

        $skills = UserSkill::where('user_id', $user->id)->get();

        return new \App\Http\Resources\UserSkillCollection($skills);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserSkill  $userSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSkill $userSkill)
    {
        //
    }
}

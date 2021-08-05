<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobCollection;
use App\Job;
use App\JobSkill;
use App\User;
use App\UserSkill;
use Illuminate\Http\Request;

class JobSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JobCollection
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required'
        ]);

        $user = User::where('email', $validated['email'])->first();

        if(!$user){
            abort(404, 'User not found');
        }

        //Find jobs that fits the skills of the user
        $user_skills = UserSkill::where('user_id', $user->id)
                       ->orderBy('rating', 'asc')
                       ->get()->pluck('skill_id');

        $jobs = $jobs = Job::whereHas('job_skill', function($q) use ($user_skills){
                    $q->whereIn('skill_id', $user_skills);
                    $q->orderByRaw("FIELD(skill_id,".implode(",", $user_skills->toArray()).")");
                })
                ->get();

        return new JobCollection($jobs);
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
     * @param  \App\JobSkill  $jobSkill
     * @return \Illuminate\Http\Response
     */
    public function show(JobSkill $jobSkill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobSkill  $jobSkill
     * @return \Illuminate\Http\Response
     */
    public function edit(JobSkill $jobSkill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobSkill  $jobSkill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobSkill $jobSkill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobSkill  $jobSkill
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobSkill $jobSkill)
    {
        //
    }

}

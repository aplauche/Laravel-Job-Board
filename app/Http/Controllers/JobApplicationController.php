<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create', ['job' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, Request $request)
    {
        $job->jobApplications()->create([
            "user_id" => $request->user()->id,
            // unpack everything you validate into properties (validate returns array of validated fields)
            ...$request->validate([
                'expected_salary' => 'required|min:1|max:10000000'
            ])
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Your application has been submitted!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

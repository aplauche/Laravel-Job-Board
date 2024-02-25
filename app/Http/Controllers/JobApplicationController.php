<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
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

        $this->authorize('apply', $job);

        $validatedData = $request->validate([
            'expected_salary' => 'required|min:1|max:10000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

        $file = $request->file('cv');
        // store in 'cvs' directory inside the 'private' disk eg. store({directory}, {disk})
        $path = $file->store('cvs', 'private');

        $job->jobApplications()->create([
            "user_id" => $request->user()->id,
            "expected_salary" => $validatedData['expected_salary'],
            "cv_path" => $path
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'Your application has been submitted!');
    }
}

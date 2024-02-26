<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // for auth checks if they don't have an object argument you need to pass the class itself
        $this->authorize('viewAny', Job::class);
        $filters = request()->only(
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category',
        );
        $jobs = Job::with('employer')->latest()->filter($filters);

        return view('job.index', ['jobs' => $jobs->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        return view('job.show', [
            // load the employer, and then also load each job by the employer as well!
            'job' => $job->load('employer.jobs'),
        ]);
    }
}

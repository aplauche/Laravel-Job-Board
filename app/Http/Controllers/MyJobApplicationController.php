<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;


class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my_job_application.index', [
            "applications" => auth()->user()->jobApplications()->with([
                'job.employer',
                'job' => fn ($query) => $query->withCount('jobApplications')->withAvg('jobApplications', 'expected_salary')->withTrashed()
                // we added withTrashed to be able to load job data for applications for jobs that have since been deleted
            ])->latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();

        return redirect()->back()->with(
            'success',
            'Job Application Removed'
        );
    }
}

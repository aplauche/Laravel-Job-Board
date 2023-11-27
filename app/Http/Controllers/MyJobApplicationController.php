<?php

namespace App\Http\Controllers;

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
                'job' => fn ($query) => $query->withCount('jobApplications')->withAvg('jobApplications', 'expected_salary')
            ])->latest()->get()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

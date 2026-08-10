<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display all jobs.
     */
    public function index()
    {
        $jobs = Job::latest()->get();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show form for creating a new job.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a new job.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|numeric',
            'job_type' => 'required|string|max:100',
            'skills' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = auth()->id() ?? 1;

        Job::create($validated);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job created successfully!');
    }

    /**
     * Display a single job.
     */
    public function show(Job $job)
    {
        return view('jobs.show', compact('job'));
    }

    /**
     * Show form for editing a job.
     */
    public function edit(Job $job)
    {
        return view('jobs.edit', compact('job'));
    }

    /**
     * Update a job.
     */
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|numeric',
            'job_type' => 'required|string|max:100',
            'skills' => 'nullable|string|max:500',
        ]);

        $job->update($validated);

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job updated successfully!');
    }

    /**
     * Delete a job.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job deleted successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $courses = Course::paginate(10);

        return Inertia::render('Courses/Index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Courses/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Inertia\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create([
            'name'          => $request->name,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
        ]);

        return redirect()->back()->with('success', 'Course created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function show(Course $course)
    {
        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function edit(Course $course)
    {
        return Inertia::render('Courses/Edit', [
            'course' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->name       = $request->name;
        $course->start_date = $request->start_date;
        $course->end_date   = $request->end_date;

        $course->update();

        return redirect()->back()->with('success', 'Course updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->back()->with('success', 'Course deleted.');
    }
}

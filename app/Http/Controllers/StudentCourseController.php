<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Inertia\Inertia;

class StudentCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Inertia\Response
     */
    public function index(Student $student)
    {
        $courses = Course::orderBy('id')->all();
        $student = Student::with('courses.schedules')->find($student->id);

        return Inertia::render('StudentCourses/Index', [
            'courses' => $courses,
            'student' => $student,
        ]);
    }

    /**
     * Attach the specified resource in storage.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function attach(Student $student, Course $course)
    {
        if (! $student->courses->contains($course)) {
            $student->courses()->attach($course->id);

            return redirect()->back()->with('success', 'Course added.');
        }

        return redirect()->back()->with('error', 'The course exists.');
    }

    /**
     * Detach the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function detach(Student $student, Course $course)
    {
        $student->courses()->detach($course->id);

        return redirect()->back()->with('success', 'Course removed.');
    }
}

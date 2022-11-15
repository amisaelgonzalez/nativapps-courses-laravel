<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Dashboard', [
            'top_courses'   => $this->topCourses(3),
            'top_students'  => $this->topStudents(3),
        ]);
    }

    /**
     * Courses with more students.
     *
     * @return \App\Models\Course[]
     */
    public function topCourses($limit)
    {
        return Course::withCount(['students'])
                    ->orderBy('students_count', 'desc')
                    ->limit($limit)
                    ->get();
    }

    /**
     * Students with more courses.
     *
     * @return \App\Models\Student[]
     */
    public function topStudents($limit)
    {
        return Student::withCount(['courses'])
                    ->orderBy('courses_count', 'desc')
                    ->limit($limit)
                    ->get();
    }
}

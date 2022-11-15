<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $students = Student::orderBy('id')->paginate(10);

        return Inertia::render('Students/Index', [
            'students' => $students,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Students/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Inertia\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create([
            'name'      => $request->name,
            'lastname'  => $request->lastname,
            'email'     => $request->email,
            'birthday'  => $request->birthday,
        ]);

        return redirect()->back()->with('success', 'Student created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Inertia\Response
     */
    public function show(Student $student)
    {
        return Inertia::render('Students/Show', [
            'student' => $student,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Inertia\Response
     */
    public function edit(Student $student)
    {
        return Inertia::render('Students/Edit', [
            'student' => $student,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Inertia\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->name      = $request->name;
        $student->lastname  = $request->lastname;
        $student->email     = $request->email;
        $student->birthday  = $request->birthday;

        $student->update();

        return redirect()->back()->with('success', 'Student updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Inertia\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Course;
use App\Models\Schedule;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function index(Course $course)
    {
        $schedules = Schedule::where('course_id', $course->id)->get();

        return Inertia::render('Schedules/Index', [
            'course'    => $course,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function create(Course $course)
    {
        return Inertia::render('Schedules/Create', [
            'course'            => $course,
            'schedule_hours'    => $this->getHours(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function store(StoreScheduleRequest $request, Course $course)
    {
        $schedule = $course->schedules()->create([
            'start_time'    => $request->start_time,
            'end_time'      => $request->end_time,
            'monday'        => $request->monday,
            'tuesday'       => $request->tuesday,
            'wednesday'     => $request->wednesday,
            'thursday'      => $request->thursday,
            'friday'        => $request->friday,
            'saturday'      => $request->saturday,
            'sunday'        => $request->sunday,
            'status'        => $request->status,
        ]);

        return redirect()->back()->with('success', 'Schedule created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Schedule  $schedule
     * @return \Inertia\Response
     */
    public function show(Course $course, Schedule $schedule)
    {
        return Inertia::render('Schedules/Show', [
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Schedule  $schedule
     * @return \Inertia\Response
     */
    public function edit(Course $course, Schedule $schedule)
    {
        return Inertia::render('Schedules/Edit', [
            'course'            => $course,
            'schedule'          => $schedule,
            'schedule_hours'    => $this->getHours(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleRequest  $request
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Schedule  $schedule
     * @return \Inertia\Response
     */
    public function update(UpdateScheduleRequest $request, Course $course, Schedule $schedule)
    {
        $schedule->start_time   = $request->start_time;
        $schedule->end_time     = $request->end_time;
        $schedule->monday       = $request->monday;
        $schedule->tuesday      = $request->tuesday;
        $schedule->wednesday    = $request->wednesday;
        $schedule->thursday     = $request->thursday;
        $schedule->friday       = $request->friday;
        $schedule->saturday     = $request->saturday;
        $schedule->sunday       = $request->sunday;

        $schedule->update();

        return redirect()->back()->with('success', 'Schedule updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @param  \App\Models\Schedule  $schedule
     * @return \Inertia\Response
     */
    public function destroy(Course $course, Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()->with('success', 'Schedule deleted.');
    }

    /**
     * Blocks of hours for schedules.
     *
     * @return Array
     */
    public function getHours()
    {
        $hours = [];
        for ($i = 0; $i < 24; $i++) {
            $hours[] = [
                'value' => sprintf('%02d:00:00', $i),
                'text'  => sprintf('%02d:00 %s', $i, $i < 12 ? 'AM' : 'PM')
            ];
            $hours[] = [
                'value' => sprintf('%02d:30:00', $i),
                'text'  => sprintf('%02d:30 %s', $i, $i < 12 ? 'AM' : 'PM')
            ];
        }
        return $hours;
    }
}

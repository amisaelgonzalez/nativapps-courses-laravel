<?php

namespace Tests\Feature\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'name'  => 'admin',
            'email' => 'admin@admin.com',
        ]);

        $this->course = Course::factory()->create([
            'name'          => 'Spanish',
            'start_date'    => '2021-02-19',
            'end_date'      => '2021-05-19',
        ]);
    }

    public function test_can_view_courses()
    {
        $this->actingAs($this->user)
            ->get(route('courses.index'))
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Courses/Index')
                ->has('courses.data', 1)
                ->has('courses.data.0', fn (Assert $assert) => $assert
                    ->where('id', 1)
                    ->where('name', 'Spanish')
                    ->where('start_date', '2021-02-19')
                    ->where('end_date', '2021-05-19')
                    ->etc()
                )
            );
    }

    public function test_can_view_create_course()
    {
        $this->actingAs($this->user)
            ->get(route('courses.create'))
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Courses/Create')
            );
    }

    public function test_can_store_course()
    {
        $form = [
            'name'          => 'Mathematics',
            'start_date'    => '2021-02-19',
            'end_date'      => '2021-05-19',
        ];

        $this->actingAs($this->user)
            ->post(route('courses.store', $form))
            ->assertRedirect();
    }

    public function test_can_view_edit_course()
    {
        $this->actingAs($this->user)
            ->get(route('courses.edit', $this->course->id))
            ->assertInertia(fn (Assert $assert) => $assert
                ->component('Courses/Edit')
                ->has('course', fn (Assert $assert) => $assert
                    ->where('id', $this->course->id)
                    ->where('name','Spanish')
                    ->where('start_date', '2021-02-19')
                    ->where('end_date', '2021-05-19')
                    ->etc()
                )
            );
    }

    public function test_can_view_update_course()
    {
        $form = [
            'name'          => 'English',
            'start_date'    => '2023-06-20',
            'end_date'      => '2023-09-20',
        ];

        $this->actingAs($this->user)
            ->put(route('courses.update', $this->course->id), $form)
            ->assertRedirect();

    }

    public function test_can_delete_course()
    {
        $course = Course::factory()->create();

        $this->actingAs($this->user)
            ->delete(route('courses.destroy', $course->id))
            ->assertRedirect();
    }
}

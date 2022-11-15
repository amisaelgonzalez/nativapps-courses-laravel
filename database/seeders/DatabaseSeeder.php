<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Database\Seeder;

use function GuzzleHttp\Promise\each;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        collect(range(1, 15))->each(function () {
            Course::factory()
                    ->has(Schedule::factory()->times(random_int(1, 3)))
                    ->has(Student::factory()->times(random_int(15, 30)))
                    ->create();
        });
    }
}

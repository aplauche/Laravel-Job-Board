<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'anton',
            'email' => 'anton@example.com',
        ]);

        \App\Models\User::factory(100)->create();

        $users = \App\Models\User::all()->shuffle();

        // Create Employers
        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create([
                // grab user from beg. and remove from list
                "user_id" => $users->pop()->id
            ]);
        }

        // Create Jobs
        $employers = Employer::all();

        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                "employer_id" => $employers->random()->id
            ]);
        }


        // Create applications
        foreach ($users as $user) {
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                JobApplication::factory()->create([
                    "user_id" => $user->id,
                    "job_id" => $job->id,
                ]);
            }
        }
    }
}

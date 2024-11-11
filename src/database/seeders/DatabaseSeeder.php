<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create()->each(function ($user) {
            $dates = collect();
            for ($i = 0; $i < 30; $i++) {
                $dates->push(now()->subDays($i)->format('Y-m-d'));
            }

            $dates->each(function ($date) use ($user) {
                if (rand(1, 10) <= 7) {
                    Attendance::factory()->create([
                        'user_id' => $user->id,
                        'date' => $date,
                    ]);
                }
            });
        });
    }
}

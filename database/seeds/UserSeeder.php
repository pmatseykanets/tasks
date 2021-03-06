<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ])->each(function ($u) {
            foreach (range(1, 10) as $item) {
                $u->tasks()->save(factory(App\Task::class)->make());
            }
        });

        factory(App\User::class, 5)->create()->each(function ($u) {
//            $u->tasks()->save(factory(App\Post::class)->make());
        });
    }
}

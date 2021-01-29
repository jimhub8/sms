<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function run()
    {
        $roles = ['Admin', 'Call Center', 'Rider Manager'];

        $faker = \Faker\Factory::create();
        foreach (range(1, 4) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'role' => $roles[array_rand($roles)],
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
        }
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserAdminFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // You can change this default password
            'remember_token' => Str::random(10),
            'role' => 'admin',
        ];
    }
}

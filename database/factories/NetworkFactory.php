<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NetworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'net_addr' => '62.206.254.192',
            'netmask' => '27',
            'broadcast_addr' => '62.206.254.223',
            'maxhost' => 30,
            'acthost' => 0,
            'created_by' => User::first()->id,
            'edited_by' => User::first()->id,
            'created_at' => now()
        ];
    }
}

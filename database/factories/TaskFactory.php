<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $priorities = ['urgent','normal','test'];
        return [
            'task_name'=>$this->faker->name(),
            'employee_name'=>$this->faker->name(),
            'department'=>$this->faker->userName,
            'branch'=>$this->faker->city(),
            'due_date'=>$this->faker->date(),
            'priority'=>$priorities[array_rand($priorities,1)],
        ];
    }
}

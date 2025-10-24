<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static ?string $password;

    public function definition(): array
    {
        return [
          'name'=> $this->faker->name(),
          'phone'=>$this->faker->phoneNumber(),
          'email'=>$this->faker->unique()->safeEmail,
          'password'=>static::$password??=Hash::make('password'),
          'id_image'=>'uploads/ids'.Str::random(10).'jpg',
          'verification_report'=>'uploads/reports'.Str::random(10).'jpg',
          'home_city'=>$this->faker->city(),
          'school_year'=>$this->faker->randomElement([1,2,3,4,5])
 
        ];
    }


    public function verified (): static 
    {
    return $this->state(fn(array $attributes)
    =>['verified'=>true]);
}}
/**
 * state() overrides specific fields of the default definition.
*So instead of repeating the whole array, you just change what’s different.
 */
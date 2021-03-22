<?php

namespace Database\Factories;

use App\Models\PersonResume;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PersonResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonResume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'email' => $this->faker->email,
            'phone' => '(68) ' . $this->faker->cellphone,
            'required_position' =>  Str::random(7),
            'education_level_id' =>  rand(1,8),
            'obs' =>  Str::random(10),
//            'file' =>  'resume/lucas_aguiar21-03-202107_41_06.pdf',
//            'file' => \Illuminate\Http\UploadedFile::fake()->create('test.pdf')->store('resumes'),
            'host_ip_address' => $this->faker->ipv4
        ];
    }
}

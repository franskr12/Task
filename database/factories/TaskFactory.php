<?php
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), // Ganti sesuai kebutuhan
            'image' => $this->faker->image('public/tasks', 400, 300, null, false),
            'nama' => $this->faker->text(50),
            'deskripsi' => $this->faker->text(200),
            'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}

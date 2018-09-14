<?php

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

use App\TaskGroup;
use App\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TaskGroup::truncate();
        Task::truncate();

        $faker = FakerFactory::create('ja_JP');

        for ($i = 1; $i <= 5; $i++) {
            $task_group = new TaskGroup();
            $task_group->name = $faker->name;
            $task_group->sort = $i;
            $task_group->created_at = $faker->dateTimeThisYear();
            $task_group->updated_at = $faker->dateTimeThisYear();
            $task_group->deleted_at = mt_rand(0,5) ? null : $faker->dateTimeThisYear();
            $task_group->save();

            for ($j = 1; $j <= 10; $j++) {
                $task = new Task();
                $task->task_groups_id = $task_group->id;
                $task->content = $faker->realText(20);
                $task->sort = $j;
                $task->created_at = $faker->dateTimeThisYear();
                $task->updated_at = $faker->dateTimeThisYear();
                $task->deleted_at = mt_rand(0,5) ? null : $faker->dateTimeThisYear();
                $task->save();
            }
        }
    }
}

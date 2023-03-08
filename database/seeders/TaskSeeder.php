<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Task::create([
            'user_id' => 1,
            'title' => 'Tarefa 1',
            'description' => 'Descrição da tarefa 1'
        ]);
        \App\Models\Task::create([
            'user_id' => 1,
            'title' => 'Tarefa 2',
            'description' => 'Descrição da tarefa 2'
        ]);
        \App\Models\Task::create([
            'user_id' => 1,
            'title' => 'Tarefa 3',
            'description' => 'Descrição da tarefa 3'
        ]);
    }
}

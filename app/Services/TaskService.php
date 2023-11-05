<?php

namespace App\Services;

use function is_integer;

use App\Interfaces\TaskServiceInterface;
use App\Models\Task;

Class TaskService implements TaskServiceInterface
{
    public function all()
    {
        $task = Task::orderBy('id', 'desc')->get();
        return $task;
    }

    public function store(array $attributes)
    {
        $task =  Task::create($attributes);
        return $task;
    }

    public function find(int $id)
    {
        $task = Task::find($id);
        return $task;
    }

    public function update(array $attributes, int $id)
    {
        $task = Task::find($id);
        $updatedTask = $task->update($attributes);
        return $updatedTask;
    }

    //Move To Trash
    public function delete(int $id)
    {
        $item = Task::find($id);
        $item->delete($item);
        return $item;
    }

}

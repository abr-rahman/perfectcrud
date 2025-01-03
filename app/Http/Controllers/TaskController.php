<?php

namespace App\Http\Controllers;

use App\DataTables\TaskDataTable;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\TaskServiceInterface;
use App\Models\User;
use App\Notifications\AlertNotification;
use App\Utils\FileUploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request, TaskDataTable $dtaTable)
    {
        return $dtaTable->render('tasks.index');
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request, FileUploader $uploader)
    {

        $user = User::first();
        Notification::send($user, new AlertNotification);

        $task = $this->taskService->store($request->validated());

        // return response()->json('Task created successfully');
        return back()->with('success', 'Task created successfully!');
    }

    public function edit($id)
    {
        $task = $this->taskService->find($id);
        $task->image = (str_starts_with($task->image, 'http')) ? $task->image : asset('uploads/task/' . $task->image);
        return view('tasks.edit', compact('task'));
    }

    public function update(UpdateTaskRequest $request, $id, FileUploader $uploader)
    {
        $update = Task::find($id);
        $update->name = $request->name;
        $update->phone = $request->phone;
        $update->description = $request->description;

        if ($request->hasFile('image')) {
            $newFile = $uploader->upload($request->file('image'), 'uploads/task/', 600, 400);
            if ((isset($update->image) && isset($newFile))) {
                $existingFile = public_path('uploads/task/' . $update->image);
                if (\file_exists($existingFile)) {
                    unlink($existingFile);
                }
                $update->image = $newFile;
            }
        }
        $update->save();

        return back()->with('success', 'Updated successfully!');
    }

    public function destroy(Task $task)
    {
        if (!$task->image == null) {
            $existingFile = \public_path('uploads/task/' . $task->image);

            if (file_exists($existingFile)) {
                unlink($existingFile);
            }
        }
        $task->delete();
        return response()->json('Deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\TaskDataTable;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Utils\FileUploader;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TaskDataTable $dtaTable)
    {
        return $dtaTable->render('tasks.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request, FileUploader $uploader)
    {
        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = $uploader->upload($request->file('image'), 'uploads/task/', 600, 400);
        }
        Task::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'image' => $imageName,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $task = Task::find($id);
        $task->image = (str_starts_with($task->image, 'http')) ? $task->image : asset('uploads/task/' . $task->image);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, $id, FileUploader $uploader)
    {
        $update = Task::find($id);
        $update->name = $request->name;
        $update->phone = $request->phone;
        $update->description = $request->description;

        if ($request->hasFile('image')) {
            $newFile = $uploader->upload($request->file('image'), 'uploads/task/', 1090, 413);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $existingFile = public_path('uploads/task/' . $task->image);

        if (\file_exists($existingFile)) {
            unlink($existingFile);
        }
        $task->delete();

        return response()->json('Deleted successfully!');
    }
}

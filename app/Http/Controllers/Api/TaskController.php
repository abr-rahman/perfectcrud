<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Interfaces\TaskServiceInterface;
use App\Services\TaskService;
use App\Utils\ApiResponseClass;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index()
    {
        $data = $this->taskService->all();
        return ApiResponseClass::sendResponse(TaskCollection::collection($data), '', 200);
        // return TaskCollection::collection($data);
    }

    public function store(StoreTaskRequest $request)
    {
        try {
            $data = $this->taskService->store($request->validated());
            return ApiResponseClass::sendResponse(new TaskCollection($data), 'Task Create Successful', 201);
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }

    public function show($id)
    {
        try {
            $data = $this->taskService->find($id);
            return ApiResponseClass::sendResponse(new TaskCollection($data), '', 200);
        } catch (\Throwable $th) {
            return ApiResponseClass::rollback($th);
        }
    }
    public function update(UpdateTaskRequest $request, $id)
    {
        try {
            $this->taskService->update($request->all(), $id);
            return ApiResponseClass::sendResponse('Task updated successfull', 201);
        } catch (\Throwable $th) {
            return ApiResponseClass::rollback($th);
        }
    }

    public function destroy($id)
    {
        try {
            $this->taskService->delete($id);
            return ApiResponseClass::sendResponse('Task Deleted successfull', 204);
        } catch (\Throwable $th) {
            return ApiResponseClass::rollback($th);
        }
    }
}

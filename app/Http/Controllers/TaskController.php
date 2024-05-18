<?php

namespace App\Http\Controllers;

use App\Domain\DTO\TaskDTO;
use App\Http\Requests\Task\IndexTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $taskService;

    /**
     * @param TaskService $taskService
     */
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * get tasks by filter
     *
     * @param IndexTaskRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexTaskRequest $request): \Illuminate\Http\JsonResponse
    {
        $filters = $request->only(['status', 'priority', 'search']);
        $sorts = $request->input('sort_by', []);
        if (!is_array($sorts)) {
            $sorts = explode(',', $sorts);
        }

        if (Auth::check()) {
            $userId = Auth::id();

            $tasks = $this->taskService->getTasks($filters, $sorts, $userId);

            return response()->json(['tasks' => $tasks]);

        } else {
            return response()->json(['message' => 'User is not authenticated'], 403);
        }

    }

    /**
     * create new task
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $taskDTO = new TaskDTO(
            $request->input('title'),
            Auth::id(),
            $request->input('description'),
            $request->input('priority'),
            $request->input('status'),
            $request->input('createdAt'),
            $request->input('completedAt')
        );

        $this->taskService->createTask($taskDTO);

        return response()->json(['message' => 'Task created successfully'], 201);
    }

    /**
     * update task
     *
     * @param Request $request
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, int $taskId): \Illuminate\Http\JsonResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:todo,done',
            'priority' => 'required|integer|min:1|max:5',
        ]);

        $taskDTO = new TaskDTO(
            $validatedData['title'],
            Auth::id(),
            $validatedData['description'],
            $validatedData['priority'],
            $validatedData['status'],
        );

        try {
            $updatedTask = $this->taskService->updateTask($taskId, $taskDTO);

            return response()->json(['task' => $updatedTask], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * delete task
     *
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(int $taskId): \Illuminate\Http\JsonResponse
    {
        try {
            $this->taskService->deleteTask($taskId);

            return response()->json(['message' => 'Task deleted successfully'], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * complete task
     *
     * @param int $taskId
     * @return \Illuminate\Http\JsonResponse
     */
    public function complete(int $taskId): \Illuminate\Http\JsonResponse
    {
        try {
            $completedTask = $this->taskService->completeTask($taskId);

            return response()->json(['task' => $completedTask], 200);
        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        return response()->json($user->tasks, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $new_task = new Task();
        $request->validate($new_task->rules(), $new_task->feedbacks());
        $new_task->fill($request->only('title', 'description', 'status'));

        $user = User::find(auth()->user()->id);
        return response()->json($user->tasks()->save($new_task), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $task_id)
    {
        $task = Task::find($task_id);
        if (is_null($task)) {
            return response()->json(['message' => 'Tarefa não encontrada.'], 404);
        }

        $user = User::find(auth()->user()->id);
        if ($user != $task->user) {
            return response()->json(['message' => 'Você não tem permissão para acessar essa tarefa.'], 403);
        }

        return response()->json($task->getAttributes(), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $task_id)
    {
        $task = Task::find($task_id);
        if (is_null($task)) {
            return response()->json(['message' => 'Tarefa não encontrada.'], 404);
        }

        $user = User::find(auth()->user()->id);
        if ($user != $task->user) {
            return response()->json(['message' => 'Você não tem permissão para acessar essa tarefa.'], 403);
        }

        $rules = $task->rules();
        $feedbacks = $task->feedbacks();

        if ($request->method() == 'PATCH') {
            $fields_to_validate = array_keys($request->all());

            $rules = $task->getRulesForPatchUpdate($fields_to_validate);
            $feedbacks = $task->getFeedbacksForPatchUpdate($fields_to_validate);
        }

        $request->validate($rules, $feedbacks);

        $task->fill($request->all());
        $task->save();

        return response()->json($task->getAttributes(), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $task_id)
    {
        $task = Task::find($task_id);
        if (is_null($task)) {
            return response()->json(['message' => 'Tarefa não encontrada.'], 404);
        }

        $user = User::find(auth()->user()->id);
        if ($user != $task->user) {
            return response()->json(['message' => 'Você não tem permissão para acessar essa tarefa.'], 403);
        }

        if (!$task->delete()) {
            return response()->json(['message' => 'Não foi possível excluír a tarefa.'], 409);
        }

        return response()->json(['message' => 'Tarefa excluída com sucesso!'], 200);
    }
}

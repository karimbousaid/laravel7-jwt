<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'active' => 'required',
        ]);
    
        $task = new Task();
        $task->content = $request->content;
        $task->active = $request->active;
        $task->save();
        if ($task)
            return response()->json([
                'success' => true,
                'task' => $task
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task could not be added.'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $this->validate($request, [
            'content' => 'required',
            'active' => 'required',
        ]);
    
        $task =Task::find($task->id);
        if ($task)
            return response()->json([
                'success' => true,
                'task' => $task
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task could not be added.'
            ], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'content' => 'required',
            'active' => 'required',
        ]);
    
        $task =Task::find($id);
        $task->content = $request->content;
        $task->active = $request->active;
        $task->save();
        if ($task)
            return response()->json([
                'success' => true,
                'task' => $task
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task =Task::find($id);
        $task->delete();

        if ($task->delete()) {
            return response()->json([
                'success' => true
            ]);
        }
    }
}

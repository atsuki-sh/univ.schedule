<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    // ログイン済みのユーザー以外はログイン画面へリダイレクト
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($user_id)
    {
        $auth_id = strval(Auth::id());

        if($user_id === $auth_id) {
            $user = User::find($user_id);
            $tasks = User::find($user_id)->tasks;
            $course_titles = User::find($user_id)->courses->pluck('title');
            $course_indexes = User::find($user_id)->courses->pluck('course_index');
            $urls = [
                'index' => route('task.index', ['user_id' => $auth_id]),
                'create' => route('task.create', ['user_id' => $auth_id]),
                'update' => route('task.update', ['user_id' => $auth_id]),
                'delete' => route('task.delete', ['user_id' => $auth_id]),
            ];

            return view('task',
                [
                    'user'=>$user,
                    'tasks'=>$tasks,
                    'course_titles'=>$course_titles,
                    'course_indexes'=>$course_indexes,
                    'urls' => $urls,
                ]);
        }
        else {
            return redirect()->route('task.index', ['user_id' => $auth_id]);
        }
    }

    public function create($user_id, TaskRequest $request)
    {
        $task = new Task();

        $task->user_id = $user_id;
        $task->course_index = $request->course_index;
        $task->course = $request->course;
        $task->title = $request->title;
        $task->note = $request->note;
        $task->due_date = $request->due_date;
        $task->status = $request->status;

        $task->save();
    }

    public function update($user_id, TaskRequest $request)
    {
        $task = User::find($user_id)->tasks()->where('course_index', $request->course_index);

        $task->update([
            'course_index' => $request->course_index,
            'course' => $request->course,
            'title' => $request->title,
            'note' => $request->note,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function delete($user_id, Request $request)
    {
        $task = User::find($user_id)->tasks()->where('task_id', $request->task_id);
        $task->delete();
    }
}

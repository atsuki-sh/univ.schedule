<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
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

            return view('task', ['user'=>$user, 'tasks'=>$tasks]);
        }
    }
}

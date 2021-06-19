<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;

class CourseController extends Controller
{
    public function show() {
        // ログインしているユーザーのコースをすべて取得
        $user = Auth::user();
        $courses = User::find($user->id)->courses;
//        dd($courses[0]->title);

        // コースをscheduleテンプレートに渡し、scheduleを表示
        return view('schedule', ['courses'=>$courses, 'user'=>$user]);
    }
}

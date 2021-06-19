<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function show() {
        // ログインしているユーザーのコースをすべて取得
        $user = Auth::user();
        $courses = $user->course();

        // コースをscheduleテンプレートに渡し、scheduleを表示
        return view('schedule', ['courses'=>$courses, 'user'=>$user]);
    }
}

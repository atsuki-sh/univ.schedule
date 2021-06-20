<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class CourseController extends Controller
{
    // ログイン済みのユーザー以外はログイン画面へリダイレクト
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show() {
        // ログインしているユーザーのコースをすべて取得
        $user = Auth::user();
        $courses = User::find($user->id)->courses;
//        dd($courses[0]->title);

        // コースをscheduleテンプレートに渡し、scheduleを表示
        return view('schedule', ['courses'=>$courses, 'user'=>$user]);
    }

    public function create(Request $request)
    {
        $user_id = Auth::id();
        $course = new Course();

        $course->user_id = $user_id;
        $course->course_index = $request->course_index;
        $course->title = $request->title;
        $course->note = $request->note;
        $course->place = $request->place;
        $course->teacher = $request->teacher;

        $course->save();
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $course = User::find($user->id)->courses()->where('course_index', $request->course_index);
        $course->update([
            'title' => $request->title,
            'note' => $request->note,
            'place' => $request->place,
            'teacher' => $request->teacher,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $course = User::find($user->id)->courses()->where('course_index', $request->course_index);
        $course->delete();
    }
}

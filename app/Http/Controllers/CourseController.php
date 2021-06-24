<?php

namespace App\Http\Controllers;

use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;
use Psy\Util\Str;

class CourseController extends Controller
{
    // ログイン済みのユーザー以外はログイン画面へリダイレクト
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($user_id) {
        $auth_id = strval(Auth::id());

        // urlのidがログインしているユーザーと一緒ならviewを表示
        // そうでないならログイン中のユーザーのページにリダイレクト
        if($user_id === $auth_id) {
            $user = User::find($user_id);
            $courses = User::find($user_id)->courses;
            $urls = array(
                'index' => url("{$user_id}/schedule"),
                'create' => url("{$user_id}/schedule/create"),
                'update' => url("{$user_id}/schedule/update"),
                'delete' => url("{$user_id}/schedule/delete"),
            );

            // コースをscheduleテンプレートに渡し、scheduleを表示
            return view('schedule', ['courses'=>$courses, 'user'=>$user, 'urls'=>$urls]);
        }
        else {
            return redirect()->route('course.index', ['user_id' => $auth_id]);
        }
    }

    public function create($user_id, Request $request)
    {
        $course = new Course();

        $course->user_id = $user_id;
        $course->course_index = $request->course_index;
        $course->title = $request->title;
        $course->note = $request->note;
        $course->place = $request->place;
        $course->teacher = $request->teacher;

        $course->save();
    }

    public function update($user_id, Request $request)
    {
        $user = User::find($user_id);
        $course = User::find($user->id)->courses()->where('course_index', $request->course_index);
        $course->update([
            'title' => $request->title,
            'note' => $request->note,
            'place' => $request->place,
            'teacher' => $request->teacher,
            'updated_at' => Carbon::now(),
        ]);
    }

    public function delete($user_id, Request $request)
    {
        $course = User::find($user_id)->courses()->where('course_index', $request->course_index);
        $course->delete();
    }
}

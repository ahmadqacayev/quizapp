<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use App\Models\Quiz;

class ExamController extends Controller
{
    public function create(){
        return view('backend.exam.create');
    }

    public function assignExam(Request $request){
        $quiz = (new Quiz)->assignExam($request->all());
        return redirect()->back()->with('message','Exam assigned to user successfully!');
    }

    public function userExam(Request $request){
        $quizzes = Quiz::get();
        return view('backend.exam.index', compact('quizzes'));
    }

    public function removeExam(Request $request){
        $userId = $request->get('user_id');
        $quizId = $request->get('quiz_id');
        $quiz = Quiz::find($quizId);
        $result = Result::where('quiz_id',$quizId)->where('user_id',$userId)->exists();
        if ($result){
            return redirect()->back()->with('message', 'This quiz is played by user so it cannot be removed!');
        }else{
            $quiz->users()->detach($userId);
            return redirect()->back()->with('message', 'Exam is now not assigned to that user!');
        }
    }
}

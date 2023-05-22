<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Answer;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = (new Question)->getQuestions();
        return view('backend.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->validateForm($request);
        $question = (new Question)->storeQuestion($data);
        $answer = (new Answer)->storeAnswer($data,$question);

        return redirect()->route('question.create')->with('message','Question created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $question = (new Question)->getQuestionById($id);
        return view('backend.question.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = (new Question)->findQuestion($id);
        return view('backend.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $this->validateForm($request);
        $question = (new Question)->updateQuestion($id,$request);
        $answer = (new Answer)->updateAnswer($request,$question);
        return redirect()->route('question.show',$id)->with('message','Question updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        (new Answer)->deleteAnswer($id);
        (new Question)->deleteQuestion($id);
        return redirect()->route('question.index')->with('message','Question deleted successfully!');
    }

    public function validateForm($request){
        return $request->validate([
            'quiz'=>'required',
            'question'=>'required|min:3',
            'options'=>'bail|required|array|min:3',
            'options.*'=>'bail|required|string|distinct',
            'correct_answer'=>'required'
        ]);
    }
}

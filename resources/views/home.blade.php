@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if($isExamAssigned)
                    @foreach($quizzes as $quiz)
                        <div class="card-body">
                            <p><h3>{{$quiz->name}}</h3></p>
                            <p>About Exam: {{$quiz->description}}</p>
                            <p>Time allocated: {{$quiz->minutes}} minutes</p>
                            <p>Number of questions: {{$quiz->questions->count()}}</p>
                            <p>
                                @if(!in_array($quiz->id,$wasQuizCompleted))
                                    <a href="">
                                        <button class="btn btn-success">Start Quiz</button>
                                    </a>

                                @else
                                    <span class="float-end">Completed</span>
                                @endif
                            </p>
                        </div>
                    @endforeach
                @else
                    <p>You have not assigned any exam</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

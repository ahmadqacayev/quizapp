@extends('backend.layouts.master')

@section('title','create quiz')
@section('content')

    <div class="span9">
        <div class="content">

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif

            <div class="module">
                <div class="module-head">
                    <h3>User Exam</h3>
                </div>
                <div class="module-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quiz</th>

                        </tr>
                        </thead>

                        <tbody>

                        @if(count($quizzes) > 0)
                            @foreach($quizzes as $quiz)
                                @foreach($quiz->users as $user)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$quiz->name}}</td>
                                        <td><a href="{{route('quiz.question', $quiz->id)}}"> <button class="btn btn-inverse">View Questions</button></a>

                                        </td>

                                        <td>
                                            <form action="{{route('exam.remove')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                                <button class="btn btn-danger" type="submit">Remove</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <td>No user to display</td>
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>


        </div>
    </div>

@endsection


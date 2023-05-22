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
                    <h3>All Questions</h3>
                </div>
                <div class="module-body">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Question</th>
                            <th scope="col">Quiz</th>
                            <th scope="col">Created</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>

                        @if(count($questions) > 0)
                            @foreach($questions as $question)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$question->question}}</td>
                                    <td>{{$question->quiz->name}}</td>
                                    <td>{{date('F d,Y',strtotime($question->created_at))}}</td>
                                    <td><a href="{{route('question.show',$question->id)}}"><button class="btn btn-info">View</button></a></td>
                                    <td>
                                        <a href="{{route('question.edit',$question->id)}}"><button class="btn btn-primary">Edit</button></a>
                                    </td>
                                    <td>
                                        <form id="delete-form{{$question->id}}" method="POST" action="{{route('question.destroy',$question->id)}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a href="#" onclick="if(confirm('Do you want to delete?')){
                                            event.preventDefault();
                                            document.getElementById('delete-form{{$question->id}}').submit()
                                        }else{
                                             event.preventDefault();
                                        }">

                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>No questions to display</td>
                        @endif
                        </tbody>
                    </table>
                    <div class="pagination pagination-centered">
                        {{$questions->links()}}
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection


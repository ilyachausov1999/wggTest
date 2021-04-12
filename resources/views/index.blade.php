@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->get('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($users as $user)
                    @foreach($user->forms as $form)
                <div class="card">
                    <div class="card-header">{{ $form->name }}</div>
                    <div class="card-body">
                        @foreach($form->questions as $question)
                            <p>Вопрос : {{ $question->question}}</p>
                            <form method="post" action="{{ route('add')}}">
                                @csrf
                                <label for="test-name">
                                    <button type="submit" class="btn btn-sm btn-success">Добавить ответ</button>
                                </label>
                                <input type="text" name="value" value="" class="form-control" id="value">
                                <input type="text" name="question_id" value="{{ $question->id}}" class="form-control" id="value">
                            </form>
                            @foreach($question->answers as $answer)
                                <p>Ответ : {{$answer->answer}}</p>
                            @endforeach
                        @endforeach
                            <p>Дата создания: {{ $form->created_at }}</p>
                            <p>Создал: {{ $user->name }}</p>
                    </div>
                </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

@endsection

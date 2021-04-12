@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Редактировать') }}</div>
                        <div class="col-lg-6 mx-auto">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('update', $form) }}">
                                @csrf
                                <form method="post" enctype="multipart/form-data" action="">
                                    <div class="form-group">
                                        <label for="test-name">Название формы</label>
                                        <input type="text" name="name" value="{{ $form->name }}" class="form-control" id="name">
                                    </div>
                                    @foreach($form->questions as $question)
                                        <p>Вопррос : <input type="text" name="questions-{{$question->getKey()}}" value="{{ $question->question}}" class="form-control" id="question"></p>
                                        @foreach($question->answers as $answer)
                                            <p>Ответ :  <input type="text" name="answers-{{$answer->getKey()}}" value="{{ $answer->answer }}" class="form-control" id="answer"></p>
                                        @endforeach
                                    @endforeach

                                    <button type="submit" class="btn btn-sm btn-success">Отредактировать</button>
                                </form>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>

@endsection

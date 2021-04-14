@extends('layouts.app')

@section('content')

<div class="container">
    @if(session()->get('success'))
        <div class="alert alert-success mt-3">
            {{ session()->get('success') }}
        </div>
    @endif
        <table class="table mt-3">
        <thead class="card-header">
        <tr><th scope="col">Название формы</th>
            <th scope="col">Дата создания формы</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($forms as $form)
            <tr>
                <td>{{$form->name}}</td>
                <td>{{$form->created_at}}</td>
                <td class="table-buttons">
                    <a href="{{ route('show', $form) }}" class="btn btn-sm btn-success col-md-3">Показать</a>
                    <a href="{{ route('edit', $form) }}" class="btn btn-sm btn-primary col-md-3">Изменить</a>
                    <a href="{{ route('delete', $form) }}" class="btn btn-sm btn-danger col-md-3">Удалить</a>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
        {{ $forms->links('layouts.paginate') }}
</div>



@endsection
